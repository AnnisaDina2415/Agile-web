<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    /**
     * Handle Midtrans payment notification
     */
    public function handle(Request $request)
    {
        Log::info('Midtrans notification received: ', $request->all());

        $serverKey = env('MIDTRANS_SERVER_KEY');
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;
        $signature = $request->signature_key;

        // Verify signature
        $localSignature = hash("sha512", $orderId . $statusCode . $grossAmount . $serverKey);

        if ($localSignature !== $signature) {
            Log::warning('Midtrans callback signature verification failed. Local: ' . $localSignature . ' Remote: ' . $signature);
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid signature'
            ], 400);
        }

        // Find corresponding order
        $order = Order::where('order_number', $orderId)->first();

        if (!$order) {
            Log::warning('Order not found for order number: ' . $orderId);
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found'
            ], 404);
        }

        $transactionStatus = $request->transaction_status;
        $type = $request->payment_type;
        $fraud = $request->fraud_status;

        if ($transactionStatus == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->status = 'pending';
                } else {
                    $order->status = Order::STATUS_PAID;
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            $order->status = Order::STATUS_PAID;
        } elseif ($transactionStatus == 'pending') {
            $order->status = Order::STATUS_PENDING;
        } elseif ($transactionStatus == 'deny') {
            $order->status = Order::STATUS_CANCELLED;
        } elseif ($transactionStatus == 'expire') {
            $order->status = Order::STATUS_EXPIRED;
        } elseif ($transactionStatus == 'cancel') {
            $order->status = Order::STATUS_CANCELLED;
        }

        $order->save();

        Log::info('Order ' . $orderId . ' status updated to ' . $order->status);

        return response()->json([
            'status' => 'success',
            'message' => 'Notification processed successfully'
        ]);
    }
}
