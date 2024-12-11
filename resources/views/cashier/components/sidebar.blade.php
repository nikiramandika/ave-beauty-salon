<!-- Sidebar -->
<aside id="sidebar"
    class="fixed left-0 top-16 h-full w-64 bg-pink-50 shadow-md transform -translate-x-full transition-transform duration-300 z-20">
    <div class="p-4">
        <nav class="space-y-2">
            <a href="/cashiers"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-pink-200
            {{ Request::is('cashiers*') ? 'bg-pink-200 text-pink-500' : 'text-pink-900' }}">
                <i class="fas fa-store"></i>
                <span>Salon Menu</span>
            </a>
            <a href="/pesanan-online"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-pink-200
                {{ Request::is('pesanan-online*') ? 'bg-pink-200 text-pink-500' : 'text-pink-900' }}">
                <i class="fas fa-shopping-bag"></i>
                <span>Online Order</span>
            </a>
            <a href="/member"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-pink-200
                {{ Request::is('member*') ? 'bg-pink-200 text-pink-500' : 'text-pink-900' }}">
                <i class="fas fa-user"></i>
                <span>Members</span>
            </a>
            <a href="/laporan-kasir"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-pink-200
                {{ Request::is('laporan*') ? 'bg-pink-200 text-pink-500' : 'text-pink-900' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Report</span>
            </a>
        </nav>
    </div>
</aside>
