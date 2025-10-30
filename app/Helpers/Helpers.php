<?php

use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\HtmlString;

use App\Models\Page;

if (!function_exists('isActiveRoute')) {
    /**
     * Check if the current route matches the given route(s)
     * and return a CSS class (like "active").
     */
    function isActiveRoute($routeNames, $class = 'active')
    {
        if (is_array($routeNames)) {
            foreach ($routeNames as $route) {
                if (request()->routeIs($route)) {
                    return $class;
                }
            }
            return '';
        }

        return request()->routeIs($routeNames) ? $class : '';
    }
}

if (!function_exists('dateFormat')) {
    /**
     * Format a date using Carbon
     */
    function dateFormat($date)
    {
        if (!$date)
            return null;

        $dt = Carbon::parse($date);

        // Show time only if it's not 00:00:00
        if ($dt->format('H:i:s') != '00:00:00') {
            return $dt->format('d M Y H:i');
        }

        return $dt->format('d M Y');
    }
}

if (!function_exists('flashMessage')) {
    /**
     * Set a flash message to display in Blade
     */
    function flashMessage($message, $type = 'success')
    {
        Session::flash('message', $message);
        Session::flash('message_type', $type);
    }
}

if (!function_exists('currencyformat')) {
    /**
     * Format a number as currency
     *
     * @param float|int $amount
     * @param string $symbol
     * @param int $decimals
     * @return string
     */
    function currencyformat($amount, $symbol = '$', $decimals = 2)
    {
        return $symbol . number_format($amount, $decimals, '.', ',');
    }

    if (!function_exists('status_badge')) {
        function status_badge($status): HtmlString
        {
            $statuses = [
                1 => ['Active', 'success'],
                0 => ['Inactive', 'danger'],
                2 => ['Suspended', 'warning'],
            ];

            [$label, $color] = $statuses[$status] ?? ['Unknown', 'secondary'];

            return new HtmlString("<span class='badge bg-{$color}'>{$label}</span>");
        }
    }

    //     <!-- <a href="{{ route('admin.dashboard') }}" class="nav-link {{ isActiveRoute('admin.dashboard') }}">
    //     <i class="nav-icon bi bi-speedometer2"></i>
    //     <p>Dashboard</p>
    // </a> -->

    // <!-- Flash messages -->
    // <!-- @if(session('message'))
    //     <div class="alert alert-{{ session('message_type', 'success') }}">
    //         {{ session('message') }}
    //     </div>
    // @endif -->

    // <!-- Currency formatting -->
    // <!-- <p>Total: {{ formatCurrency(12345.678) }}</p>  -->
    // <!-- Output: $12,345.68 -->

    // <!-- Date formatting -->
    // <!-- <p>Created at: {{ formatDate($user->created_at) }}</p>  -->
    // <!-- Output: 14 Oct 2025 -->
}

if (!function_exists('image_url')) {
    /**
     * Get public URL of an image by type and size.
     *
     * Example:
     *   image_url('article', 'uuid_medium.webp', 'medium')
     *
     * @param string $type       e.g. 'article', 'product'
     * @param string|null $filename
     * @param string $size       e.g. 'icon', 'small', 'medium', 'large', 'original'
     * @return string|null
     */
    function image_url(string $type, ?string $filename, string $size = 'original'): ?string
    {
        if (!$filename) {
            return null;
        }

        $config = config("images.$type");

        if (!$config) {
            throw new \Exception("Image type '$type' not found in config/images.php");
        }

        $folder = $config['path'];

        // Optional subfolder per size (if you saved like /uploads/articles/small/)
        $sizeFolder = in_array($size, ['icon', 'small', 'medium', 'large', 'original'])
            ? $folder . '/' . $size
            : $folder;

        return asset('storage/' . trim($sizeFolder, '/') . '/' . $filename);
    }
}



if (!function_exists('pageTreeOptionsFromCollection')) {
    /**
     * Render <option> list from a flat pages collection.
     *
     * @param \Illuminate\Support\Collection $allPages   Collection of Page models
     * @param int|null $selectedId
     * @param array $excludeIds
     * @param int|null $parentId
     * @param string $prefix
     * @return string
     */
    function pageTreeOptionsFromCollection($allPages, $selectedId = null, $excludeIds = [], $parentId = null, $prefix = '')
    {
        $html = '';

        // Normalize parent_id comparison:
        $children = $allPages->filter(function ($item) use ($parentId) {
            return ($item->parent_id == $parentId);
        });

        foreach ($children as $child) {
            if (in_array($child->id, $excludeIds)) {
                continue; // skip this branch completely
            }

            $selected = ($selectedId == $child->id) ? 'selected' : '';

            $html .= '<option value="' . $child->id . '" ' . $selected . '>' . $prefix . e($child->title) . '</option>';

            // Recursive build
            $html .= pageTreeOptionsFromCollection($allPages, $selectedId, $excludeIds, $child->id, $prefix . '— ');
        }

        return $html;
    }




}

