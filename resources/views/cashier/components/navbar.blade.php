<nav class="bg-white shadow-md fixed w-full z-10">
    <div class="max-w-full mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <!-- Toggle Sidebar Button -->
                <button id="sidebarToggle" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <!-- Logo & Store Name -->
                <div class="ml-4 flex items-center">
                    <img src="/logo.png" alt="Logo" class="h-8 w-8 mr-2">
                    <span class="font-bold text-xl">Ave Beauty Salon</span>
                </div>
            </div>
            <!-- User Profile -->
            <div class="flex items-center">
                <span class="text-gray-700 mr-2">Halo, {{Auth::user()->nama_depan}}</span>
            </div>
        </div>
    </div>
</nav>