<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get cart total price
     */
    public function getTotalPrice()
    {
        return $this->items()->with('product')->get()->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    /**
     * Get total items count
     */
    public function getTotalItems()
    {
        return $this->items()->sum('quantity');
    }
}
