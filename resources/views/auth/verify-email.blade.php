@extends('user.layouts.main')

@section('content')
    <section class="p-2 p-md-4 p-xl-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
                    <div class="p-3 p-md-4 p-xl-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <h3 class="mb-2">Verify your email address.</h3>
                                    <p class="fs-6 fw-normal m-0">
                                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <div class="row gy-3 gy-md-4 overflow-hidden mt-1">
                            <!-- Resend Verification Email Button -->
                            <div class="col-12">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary"
                                            type="submit">{{ __('Resend Verification Email') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row gy-3 gy-md-4 overflow-hidden mt-1">
                            <!-- Logout Button -->
                            <div class="col-12">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <div class="d-grid border-animation-left">
                                        <button class="btn bsb-btn-xl item-anchor"
                                            type="submit">{{ __('Log Out') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
                    <div class="d-flex flex-column h-100 p-3 p-md-4 p-xl-5">
                        <img class="d-none d-md-block img-fluid rounded mx-auto my-4" loading="lazy"
                            src="user/images/single-image-2.jpg" width="100%" height="100%" alt="ave">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
