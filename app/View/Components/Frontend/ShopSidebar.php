<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class ShopSidebar extends Component
{
    public array $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function render()
    {
        return view('components.frontend.shop-sidebar');
    }
}

