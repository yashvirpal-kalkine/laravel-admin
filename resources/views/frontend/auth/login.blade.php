@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    <!-- login section start here -->

    <section class="login-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-container">

                        <div class="login-form">
                            <div class="login-form-inner">
                                <h1>Login</h1>
                                <form method="POST" action="{{ route('login') }}" id="loginForm">
                                    @csrf
                                    <div class="login-form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" placeholder="email@website.com"
                                            autofocus>
                                        <small class="text-danger error_email error"></small>
                                    </div>

                                    <div class="login-form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password"
                                            placeholder="Minimum 8 characters" autocomplete="current-password" />
                                        <small class="text-danger error_password error"></small>
                                    </div>

                                    <div class="login-form-group single-row">
                                        <div class="custom-check">
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember">Remember me</label>
                                        </div>

                                        <a href="{{ route('password.request') }}" class="link forgot-link">
                                            Forgot Password?
                                        </a>
                                    </div>
                                    <span class="my-1 msg"></span>
                                    <button type="submit" class="rounded-button login-cta">
                                        Login
                                    </button>

                                    <div class="register-div">
                                        Not registered yet?
                                        <a href="{{ route('register') }}" class="link create-account">
                                            Create an account
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="login-img-wrap">
                            <figure> <img src="{{ asset('frontend/assets/images/re.png') }}" alt=""> </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login section end here -->

@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const rules = [
                { selector: "#email", rule: "email" },
                { selector: "#password", rule: "password" },
                //{ selector: "#tnc", rule: "tnc" }
            ];
            setTimeout(() => {
                initFormValidator("#loginForm", rules);
            }, 500)

        });
    </script>
@endpush