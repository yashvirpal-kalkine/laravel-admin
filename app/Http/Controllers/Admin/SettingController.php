<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $currencies = config('settings.currencies');
        $socialPlatforms = config('settings.social_platforms');
        $paymentGateways = config('settings.payment_gateways');

        $settings = Setting::all()->pluck('value', 'key')->toArray();

        if (!empty($settings['currency']) && !empty($settings['currency_symbol'])) {
            $settings['currency'] = $settings['currency'] . ',' . $settings['currency_symbol'];
        }
        // Decode JSON fields if they exist
        $settings['social'] = !empty($settings['social']) && is_string($settings['social'])
            ? json_decode($settings['social'], true)
            : ($settings['social'] ?? []);

        $settings['payment_gateway'] = !empty($settings['payment_gateway']) && is_string($settings['payment_gateway'])
            ? json_decode($settings['payment_gateway'], true)
            : ($settings['payment_gateway'] ?? []);

        return view('admin.settings.index', compact(
            'settings',
            'currencies',
            'socialPlatforms',
            'paymentGateways'
        ));
    }

    public function update(SettingRequest $request)
    {
        $data = $request->except(['header_logo', 'footer_logo', 'favicon']);
        // If currency is in the format "INR,₹"
        if (!empty($data['currency']) && str_contains($data['currency'], ',')) {
            [$code, $symbol] = explode(',', $data['currency']);
            $data['currency'] = $code;
            $data['currency_symbol'] = $symbol;
        }
        $socialData = $request->input('social', []);
        $paymentData = $request->input('payment_gateway', []);

        // Save grouped data
        Setting::set('social', json_encode($socialData));
        Setting::set('payment_gateway', json_encode($paymentData));

        // Handle file uploads
        foreach (['header_logo', 'footer_logo', 'favicon'] as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $path = $file->store('settings', 'public');
                Setting::set($fileKey, $path);
            }
        }

        // Save other settings
        foreach ($data as $key => $value) {
            if (in_array($key, ['social', 'payment_gateway'])) {
                continue;
            }
            Setting::set($key, is_array($value) ? json_encode($value) : $value);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
