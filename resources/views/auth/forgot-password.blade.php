@extends('user.layouts.main')

@section('content')
    <section class="p-2 p-md-4 p-xl-4">
        <div class="container">
            <div class="row">
                <!-- Form Lupa Password -->
                <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
                    <div class="py-3 py-md-4 py-xl-5 pe-3 pe-md-4 pe-xl-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <h3 class="mb-2">{{ __('Forgot Your Password?') }}</h3>
                                    <p class="fs-6 fw-normal m-0">
                                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Tampilkan Pesan Status jika Ada -->
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autofocus autocomplete="username"
                                    placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn bsb-btn-xl btn-primary">
                                    {{ __('Email Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Gambar atau Konten Samping (Opsional) -->
                <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
                    <div class="d-flex flex-column h-100 p-3 p-md-4 p-xl-5">
                        <img class="d-none d-md-block img-fluid rounded mx-auto my-4" loading="lazy"
                            src="user/images/banner-image-6.jpg" width="100%" height="100%" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
