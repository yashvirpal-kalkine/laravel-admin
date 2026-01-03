@extends('layouts.frontend')

@section('meta')
    {{-- <x-frontend-meta /> --}}
@endsection

@section('content')
    <!-- forgot password section start here -->

    <section class="login-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-container">

                        <div class="login-form">
                            <div class="login-form-inner">
                                <h1>Forgot Password</h1>
                                <p class="mb-3 text-muted">
                                    Enter your email address and we’ll send you a password reset link.
                                </p>

                                <form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm">
                                    @csrf

                                    <div class="login-form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" placeholder="email@website.com"
                                            autofocus>
                                        <small class="text-danger error_email error"></small>
                                    </div>

                                    <span class="my-1 msg"></span>

                                    <button type="submit" class="rounded-button login-cta">
                                        Send Reset Link
                                    </button>

                                    <div class="register-div mt-3">
                                        Remembered your password?
                                        <a href="{{ route('login') }}" class="link create-account">
                                            Back to Login
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="login-img-wrap">
                            <figure>
                                <img src="{{ asset('frontend/assets/images/re.png') }}" alt="">
                            </figure>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- forgot password section end here -->
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const rules = [
                { selector: "#email", rule: "email" }
            ];

            setTimeout(() => {
                initFormValidator("#forgotPasswordForm", rules);
            }, 500);
        });
    </script>
@endpush