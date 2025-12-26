@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    <!-- login section start here -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    <section class="login-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-container">
                        <div class="login-form">
                            <div class="login-form-inner">
                                <h1>Login</h1>
                                <div class="login-form-group">
                                    <label for="email">Email </label>
                                    <input type="text" placeholder="email@website.com" id="email">
                                </div>
                                <div class="login-form-group">
                                    <label for="pwd">Password </label>
                                    <input autocomplete="off" type="text" placeholder="Minimum 8 characters" id="pwd">
                                </div>

                                <div class="login-form-group single-row">
                                    <div class="custom-check">
                                        <input autocomplete="on" type="checkbox" id="remember"><label
                                            for="remember">Remember me</label>

                                    </div>

                                    <a href="#" class="link forgot-link">Forgot Password ?</a>
                                </div>

                                <button href="#" class="rounded-button login-cta">Login</button>

                                <div class="register-div">Not registered yet? <a href="#" class="link create-account">Create
                                        an account ?</a></div>
                            </div>

                        </div>
                        <div class="login-img-wrap">
                            <figure> <img src="{{ asset('frontend/assets/images/login.png') }}" alt=""> </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login section end here -->

@endsection