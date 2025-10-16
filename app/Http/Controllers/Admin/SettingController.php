<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // Define available currencies (comma-separated string)
        $currencyOptions = [
            'INR' => '₹',
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'AUD' => 'A$',
            'CAD' => 'C$',
        ];

        // Pass to view
        $currencies = $currencyOptions;

        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $socialPlatforms = ['facebook', 'instagram', 'twitter', 'youtube'];

        return view('admin.settings.index', compact(
            'settings',
            'currencies',
            'socialPlatforms'
        ));
    }

    public function update(SettingRequest $request)
    {
        $data = $request->except(['header_logo', 'footer_logo', 'favicon']);
        $socialData = $request->input('social', []);
        Setting::set('social', json_encode($socialData));

        // Handle files
        foreach (['header_logo', 'footer_logo', 'favicon'] as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $path = $file->store('settings', 'public');
                $data[$fileKey] = $path;
            }
        }

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);
            }
            Setting::set($key, $value);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
