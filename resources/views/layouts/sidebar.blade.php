<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <div class="text-nowrap logo-img mt-3">
                <h1 class="text-primary">RUPP</h1>
                <h5>--Web Application</h5>
            </div>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ri-close-line fs-4"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ri-dashboard-line fs-5"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Products</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('category.index') }}" aria-expanded="false">
                        <span>
                            <i class="ri-menu-search-line fs-5"></i>
                        </span>
                        <span class="hide-menu">Categories</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('product.index') }}" aria-expanded="false">
                        <span>
                            <i class="ri-box-3-line fs-5"></i>
                        </span>
                        <span class="hide-menu">Products</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Features</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('slide.index') }}" aria-expanded="false">
                        <span>
                            <i class="ri-slideshow-3-line fs-5"></i>
                        </span>
                        <span class="hide-menu">Slides</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('blog.index') }}" aria-expanded="false">
                        <span>
                            <i class="ri-article-line fs-5"></i>
                        </span>
                        <span class="hide-menu">Blogs</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">System Setting</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('users.index') }}" aria-expanded="false">
                        <span>
                            <i class="ri-user-settings-line fs-5"></i>
                        </span>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
