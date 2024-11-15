<!-- Sidebar -->
<aside id="sidebar"
    class="fixed left-0 top-16 h-full w-64 bg-white shadow-md transform transition-transform duration-300 z-20">
    <div class="p-4">
        <nav class="space-y-2">
            <!-- Menu Toko with Dropdown -->
            <details class="group"
                {{ Request::is('cashier*') || Request::is('cashier/treatments*') || Request::is('cashier/promos*') ? 'open' : '' }}>
                <summary
                    class="flex items-center space-x-2 p-2 rounded-lg cursor-pointer 
                    {{ Request::is('cashier*') || Request::is('cashier/treatments*') || Request::is('cashier/promos*') ? 'bg-blue-50 text-blue-700' : '' }}">
                    <i class="fas fa-store"></i>
                    <span>Menu Toko</span>
                </summary>
                <!-- Dropdown Items -->
                <div class="pl-6 space-y-1 mt-1">
                    <a href="/cashier"
                        class="flex items-center space-x-2 block p-2 rounded-lg hover:bg-gray-100 
                        {{ Request::is('cashier*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        <i class="fas fa-box"></i> <!-- Ikon untuk Products -->
                        <span>Products</span>
                    </a>
                    <a href="/cashier/treatments"
                        class="flex items-center space-x-2 block p-2 rounded-lg hover:bg-gray-100 
                        {{ Request::is('cashier/treatments*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        <i class="fas fa-spa"></i> <!-- Ikon untuk Treatments -->
                        <span>Treatments</span>
                    </a>
                    <a href="/cashier/promos"
                        class="flex items-center space-x-2 block p-2 rounded-lg hover:bg-gray-100 
                        {{ Request::is('cashier/promos*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        <i class="fas fa-tags"></i> <!-- Ikon untuk Promos -->
                        <span>Promos</span>
                    </a>
                </div>
            </details>

            <!-- Other Menu Items -->
            <a href="/pesanan-online"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 
                {{ Request::is('pesanan-online*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                <i class="fas fa-shopping-bag"></i>
                <span>Pesanan Online</span>
            </a>
            <a href="/laporan"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 
                {{ Request::is('laporan*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan</span>
            </a>
            <a href="/setting"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 
                {{ Request::is('setting*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </nav>
    </div>
</aside>