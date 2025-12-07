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