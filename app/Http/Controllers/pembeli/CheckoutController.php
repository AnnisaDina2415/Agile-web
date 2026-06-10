<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->middleware('auth');
        $this->midtransService = $midtransService;
    }

    /**
     * Show the checkout page
     */
    public function index()
    {
        $user = auth()->user();
        $cart = $user->cart;

        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->route('pembeli.cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $items = $cart->items()->with('product.primaryImage')->get();
        $subtotal = $cart->getTotalPrice();
        $shipping = 10000; // Fixed estimation
        $total = $subtotal + $shipping;

        return view('pembeli.checkout.index', compact('items', 'subtotal', 'shipping', 'total', 'user'));
    }

    /**
     * Process checkout and create order
     */
    public function store(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'recipient_email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $user = auth()->user();
        $cart = $user->cart;

        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->route('pembeli.cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Generate unique order number
        $orderNumber = 'ORD-' . date('Ymd') . '-' . time() . '-' . $user->id;
        $shipping = 10000;
        $totalPrice = $cart->getTotalPrice() + $shipping;

        DB::beginTransaction();
        try {
            // Create Order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $orderNumber,
                'total_price' => $totalPrice,
                'status' => Order::STATUS_PENDING,
                'phone' => $request->phone,
                'address' => "Penerima: " . $request->recipient_name . " (" . $request->recipient_email . ")\nAlamat: " . $request->address,
            ]);

            // Move Cart Items to Order Items
            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);

                // Reduce product stock
                $product = $cartItem->product;
                $product->stock = max(0, $product->stock - $cartItem->quantity);
                $product->save();
            }

            // Get snap token from Midtrans
            $snapToken = $this->midtransService->getSnapToken($order);
            $order->snap_token = $snapToken;
            $order->save();

            // Clear user cart
            $cart->items()->delete();
            $cart->total_price = 0;
            $cart->save();

            DB::commit();

            return redirect()->route('pembeli.orders.show', $order->id)->with('success', 'Order berhasil dibuat. Silakan selesaikan pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }
}
