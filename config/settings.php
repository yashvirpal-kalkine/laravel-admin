<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Currency Options
    |--------------------------------------------------------------------------
    */
    'currencies' => [
        'INR' => '₹',
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
        'AUD' => 'A$',
        'CAD' => 'C$',
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Platforms
    |--------------------------------------------------------------------------
    */
    'social_platforms' => [
        'facebook',
        'instagram',
        'twitter',
        'youtube',
    ],
    'payment_gateways' => [
        'paypal',
        'stripe',
        'razorpay',
        'payu',
    ],

    'templates' => [
        'home' => 'Home',
        'about' => 'About',
        'contact' => 'Contact',
        'default' => 'Default',
        'sitemap' => 'Sitemap',
        'cart' => 'Cart',
        'checkout' => 'Checkout',
        'shop' => 'Shop/Category',
        'category' => 'shop',
        'auth' => 'Auth',
        'search' => 'Search',
    ],

    'global_section_templates' => [
        '0' => 'Why Choose Us',
        '1' => 'Bannner',
    ],


];
