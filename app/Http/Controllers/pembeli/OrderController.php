<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of user orders
     */
    public function index()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)
            ->with(['items.product.primaryImage'])
            ->latest()
            ->paginate(10);

        return view('pembeli.orders.index', compact('orders'));
    }

    /**
     * Display a specific order detail
     */
    public function show($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->with(['items.product.primaryImage', 'items.product.user'])
            ->firstOrFail();

        return view('pembeli.orders.show', compact('order'));
    }
}
