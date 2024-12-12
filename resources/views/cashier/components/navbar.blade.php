<nav class="bg-pink-100 shadow-md fixed w-full z-10" >
    <div class="max-w-full mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <!-- Toggle Sidebar Button -->
                <button id="sidebarToggle" class="text-pink-900 hover:text-pink-800">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <!-- Logo & Store Name -->
                <div class="ml-4 flex items-center">
                    <img src="{{ asset('user/images/logo.png') }}" alt="Logo" class="h-8 w-8 mr-2">
                    <span class="text-xl font-montserrat font-semibold text-[#63374d]">Ave Beauty Salon</span>
                </div>
            </div>
            <!-- User Profile -->
            <div class="flex items-center">
                <span class="text-gray-700 mr-1">Hello, {{ Auth::user()->nama_depan }}  | </span>
                @auth
                    <!-- Tombol Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="font-bold text-red-700  mr-2">
                            Log Out
                        </a>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
