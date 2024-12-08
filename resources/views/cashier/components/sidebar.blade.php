<!-- Sidebar -->
<aside id="sidebar"
    class="fixed left-0 top-16 h-full w-64 bg-white shadow-md transform -translate-x-full transition-transform duration-300 z-20">
    <div class="p-4">
        <nav class="space-y-2">
            <a href="/cashiers"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 
            {{ Request::is('cashiers*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                <i class="fas fa-store"></i>
                <span>Menu Salon</span>
            </a>
            <a href="/pesanan-online"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 
                {{ Request::is('pesanan-online*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                <i class="fas fa-shopping-bag"></i>
                <span>Pesanan Online</span>
            </a>
            <a href="/member"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 
                {{ Request::is('member*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                <i class="fas fa-user"></i>
                <span>member</span>
            </a>
            <a href="/laporan-kasir"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 
                {{ Request::is('laporan*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan</span>
            </a>
        </nav>
    </div>
</aside>
