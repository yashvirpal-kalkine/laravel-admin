<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;
use App\Services\BreadcrumbService;

class BannerBreadcrumb extends Component
{
    public array $items;

    public function __construct()
    {
        // ensure always returns an array (BreadcrumbService::generate returns array)
        $this->items = BreadcrumbService::generate() ?? [];
    }

    public function render()
    {
        return view('components.frontend.banner-breadcrumb');
    }
}
