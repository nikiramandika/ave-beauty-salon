<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/dashboard-owner" class="app-brand-link">
            <img src="{{ asset('user/images/logo.png') }}" style="width: 50px; border-radius:15px" alt="Ave-Beauy">
            <span class="app-brand-text demo menu-text fw-bold ms-2" style="font-size: 17px;">Ave Beauty Salon</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ Request::is('dashboard-owner*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
                <span class="badge rounded-pill bg-danger ms-auto">5</span>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('dashboard-owner') ? 'active' : '' }}">
                    <a href="/dashboard-owner" class="menu-link">
                        <div class="text-truncate" data-i18n="Analytics">Analytics</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Management -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Management</span>
        </li>

        <li
            class="menu-item {{ Request::is('users*') || Request::is('cashiers-owner') || Request::is('members-owner') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate" data-i18n="Authentications">User Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('users-owner') ? 'active' : '' }}">
                    <a href="/users-owner" class="menu-link">
                        <div class="text-truncate" data-i18n="Basic">Users</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('cashiers-owner') ? 'active' : '' }}">
                    <a href="/cashiers-owner" class="menu-link">
                        <div class="text-truncate" data-i18n="Basic">Cashiers</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('members-owner') ? 'active' : '' }}">
                    <a href="/members-owner" class="menu-link">
                        <div class="text-truncate" data-i18n="Basic">Members</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ Request::is('categories*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div class="text-truncate" data-i18n="Authentications">Categories</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('categories-owner') ? 'active' : '' }}">
                    <a href="/categories-owner" class="menu-link">
                        <div class="text-truncate" data-i18n="Basic">Product</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- <!-- Categories Product -->
        <li class="menu-item {{ Request::is('categories-owner*') ? 'active' : '' }}">
            <a href="/categories-owner" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div class="text-truncate" data-i18n="Basic">Categories Product</div>
            </a>
        </li> --}}

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Transaction Report</span>
        </li>
        <li class="menu-item {{ Request::is('transaction-report*') ? 'active' : '' }}">
            <a href="/transaction-report" class="menu-link">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div class="text-truncate" data-i18n="Basic">Transaction Report</div>
            </a>
        </li>
        <!-- Products & Services -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Products &amp; Services</span>
        </li>
        <li class="menu-item {{ Request::is('products-owner*') ? 'active' : '' }}">
            <a href="/products-owner" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div class="text-truncate" data-i18n="Basic">Products</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('treatments-owner*') ? 'active' : '' }}">
            <a href="/treatments-owner" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-plus"></i>
                <div class="text-truncate" data-i18n="Basic">Treatments</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('courses-owner*') ? 'active' : '' }}">
            <a href="/courses-owner" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                <div class="text-truncate" data-i18n="Basic">Courses</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('promos-owner*') ? 'active' : '' }}">
            <a href="/promos-owner" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-discount"></i>
                <div class="text-truncate" data-i18n="Basic">Promos</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Courses</span>
        </li>
        <li class="menu-item {{ Request::is('course-registration*') ? 'active' : '' }}">
            <a href="/course-registration" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div class="text-truncate" data-i18n="Basic">Course Registration</div>
            </a>
        </li>

        <!-- Logs -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Logs</span>
        </li>
        <li class="menu-item">
            <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-notepad"></i>
                <div class="text-truncate" data-i18n="Basic">Logs</div>
            </a>
        </li>
    </ul>

</aside>
