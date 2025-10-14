<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <img src="{{ asset('backend/assets/img/AdminLTELogo.png') }}" alt="{{ config('app.name') }}" class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">{{ config('app.name') }}</span>
        </a>

    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ isActiveRoute('admin.dashboard') }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ isActiveRoute('admin.users.*') }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Users</p>
                    </a>
                </li>
                {{-- <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-people"></i>
                    <p>
                        Users
                        <i class="end bi bi-chevron-down"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                            <i class="bi bi-circle nav-icon"></i>
                            <p>All Users</p>
                        </a>
                    </li>
                </ul>
                </li> --}}

                <!-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link active">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="./generate/theme.html" class="nav-link">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Theme Generate</p>
                    </a>
                </li> -->
            </ul>
        </nav>
    </div>
</aside>
<!--end::Sidebar-->