<!-- START HEADER SECTION -->
<header class="main-header">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/notif-customer.js') }}"></script>

    <!-- START LOGO AREA -->
    <div class="logo-area">
        <div class="auto-container">
            <div class="row align-items-center">
                <!-- Logo Section -->
                <div class="col-lg-3 col-12 text-lg-left text-center mb-lg-0 mb-4">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img class="img-fluid" src="{{ asset('assets/img/kuraw/logo.jpg') }}" alt=""
                                style="max-width: 150px; height: auto;"> <!-- Smaller logo size -->
                        </a>
                    </div>
                </div>
                <!-- Header Info Section -->
                <div class="col-lg-9 col-12">
                    <div class="header-info d-flex justify-content-around align-items-center flex-wrap">
                        <div class="header-info-box text-center">
                            <div class="header-info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h5>Connect With Us</h5>
                            <p>kurawcafe@gmail.com</p>
                        </div>
                        <div class="header-info-box text-center">
                            <div class="header-info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <h5>Call For Inquiry</h5>
                            <p>0956 165 7495</p>
                        </div>
                        <div class="header-info-box text-center">
                            <div class="header-info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h5>Opening Hours</h5>
                            <p>Mon - Thu : 10AM - 7PM <br>Fri - Sat : 10AM - 8PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGO AREA -->

    <!-- START NAVIGATION AREA -->
    <div class="mainmenu-area bg-theme">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/about') }}"
                                class="nav-link {{ Request::is('about') ? 'active' : '' }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gallery.index') }}"
                                class="nav-link {{ request()->routeIs('gallery.index') ? 'active' : '' }}">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/menu') }}"
                                class="nav-link {{ Request::is('menu') ? 'active' : '' }}">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/orders') }}"
                                class="nav-link {{ Request::is('orders') ? 'active' : '' }}">Order</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/reservation') }}"
                                class="nav-link {{ Request::is('reservation') ? 'active' : '' }}">Reservation</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/contact') }}"
                                class="nav-link {{ Request::is('contact') ? 'active' : '' }}">Contact</a>
                        </li>
                    </ul>

                    <!-- Notification Bell Icon -->
                    <a href="#" class="header-notification me-3" id="notificationDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        @if(auth()->check() && session()->has('notification_count'))
                            <span id="notification-badge"
                                class="position-absolute top-20 translate-middle badge rounded-pill bg-danger">
                                {{ session('notification_count', auth()->user()->unreadNotifications()->count()) }}
                            </span>
                        @endif
                    </a>

                    <!-- Notifications Dropdown -->
                    <div class="dropdown-menu dropdown-menu-end bg-white shadow border-0"
                        aria-labelledby="notificationDropdown"
                        style="width: 500px; position: absolute; top: 60%; z-index: 1050;">
                        <div class="dropdown-item text-dark text-center"
                            style="font-weight: bold; background-color: #f8f9fa;">
                            Notifications
                        </div>

                        @if(auth()->check())
                            <div id="notification-list">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    @if($notification->type === 'App\Notifications\OrderStatusNotification')
                                        <a class="dropdown-item text-dark notification-item"
                                            id="notification-{{ $notification->id }}" data-notification-id="{{ $notification->id }}"
                                            data-order-id="{{ $notification->data['order_id'] }}" href="javascript:void(0)"
                                            onclick="markAsRead(event, '{{ $notification->id }}', '{{ csrf_token() }}', '{{ route('notifications.mark-read', ['notificationId' => $notification->id]) }}')">
                                            <strong>Order #{{ $notification->data['order_id'] }}</strong>:
                                            {{ $notification->data['message'] }}
                                        </a>
                                    @elseif($notification->type === 'App\Notifications\NewReservationNotification' || $notification->type === 'App\Notifications\ReservationStatusUpdated')
                                        <a class="dropdown-item text-dark notification-item"
                                            id="notification-{{ $notification->id }}" data-notification-id="{{ $notification->id }}"
                                            data-reservation-id="{{ $notification->data['reservation_id'] }}"
                                            href="javascript:void(0)"
                                            onclick="markAsRead(event, '{{ $notification->id }}', '{{ csrf_token() }}', '{{ route('notifications.mark-read', ['notificationId' => $notification->id]) }}')">
                                            <strong>Reservation #{{ $notification->data['reservation_id'] }}</strong>:
                                            {{ $notification->data['message'] }}
                                        </a>
                                    @endif
                                @empty
                                    <p class="dropdown-item text-center">No new notifications</p>
                                @endforelse
                            </div>

                            @if(session()->has('notification_count') && auth()->user()->unreadNotifications->isNotEmpty())
                                <!-- Mark All Read Button -->
                                <form id="mark-all-read-form" action="{{ route('notifications.mark-read') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" id="see-all-notifications" class="dropdown-item text-dark text-center"
                                    style="font-weight: bold; margin-top: 20px; background-color: #B7C9E2;"
                                    onclick="markAllAndRedirect(event)">See All Notifications</a>
                            @endif
                        @else
                            <p class="dropdown-item text-center">No notifications available</p>
                        @endif
                    </div>


                    <!-- Order Details Modal -->
                    <div class="modal fade" id="orderDetailsModal" tabindex="-1"
                        aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" style="width: 800px;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Variation</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="modalProducts">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reservation Details Modal -->
                    <div class="modal fade" id="reservationDetailsModal" tabindex="-1"
                        aria-labelledby="reservationDetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" style="width: 800px;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reservationDetailsModalLabel">Reservation Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Reservation Date</th>
                                                <th>Time</th>
                                                <th>Guests</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="modalReservationDetails">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Cart Icon -->
                    <a href="{{ url('/cart') }}" class="header-cart me-3 position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <!-- Badge for Cart Count -->
                        <span id="cart-badge"
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ session('cart_count', 0) }}
                        </span>
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-dark" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-white shadow border-0"
                            aria-labelledby="profileDropdown" style="width: 200px;">
                            @if(Auth::check())
                                <li class="dropdown-header bg-black text-white py-3 px-3">
                                    <strong style="font-size: 1.25rem; font-family: 'Arial', sans-serif;">Hello,
                                        {{ Auth::user()->firstname }}</strong>
                                </li>
                                <li>
                                    <hr class="dropdown-divider my-1">
                                </li>
                                <li><a class="dropdown-item text-dark" href="{{ route('profile') }}">My Profile</a></li>
                                <li><a class="dropdown-item text-dark" href="{{ route('rewards') }}">My Rewards</a></li>
                                <li class="dropdown-item text-dark">
                                    <form action="{{ route('logout.user') }}" method="POST" class="dropdown-item m-0 p-0">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-dark p-0 m-0">Logout</button>
                                    </form>
                                </li>
                            @else
                                <li><a class="dropdown-item text-dark" href="{{ url('/login-signup') }}">Login</a></li>
                                <li><a class="dropdown-item text-dark" href="{{ url('/login-signup') }}">Register</a></li>
                            @endif
                        </ul>
                    </div>

                </div>
        </div>
        </nav>
    </div>
    </div>

    <!-- END NAVIGATION AREA -->
</header>
<!-- END HEADER SECTION -->
<script>
    $(document).ready(function () {
        forceRefreshNotificationBadge(); // Refresh the notification badge on page load
    });
</script>