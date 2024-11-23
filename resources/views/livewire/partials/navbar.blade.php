<div>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <defs>
            <symbol xmlns="http://www.w3.org/2000/svg" id="search" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="calendar" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="shopping-bag" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path
                        d="M3.977 9.84A2 2 0 0 1 5.971 8h12.058a2 2 0 0 1 1.994 1.84l.803 10A2 2 0 0 1 18.833 22H5.167a2 2 0 0 1-1.993-2.16l.803-10Z" />
                    <path d="M16 11V6a4 4 0 0 0-4-4v0a4 4 0 0 0-4 4v5" />
                </g>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="gift" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <rect width="18" height="14" x="3" y="8" rx="2" />
                    <path d="M12 5a3 3 0 1 0-3 3m6 0a3 3 0 1 0-3-3m0 0v17m9-7H3" />
                </g>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M7 4h-2a1 1 0 1 0 0 2h2l1.6 7.6a1 1 0 0 0 .98.8h8.17a1 1 0 0 0 .98-.8l1.5-6.4H6.42L7 4zm0 2h10.35l-1.2 5.1H9.62L7 6zm10.42 11a2 2 0 1 1-3.42 1.42a2 2 0 0 1 3.42-1.42zm-10 0a2 2 0 1 1-3.42 1.42a2 2 0 0 1 3.42-1.42z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M7 4h-2a1 1 0 1 0 0 2h2l1.6 7.6a1 1 0 0 0 .98.8h8.17a1 1 0 0 0 .98-.8l1.5-6.4H6.42L7 4zm0 2h10.35l-1.2 5.1H9.62L7 6zm10.42 11a2 2 0 1 1-3.42 1.42a2 2 0 0 1 3.42-1.42zm-10 0a2 2 0 1 1-3.42 1.42a2 2 0 0 1 3.42-1.42z" />
            </symbol>
        </defs>
    </svg>

    <div class="search-popup">
        <div class="search-popup-container">
            <form role="search" method="get" class="form-group" action="{{ route('search') }}">
                <input type="search" id="search-form" class="form-control border-0 border-bottom"
                    placeholder="Type and press enter" value="{{ request('query') }}" name="query" />
                <button type="submit" class="search-submit border-0 position-absolute bg-white"
                    style="top: 15px; right: 15px;">
                    <svg class="search" width="24" height="24">
                        <use xlink:href="#search"></use>
                    </svg>
                </button>
            </form>
            <h5 class="cat-list-title">Browse Categories</h5>
            <ul class="cat-list">
                @foreach ($categories as $category)
                    <li class="cat-list-item">
                        <a href="products?category={{ $category->category_slug }}"
                            title="Jackets">{{ $category->category_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    @livewire('cart')
    <script>
            document.addEventListener('DOMContentLoaded', function () {
            const cartIcon = document.getElementById('cartIcon');
            const closeCartButton = document.querySelector('[data-bs-dismiss="offcanvas"]');
            const backdrop = document.createElement('div');
            backdrop.className = 'manual-backdrop';
            backdrop.id = 'manualBackdrop';
            document.body.appendChild(backdrop);

            cartIcon.addEventListener('click', function () {
                backdrop.classList.add('show');
            });

            closeCartButton.addEventListener('click', function () {
                const backdropElement = document.getElementById('manualBackdrop');
                if (backdropElement) {
                    backdropElement.remove();
                }
            });

            document.querySelectorAll('[wire\\:click*="removeFromCart"]').forEach(button => {
                button.addEventListener('click', function () {
                    setTimeout(() => {
                        const backdropElement = document.getElementById('manualBackdrop');
                        if (!backdropElement) {
                            document.body.appendChild(backdrop);
                            backdrop.classList.add('show');
                        }
                    }, 100);
                });
            });
        });
    </script>

    <nav class="navbar navbar-expand-lg bg-light text-uppercase fs-6 p-3 border-bottom align-items-center fixed-top">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center w-100">
                <div class="col-auto">
                    <a class="navbar-brand text-white" href="home">
                        <img src="{{ asset('user/images/logo.png') }}" alt="Logo" style="width: 60px; height: auto">
                    </a>
                </div>

                <div class="col-auto">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 gap-1 gap-md-3 pe-3">
                                <li class="nav-item dropdown border-animation-left">
                                    <a class="my-0 nav-link item-anchor" href="/">Home</a>
                                </li>
                                <li class="nav-item dropdown border-animation-left">
                                    <a class="my-0 nav-link item-anchor" href="/products">Shop</a>
                                </li>
                                <li class="nav-item dropdown border-animation-left">
                                    <a class="my-0 nav-link item-anchor" href="/treatment">Treatment</a>
                                </li>
                                <li class="nav-item dropdown border-animation-left">
                                    <a class="my-0 nav-link item-anchor" href="/course">Course</a>
                                </li>
                                <li class="nav-item dropdown border-animation-left">
                                    <a class="my-0 nav-link item-anchor" href="/promo">Promo</a>
                                </li>
                                <li class="nav-item dropdown border-animation-left">
                                    <a class="my-0 nav-link item-anchor" href="/about">About</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-3 col-lg-auto">
                    <ul class="list-unstyled d-flex m-0 justify-content-end">
                        <li class="d-none d-lg-block position-relative me-3 border-animation-left">
                            @auth

                                <!-- Tombol Logout -->
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="mx-0 item-anchor">
                                        Log Out
                                    </a>
                                </form>
                            @endauth

                            <!-- Menampilkan login dan register jika belum login -->
                            @guest
                                <a href="/login" class="mx-0 item-anchor">login</a>
                                <a>/</a>
                                <a href="/register" class="mx-0 item-anchor">register</a>
                            @endguest
                        </li>

                        <!-- Icon Keranjang di Navbar -->
                        <li class="d-none d-lg-block position-relative me-3">
                            <a href="javascript:void(0)" class="mx-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" id="cartIcon">
                            <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#cart"></use>
                            </svg>
                        @auth
                            <span class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-circle bg-white text-black"
                            wire:loading.class="opacity-50">
                            {{ $cartCount }}
                            </span>
                        @endauth
                            </a>
                        </li>

                        <li class="search-box" class="mx-2">
                            <a href="#search" class="search-button">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#search"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </nav>
</div>
