<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'session_id'];

    public function items()
    {
        return $this->hasMany(CartItem::class)->with('product');
    }

    public function total()
    {
        return $this->items->sum(fn($item) => $item->price * $item->quantity);
    }
    
}


