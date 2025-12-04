@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    <!-- Register section start here -->
    <section class="login-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-container">
                        <div class="login-form">
                            <div class="login-form-inner">
                                <h1>Register</h1>
                                <div class="login-form-group">
                                    <label for="email">Email</label>
                                    <input type="text" placeholder="Email" id="email">
                                </div>
                                <div class="login-form-group">
                                    <label for="phone">Phone </label>
                                    <input type="text" placeholder="Phone" id="phone">
                                </div>
                                <div class="login-form-group">
                                    <label for="pass">Password </label>
                                    <input type="password" id="pass" placeholder="Password">
                                    <span class="toggle-password" id="togglePass"><i class="fas fa-eye-slash"
                                            id="eyeIcon"></i></span>
                                </div>
                                <div class="login-form-group">
                                    <label for="confirm-pass">Confirm Password</label>
                                    <input autocomplete="off" type="password" placeholder="Confirm Password"
                                        id="confirm-pass">
                                </div>

                                <button class="rounded-button login-cta register-link">Register</button>

                                <div class="register-div">Already have an account? <a href="#"
                                        class="link create-account login-link">Log in here</a></div>
                            </div>

                        </div>
                        <div class="login-img-wrap">
                            <figure> <img src="assets/images/re.png" alt=""> </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Register section end here -->
@endsection