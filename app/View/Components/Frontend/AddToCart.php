<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class AddToCart extends Component
{
    public $cartQty;
    public $productId;
    public $qty;
    public $isSingle;

    public function __construct(
        $cartQty = 0,
        $productId,
        $qty = 1,
        $isSingle = false
    ) {
        $this->cartQty = $cartQty;
        $this->productId = $productId;
        $this->qty = $qty;
        $this->isSingle = $isSingle;
    }

    public function render()
    {
        return view('components.frontend.add-to-cart');
    }
}


