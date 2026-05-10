<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;

class SellerController extends Controller
{
    /**
     * Display seller profile with their products
     */
    public function show($id)
    {
        $seller = User::findOrFail($id);
        
        $products = Product::where('user_id', $id)
            ->active()
            ->with('images')
            ->latest()
            ->paginate(12);

        return view('pembeli.sellers.show', compact('seller', 'products'));
    }
}
