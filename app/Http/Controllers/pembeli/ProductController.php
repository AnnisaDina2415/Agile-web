<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified product detail.
     */
    public function show($id)
    {
        $product = Product::with(['images', 'user'])->active()->findOrFail($id);
        
        // Get related products from same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->with('images')
            ->limit(4)
            ->get();

        return view('pembeli.products.show', compact('product', 'relatedProducts'));
    }
}
