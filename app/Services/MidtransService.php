<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        Config::$is3ds = env('MIDTRANS_IS_3DS', true);

        if (!Config::$isProduction) {
            Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_HTTPHEADER => [],
            ];
        }
    }

    /**
     * Get Snap Token for an Order.
     *
     * @param Order $order
     * @return string
     */
    public function getSnapToken(Order $order)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->phone ?? $order->user->phone ?? '081234567890',
                'billing_address' => [
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                    'phone' => $order->phone ?? $order->user->phone ?? '081234567890',
                    'address' => $order->address ?? $order->user->address ?? 'Alamat Belum Diisi',
                ],
                'shipping_address' => [
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                    'phone' => $order->phone ?? $order->user->phone ?? '081234567890',
                    'address' => $order->address ?? $order->user->address ?? 'Alamat Belum Diisi',
                ]
            ],
            'item_details' => $order->items->map(function ($item) {
                return [
                    'id' => (string) $item->product_id,
                    'price' => (int) $item->price,
                    'quantity' => $item->quantity,
                    'name' => substr($item->product->name, 0, 50),
                ];
            })->toArray()
        ];

        return Snap::getSnapToken($params);
    }
}
