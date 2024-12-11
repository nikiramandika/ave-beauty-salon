@extends('user.layouts.main')

@section('content')

    <section class="p-2 p-md-4 p-xl-4">
        <div class="container pt-4">
            <div class="row">
                <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
                    <div class="d-flex flex-column h-100">
                        <img class="d-none d-md-block img-fluid rounded mx-auto my-4 h-100" loading="lazy"
                            src="user/images/single-image-2.jpg" style="object-fit: cover;" alt="ave">
                    </div>
                </div>
                <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
                    <div class="ps-3 ps-md-4 ps-xl-5 p-0 p-md-2 p-xl-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <h3 class="mb-2">Log In</h3>
                                    <h3 class="fs-6 fw-normal text-secondary m-0">Enter your details</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <!-- Email Address -->
                                <div class="col-12 mt-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username" />
                                        <div class="mt-1" style="height: 17px;">
                                            <x-input-error :messages="$errors->get('email')" class="text-danger small mx-0 px-1" style="list-style: none; font-size: 14px;" />
                                        </div>
                                    
                                </div>
                                

                                <!-- Password -->
                                <div class="col-12 mt-2">
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" class="form-control" type="password" name="password"
                                        required autocomplete="current-password" />
                                        <div class="mt-1" style="height: 17px;">
                                            <x-input-error :messages="$errors->get('password')" class="text-danger small mx-0 px-1" style="list-style: none; font-size: 14px;" />
                                        </div>
                                </div>

                                <!-- Remember Me -->
                                <div class="col-12 mt-2">
                                    <div class="form-check">
                                        <input id="remember_me" type="checkbox" class="form-check-input ms-0" name="remember">
                                        <label for="remember_me"
                                            class="form-check-label ">{{ __('Remember me') }}</label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary"
                                            type="submit">{{ __('Log in') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Forgot Password and Sign Up Links -->
                        <div class="row">
                            <div class="col-12">
                                <hr class="mt-5 mb-4 ">
                                <p class="m-0 text-end border-animation-left">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}"
                                            class="text-decoration-none item-anchor">{{ __('Forgot your password?') }}</a>
                                    @endif
                                    <br>
                                    Don't have an account? <a href="{{ route('register') }}"
                                        class="text-decoration-none item-anchor">Register Now!</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
