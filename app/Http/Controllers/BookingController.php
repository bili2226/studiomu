<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configurations
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');
    }

    /**
     * Store a new booking and get Midtrans Snap Token.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_key' => 'required|string',
            'service_title' => 'required|string',
            'package_name' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'price' => 'required|string',
            'requests' => 'nullable|string',
            'payment_method' => 'nullable|string|in:Transfer,Cash',
            'reward_id' => 'nullable|integer|exists:rewards,id',
            'addons' => 'nullable|array',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // Parse price to integer amount
        $originalAmount = $this->parsePriceToInteger($request->price);
        
        // Sum addon prices
        $addonsPrice = 0;
        $addons = $request->input('addons', []);
        foreach ($addons as $addon) {
            $addonsPrice += ((int) ($addon['qty'] ?? 0)) * ((int) ($addon['price'] ?? 0));
        }
        $originalAmount += $addonsPrice;

        $discount = 0;
        $pointsUsed = 0;

        if ($request->reward_id) {
            $reward = \App\Models\Reward::active()->find($request->reward_id);
            if (!$reward) {
                return response()->json(['success' => false, 'message' => 'Voucher reward tidak aktif atau tidak ditemukan.'], 422);
            }
            if ($user->points < $reward->points_required) {
                return response()->json(['success' => false, 'message' => 'Poin Anda tidak mencukupi untuk menukarkan reward ini.'], 422);
            }

            $discount = $reward->discount_amount;
            $pointsUsed = $reward->points_required;
            $user->decrement('points', $pointsUsed);
        }

        $amount = max(0, $originalAmount - $discount);
        $multiplier = $this->getPointsMultiplier();
        $pointsEarned = floor($amount / $multiplier);

        // Generate custom booking ID (BOOK-XXXX)
        $bookingId = 'BOOK-' . rand(1000, 9999);
        while (Booking::where('id', $bookingId)->exists()) {
            $bookingId = 'BOOK-' . rand(1000, 9999);
        }

        $paymentMethod = $request->payment_method ?? 'Transfer';

        // Parse start time from session range (e.g. "09.00 - 10.00" or "09:00 WIB" -> "09:00")
        $timeParts = explode('-', $request->time);
        $startPart = trim($timeParts[0]);
        $startPart = str_replace('.', ':', $startPart);
        $startTime = trim(str_replace(' WIB', '', $startPart));

        // Save booking in database
        $bookingDate = $request->date . ' ' . $startTime;
        $booking = Booking::create([
            'id' => $bookingId,
            'user_id' => $user->id,
            'service_name' => $request->service_title . ' (' . $request->package_name . ')',
            'booking_date' => $bookingDate,
            'amount' => $amount,
            'discount' => $discount,
            'points_used' => $pointsUsed,
            'points_earned' => $pointsEarned,
            'payment_method' => $paymentMethod,
            'status' => 'Pending',
            'requests' => $request->requests,
            'addons' => $addons,
        ]);

        if ($amount === 0) {
            $booking->update(['status' => 'Confirmed']);
            return response()->json([
                'success' => true,
                'booking' => $booking,
                'snap_token' => null,
                'message' => 'Booking sukses terkonfirmasi menggunakan potongan poin penuh!'
            ]);
        }

        if ($paymentMethod === 'Cash') {
            return response()->json([
                'success' => true,
                'booking' => $booking,
                'snap_token' => null,
            ]);
        }

        // Request token from Midtrans Snap
        try {
            $transactionParams = [
                'transaction_details' => [
                    'order_id' => $bookingId,
                    'gross_amount' => $amount,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
                'item_details' => [
                    [
                        'id' => $request->service_key,
                        'price' => $amount,
                        'quantity' => 1,
                        'name' => substr($booking->service_name, 0, 50),
                    ]
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($transactionParams);
            $booking->update(['snap_token' => $snapToken]);

            return response()->json([
                'success' => true,
                'booking' => $booking,
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal terhubung dengan layanan pembayaran Midtrans: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Admin update booking status manually.
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $request->validate([
            'status' => 'required|string|in:Pending,Confirmed,Completed,Cancelled',
        ]);

        $booking->status = $request->status;
        $booking->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'booking' => [
                    'id' => $booking->id,
                    'status' => $booking->status,
                    'user_points' => $booking->user ? $booking->user->refresh()->points : 0
                ]
            ]);
        }

        $displayStatus = $booking->status;
        if ($booking->status === 'Confirmed') {
            $displayStatus = 'Terkonfirmasi';
        } elseif ($booking->status === 'Completed') {
            $displayStatus = 'Selesai';
        } elseif ($booking->status === 'Cancelled') {
            $displayStatus = 'Dibatalkan';
        }

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Status booking ' . $booking->id . ' berhasil diubah menjadi ' . $displayStatus . '!');
    }

    /**
     * Update booking status to Confirmed upon successful frontend payment callback (for local testing).
     */
    public function confirmPayment(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->status === 'Pending') {
            $booking->update(['status' => 'Confirmed']);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Helper to get points multiplier from settings.json
     */
    private function getPointsMultiplier()
    {
        $settingsPath = storage_path('app/settings.json');
        if (file_exists($settingsPath)) {
            $settings = json_decode(file_get_contents($settingsPath), true);
            return (int) ($settings['points_multiplier'] ?? 10000);
        }
        return 10000;
    }

    /**
     * Helper to parse price string to integer (e.g. "Rp 1.500k" -> 1500000)
     */
    private function parsePriceToInteger($priceStr)
    {
        $clean = strtolower(trim($priceStr));

        if (str_ends_with($clean, 'k')) {
            $numberPart = substr($clean, 0, -1);
            $numberPart = str_replace(['rp', '.', ' '], '', $numberPart);
            return (int) ($numberPart * 1000);
        }

        $digits = preg_replace('/[^0-9]/', '', $clean);
        return (int) $digits;
    }

    /**
     * Display the booking history list for the customer.
     */
    public function historyIndex(Request $request)
    {
        $user = auth()->user();
        $bookings = $user ? $user->bookings()->orderBy('created_at', 'desc')->get()->map(function($booking) {
            return [
                'id' => $booking->id,
                'name' => $booking->user->name ?? 'User Terhapus',
                'email' => $booking->user->email ?? '',
                'service' => $booking->service_name,
                'date' => $booking->booking_date->format('d M Y') . ', ' . $booking->booking_date->format('H.i') . ' - ' . $booking->booking_date->copy()->addHour()->format('H.i'),
                'amount' => 'Rp ' . number_format($booking->amount, 0, ',', '.'),
                'status' => $booking->status,
                'requests' => $booking->requests ?? '',
                'snap_token' => $booking->snap_token ?? '',
                'payment_method' => $booking->payment_method ?? 'Transfer',
                'discount' => 'Rp ' . number_format($booking->discount, 0, ',', '.'),
                'discount_raw' => $booking->discount,
                'points_used' => $booking->points_used,
                'points_earned' => $booking->points_earned,
                'result_link' => $booking->result_link ?? '',
                'addons' => $booking->addons
            ];
        }) : collect();

        return view('customer.history', compact('bookings'));
    }

    /**
     * Photographer mark an assigned booking session as Completed.
     */
    public function completeSession(Request $request, $id)
    {
        $photographer = auth()->user();
        if (!$photographer || $photographer->role !== 'photographer') {
            abort(403, 'Unauthorized action.');
        }

        $booking = Booking::where('id', $id)
            ->where('photographer_id', $photographer->id)
            ->firstOrFail();

        if ($booking->status !== 'Confirmed') {
            return redirect()->back()->with('error', 'Hanya sesi terkonfirmasi yang dapat diselesaikan.');
        }

        $booking->status = 'Completed';
        $booking->save();

        return redirect()->back()->with('success', 'Sesi pemotretan ' . $booking->id . ' telah diselesaikan!');
    }

    /**
     * Photographer update result link for an assigned booking.
     */
    public function updateResultLink(Request $request, $id)
    {
        $photographer = auth()->user();
        if (!$photographer || $photographer->role !== 'photographer') {
            abort(403, 'Unauthorized action.');
        }

        $booking = Booking::where('id', $id)
            ->where('photographer_id', $photographer->id)
            ->firstOrFail();

        $request->validate([
            'result_link' => 'required|url|max:2048',
        ], [
            'result_link.required' => 'Link hasil foto wajib diisi.',
            'result_link.url' => 'Format link tidak valid. Pastikan diawali dengan http:// atau https://',
        ]);

        $booking->result_link = $request->result_link;
        $booking->save();

        return redirect()->back()->with('success', 'Link hasil foto untuk booking ' . $booking->id . ' berhasil diperbarui!');
    }
}
