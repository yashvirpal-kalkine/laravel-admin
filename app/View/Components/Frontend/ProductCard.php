<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class ProductCard extends Component
{
    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('components.frontend.product-card');
    }
}
