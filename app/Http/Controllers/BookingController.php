<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Refund;
use App\Models\User;
use App\Http\Controllers\NotificationController;
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

        // Notify all admins about new booking
        NotificationController::notifyAdmins(
            'booking_new',
            '📋 Booking Baru Masuk',
            'Booking baru #' . $bookingId . ' dari ' . $user->name . ' untuk ' . $request->service_title . ' pada ' . $bookingDate . '.',
            route('admin.bookings.index')
        );

        if ($amount === 0) {
            $booking->update(['status' => 'Confirmed']);
            // Notify customer
            NotificationController::notify(
                $user->id, 'booking_confirmed',
                '✅ Booking Terkonfirmasi',
                'Booking #' . $bookingId . ' Anda telah terkonfirmasi menggunakan potongan poin penuh!',
                route('customer.history')
            );
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

        // Notify the booking's customer about the status change
        if ($booking->user) {
            $messages = [
                'Confirmed'  => ['✅ Booking Terkonfirmasi', 'Booking #' . $booking->id . ' Anda telah dikonfirmasi oleh admin. Sampai jumpa di sesi foto!'],
                'Cancelled'  => ['❌ Booking Dibatalkan', 'Booking #' . $booking->id . ' Anda telah dibatalkan. Hubungi admin untuk informasi lebih lanjut.'],
                'Completed'  => ['🎉 Sesi Foto Selesai', 'Sesi foto untuk booking #' . $booking->id . ' telah selesai. Terima kasih telah menggunakan Studio.mu!'],
            ];
            if (isset($messages[$request->status])) {
                NotificationController::notify(
                    $booking->user->id,
                    'booking_' . strtolower($request->status),
                    $messages[$request->status][0],
                    $messages[$request->status][1],
                    route('customer.history')
                );
            }
        }

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
     * Submit a review for a completed booking.
     */
    public function submitReview(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Only allow submitting review if the booking is completed
        if ($booking->status !== 'Completed') {
            return response()->json(['success' => false, 'message' => 'Hanya booking yang selesai yang bisa diulas.']);
        }

        $request->validate([
            'review' => 'required|string',
        ]);

        $booking->update([
            'review' => $request->review,
        ]);

        return response()->json(['success' => true]);
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
                'addons' => $booking->addons,
                'raw_date' => $booking->booking_date->format('Y-m-d H:i:s')
            ];
        }) : collect();

        return view('customer.history', compact('bookings'));
    }

    /**
     * Photographer mark an assigned booking session as Completed.
     * Only allowed on the same calendar day as the booking_date.
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

        // Validate: can only complete on the same calendar day as the booking
        $bookingDay = $booking->booking_date->toDateString();   // e.g. 2026-06-24
        $today      = now()->toDateString();

        if ($bookingDay !== $today) {
            $formattedDay = $booking->booking_date->translatedFormat('l, d F Y');
            return redirect()->back()->with('error',
                'Sesi ' . $booking->id . ' hanya dapat diselesaikan pada hari sesi berlangsung, yaitu ' . $formattedDay . '.'
            );
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
    /**
     * Check cancel eligibility info (JSON API for modal).
     */
    public function checkCancelInfo($id)
    {
        $user = Auth::user();
        $booking = Booking::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        if (!in_array($booking->status, ['Pending', 'Confirmed'])) {
            return response()->json(['eligible' => false, 'error' => 'Booking tidak dapat dibatalkan.'], 422);
        }

        $hoursUntilSession = now()->diffInHours($booking->booking_date, false);
        $eligibleForRefund = $hoursUntilSession >= 24;
        $refundAmount = $eligibleForRefund ? (int) round($booking->amount * 0.7) : 0;

        return response()->json([
            'eligible_for_refund' => $eligibleForRefund,
            'hours_until_session' => $hoursUntilSession,
            'total_amount'        => $booking->amount,
            'refund_amount'       => $refundAmount,
            'booking_id'          => $booking->id,
            'service_name'        => $booking->service_name,
            'booking_date'        => $booking->booking_date->format('d M Y, H:i'),
        ]);
    }

    /**
     * Customer cancel a booking.
     */
    public function cancelBooking(Request $request, $id)
    {
        $user = Auth::user();
        $booking = Booking::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        if (!in_array($booking->status, ['Pending', 'Confirmed'])) {
            return response()->json(['success' => false, 'message' => 'Booking tidak dapat dibatalkan karena statusnya sudah ' . $booking->status . '.'], 422);
        }

        $hoursUntilSession = now()->diffInHours($booking->booking_date, false);
        $eligibleForRefund = $hoursUntilSession >= 24;

        if ($eligibleForRefund) {
            $request->validate([
                'bank_name'        => 'required|string|max:100',
                'account_number'   => 'required|string|max:50',
                'account_holder'   => 'required|string|max:100',
            ], [
                'bank_name.required'      => 'Nama bank wajib diisi.',
                'account_number.required' => 'Nomor rekening wajib diisi.',
                'account_holder.required' => 'Nama pemilik rekening wajib diisi.',
            ]);

            $refundAmount = (int) round($booking->amount * 0.7);

            // Create refund record
            Refund::create([
                'booking_id'      => $booking->id,
                'amount'          => $refundAmount,
                'bank_name'       => $request->bank_name,
                'account_number'  => $request->account_number,
                'account_holder'  => $request->account_holder,
                'status'          => 'pending',
            ]);

            // Notify admins about pending refund
            NotificationController::notifyAdmins(
                'refund_request',
                '💰 Permintaan Refund Baru',
                'Booking #' . $booking->id . ' atas nama ' . $user->name . ' telah dibatalkan dan mengajukan refund sebesar Rp ' . number_format($refundAmount, 0, ',', '.') . '. Silakan proses di halaman Kelola Refund.',
                route('admin.refunds.index')
            );
        }

        // Cancel the booking — this also triggers points refund in Booking::booted()
        $booking->update(['status' => 'Cancelled']);

        // Notify the customer
        $message = $eligibleForRefund
            ? 'Booking #' . $booking->id . ' berhasil dibatalkan. Permintaan refund sebesar Rp ' . number_format((int) round($booking->amount * 0.7), 0, ',', '.') . ' sedang diproses oleh admin.'
            : 'Booking #' . $booking->id . ' berhasil dibatalkan. Sesuai kebijakan Studio.mu, pembatalan kurang dari 24 jam sebelum sesi tidak mendapatkan refund.';

        NotificationController::notify(
            $user->id,
            'booking_cancelled',
            '❌ Booking Dibatalkan',
            $message,
            route('customer.history')
        );

        return response()->json([
            'success'           => true,
            'eligible_for_refund' => $eligibleForRefund,
            'message'           => $eligibleForRefund
                ? 'Booking berhasil dibatalkan. Permintaan refund Anda sedang diproses oleh admin.'
                : 'Booking berhasil dibatalkan.',
        ]);
    }

    public function customerReviews()
    {
        $user = auth()->user();
        if (!$user || $user->role !== 'customer') {
            abort(403, 'Unauthorized action.');
        }

        $reviews = $user->bookings()
            ->whereNotNull('review')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('customer.reviews', compact('reviews'));
    }

    public function photographerReviews()
    {
        $user = auth()->user();
        if (!$user || $user->role !== 'photographer') {
            abort(403, 'Unauthorized action.');
        }

        $reviews = Booking::with('user')
            ->where('photographer_id', $user->id)
            ->whereNotNull('review')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('photographer.reviews', compact('reviews'));
    }
}
