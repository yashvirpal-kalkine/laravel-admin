<?php

use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

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

if (!function_exists('formatDate')) {
    /**
     * Format a date using Carbon
     */
    function formatDate($date, $format = 'd M Y')
    {
        return $date ? Carbon::parse($date)->format($format) : null;
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

if (!function_exists('formatCurrency')) {
    /**
     * Format a number as currency
     *
     * @param float|int $amount
     * @param string $symbol
     * @param int $decimals
     * @return string
     */
    function formatCurrency($amount, $symbol = '$', $decimals = 2)
    {
        return $symbol . number_format($amount, $decimals, '.', ',');
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
