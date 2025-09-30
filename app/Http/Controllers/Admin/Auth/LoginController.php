<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        
        //print_r(Admin::get());
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        echo"Passowrd ". Hash::make('password');
        
        $admin= Admin::first();
        print_r($admin);
       // print_r($admin->password);
        $admin->password = Hash::make('password');
        $admin->save();
      //  echo Hash::check('password', $admin->password) ; // should return true
        $credentials = $request->only('email', 'password');
        \Log::info('Login attempt started', $credentials);
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
                \Log::info('Login success', ['admin' => Auth::guard('admin')->user()]);

            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Debug: confirm login
            dd('Logged in!', Auth::guard('admin')->user());

            return redirect()->intended(route('admin.dashboard'));
        }
        print_r($credentials);
        \Log::warning('Login failed', $credentials);
        dd('sssssssssTTTT');
        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->withInput($request->only('email', 'remember'));
    }



    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

