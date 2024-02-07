<header class="app-header border-bottom">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ri-menu-line"></i>
                </a>
            </li>
            <li class="nav-item">
                {{-- <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                    <i class="ri-notification-4-line"></i>
                    <div class="notification bg-primary rounded-circle"></div>
                </a> --}}
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link d-flex justify-content-center align-items-center"
                        href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>{{ $user->name }}</span>
                        <img src="{{ asset($user->image) }}" alt="" width="35" height="35" class="rounded-circle ms-2">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            {{-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ri-user-3-line"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a> --}}
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ri-logout-box-r-line"></i>
                                Logout
                            </a>
                        </div>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>
