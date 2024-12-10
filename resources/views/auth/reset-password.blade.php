@extends('user.layouts.main')

@section('content')
    <section class="p-2 p-md-4 p-xl-4">
        <div class="container">
            <div class="row">
                <!-- Form Reset Password -->
                <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
                    <div class="py-3 py-md-4 py-xl-5 pe-3 pe-md-4 pe-xl-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4">
                                    <h3 class="mb-2">{{ __('Reset Password') }}</h3>
                                    <p class="fs-6 fw-normal m-0">
                                        {{ __('Silakan masukkan alamat email dan kata sandi baru Anda di bawah ini.') }}
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

                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                                    placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirm Password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn bsb-btn-xl btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Gambar atau Konten Samping (Opsional) -->
                <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
                    <div class="d-flex flex-column h-100 p-3 p-md-4 p-xl-5">
                        <img class="d-none d-md-block img-fluid rounded mx-auto my-4" loading="lazy"
                            src="{{ asset('user/images/banner-image-5.jpg') }}" width="100%" height="100%" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
