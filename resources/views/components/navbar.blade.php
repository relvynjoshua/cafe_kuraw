<header class="main-header">
    <!-- START NAVIGATION AREA -->
    <div class="sticky-menu">
        <div class="mainmenu-area">
            <div class="auto-container">
                <div class="row align-items-center">
                    <!-- Navigation Links -->
                    <div class="col-lg-9 d-none d-lg-block">
                        <nav class="navbar navbar-expand-lg justify-content-start">
                            <ul class="navbar-nav">
                                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                                </li>
                                <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                                    <a href="{{ url('/about') }}" class="nav-link">About Us</a>
                                </li>
                                <li class="nav-item {{ Request::is('menu') ? 'active' : '' }}">
                                    <a href="{{ url('/menu') }}" class="nav-link">Menu</a>
                                </li>
                                <li class="nav-item {{ Request::is('gallery') ? 'active' : '' }}">
                                    <a href="{{ url('/gallery') }}" class="nav-link">Gallery</a>
                                </li>
                                <li class="nav-item {{ Request::is('reservation') ? 'active' : '' }}">
                                    <a href="{{ url('/reservation') }}" class="nav-link">Reservation</a>
                                </li>
                                <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                                    <a href="{{ url('/contact') }}" class="nav-link">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!-- Search and Profile Icons -->
                    <div class="col-lg-3 d-none d-lg-block text-end">
                        <!-- Search Icon -->
                        <a href="#" class="header-search me-3" data-bs-toggle="modal" data-bs-target="#headerSearchModal">
                            <i class="icofont-search-2"></i>
                        </a>

                        <!-- Profile Dropdown -->
                        <div class="dropdown d-inline">
                            <a href="#" class="dropdown-toggle text-decoration-none" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="icofont-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                @if(Auth::check())
                                    <li><a class="dropdown-item" href="{{ url('/profile') }}">My Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ url('/login') }}">Login</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/register') }}">Register</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Modal -->
    <div class="modal fade" id="headerSearchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form class="header-search-box">
                        <div class="row g-0 align-items-center">
                            <div class="col">
                                <input class="form-control form-control-lg" type="search" placeholder="Search..." />
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-lg header-search-btn" type="submit">
                                    <i class="icofont-search-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Search Modal -->

    <!-- END NAVIGATION AREA -->
</header>
