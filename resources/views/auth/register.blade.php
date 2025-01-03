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
                                    <h3 class="mb-2">Registration</h3>
                                    <h3 class="fs-6 fw-normal text-secondary m-0">Enter your details to register</h3>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row gy-3 gy-md-4 overflow-hidden form-regis pt-2">

                                <!-- Name Depan -->
                                <div class="col-12">
                                    <x-input-label for="nama_depan" :value="__('Nama Depan')" />
                                    <x-text-input id="nama_depan" class="form-control" type="text" name="nama_depan"
                                        :value="old('nama_depan')" required autofocus autocomplete="nama_depan" />
                                    <div class="mt-1" style="">
                                        <x-input-error :messages="$errors->get('nama_depan')" class="text-danger small mx-0 px-1" style="list-style: none; font-size: 14px;" />
                                    </div>
                                </div>

                                <!-- Name Belakang -->
                                <div class="col-12">
                                    <x-input-label for="nama_belakang" :value="__('Nama Belakang')" />
                                    <x-text-input id="nama_belakang" class="form-control" type="text"
                                        name="nama_belakang" :value="old('nama_belakang')" required autocomplete="nama_belakang" />
                                        <div class="mt-1" style="">
                                            <x-input-error :messages="$errors->get('nama_belakang')" class="text-danger small mx-0 px-1" style="list-style: none; font-size: 14px;" />
                                        </div>
                                </div>

                                <!-- Email Address -->
                                <div class="col-12">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control" type="email" name="email"
                                        :value="old('email')" required autocomplete="username" />
                                        <div class="mt-1" style="">
                                            <x-input-error :messages="$errors->get('email')" class="text-danger small mx-0 px-1" style="list-style: none; font-size: 14px;" />
                                        </div>
                                </div>

                                <!-- Password -->
                                <div class="col-12">
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" class="form-control" type="password" name="password"
                                        required autocomplete="new-password" />
                                    <div class="mt-1" style="">
                                        <x-input-error :messages="$errors->get('password')" class="text-danger small mx-0 px-1" style="list-style: none; font-size: 14px;" />
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-12">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                    <x-text-input id="password_confirmation" class="form-control" type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
                                        <div class="mt-1" style="">
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger small mx-0 px-1" style="list-style: none; font-size: 14px;" />
                                        </div>
                                </div>

                                <!-- Checkbox for Terms and Conditions -->
                                <div class="col-12">
                                    <div class="form-check ">
                                        <input class="form-check-input ms-0" type="checkbox" id="iAgree" name="iAgree"
                                            onchange="toggleButton()" required>
                                        <label class="form-check-label border-animation-left ms-0" for="iAgree">
                                            I agree to the <a href="/termandcondition" class="item-anchor">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary" type="submit" id="signUpButton"
                                            disabled>Register</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <hr class="mt-5 mb-4 border-secondary-subtle">
                                <p class="m-0 border-animation-left text-end">Already have an account? <a
                                        href="{{ route('login') }}" class="text-decoration-none item-anchor">Log in</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleButton() {
            const checkbox = document.getElementById('iAgree');
            const button = document.getElementById('signUpButton');
            button.disabled = !checkbox.checked;
        }
    </script>
@endsection
