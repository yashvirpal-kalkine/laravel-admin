<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <img src="{{ asset('backend/assets/img/AdminLTELogo.png') }}" alt="{{ config('app.name') }}"
                class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">{{ config('app.name') }}</span>
        </a>

    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
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

                <li class="nav-item">
                    <a href="{{ route('admin.transactions.index') }}"
                        class="nav-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-currency-dollar"></i>
                        <p>Transactions</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.ecommerce.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.ecommerce.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-cart4"></i>
                        <p>E-Commerce <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.product-categories.index') }}"
                                class="nav-link {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-tags"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product-tags.index') }}"
                                class="nav-link {{ request()->routeIs('admin.product-tags.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-tag"></i>
                                <p>Tags</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}"
                                class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-box-seam"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.index') }}"
                                class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-bag-check"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.invoices.index') }}"
                                class="nav-link {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-receipt"></i>
                                <p>Invoices</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.coupons.index') }}"
                                class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-receipt"></i>
                                <p>Coupon</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item {{ request()->routeIs('admin.blog.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-journal-text"></i>
                        <p>Blogs <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.blog-categories.index') }}"
                                class="nav-link {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-folder2-open"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blog-tags.index') }}"
                                class="nav-link {{ request()->routeIs('admin.blog-tags.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-tags"></i>
                                <p>Tags</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blog-posts.index') }}"
                                class="nav-link {{ request()->routeIs('admin.blog-posts.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-file-earmark-text"></i>
                                <p>Posts</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ route('admin.pages.index') }}"
                        class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-layout-text-window-reverse"></i>
                        <p>Pages</p>
                    </a>
                </li>



            </ul>
        </nav>
    </div>
</aside>
<!--end::Sidebar-->