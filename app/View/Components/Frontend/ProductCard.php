<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class ProductCard extends Component
{
    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('components.frontend.product-card');
    }
}
