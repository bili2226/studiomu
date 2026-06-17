<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
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
     * Handle webhook notification callback from Midtrans.
     */
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $grossAmount = $request->input('gross_amount');
        $signatureKey = $request->input('signature_key');

        // Verify Signature Key
        $localSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== $localSignature) {
            Log::warning('Midtrans Webhook Callback Signature Mismatch');
            return response()->json(['success' => false, 'message' => 'Invalid signature'], 400);
        }

        $booking = Booking::find($orderId);
        if (!$booking) {
            Log::warning('Midtrans Callback: Booking not found: ' . $orderId);
            return response()->json(['success' => false, 'message' => 'Booking not found'], 404);
        }

        $transactionStatus = $request->input('transaction_status');
        $type = $request->input('payment_type');
        $fraudStatus = $request->input('fraud_status');

        if ($transactionStatus == 'capture') {
            if ($type == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $booking->update(['status' => 'Pending']);
                } else {
                    $booking->update(['status' => 'Confirmed']);
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            $booking->update(['status' => 'Confirmed']);
        } elseif ($transactionStatus == 'pending') {
            $booking->update(['status' => 'Pending']);
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel', 'failure'])) {
            $booking->update(['status' => 'Cancelled']);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the payment success/finish page.
     */
    public function finish(Request $request)
    {
        $orderId = $request->query('order_id');
        $booking = null;

        if ($orderId) {
            $booking = Booking::where('id', $orderId)
                ->where('user_id', auth()->id())
                ->first();

            // Client-side fallback: update status to Confirmed if Pending (only for Transfer)
            if ($booking && $booking->status === 'Pending' && $booking->payment_method !== 'Cash') {
                $booking->update(['status' => 'Confirmed']);
            }
        }

        return view('payment.finish', compact('booking'));
    }

    /**
     * Display the payment failure/error page.
     */
    public function error(Request $request)
    {
        $orderId = $request->query('order_id');
        $booking = null;

        if ($orderId) {
            $booking = Booking::where('id', $orderId)
                ->where('user_id', auth()->id())
                ->first();

            // Client-side fallback: update status to Cancelled if Pending
            if ($booking && $booking->status === 'Pending') {
                $booking->update(['status' => 'Cancelled']);
            }
        }

        return view('payment.error', compact('booking'));
    }
}
