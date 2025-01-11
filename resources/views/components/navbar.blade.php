<!-- START HEADER SECTION -->
<header class="main-header">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/notifications.js') }}"></script>
    <script src="{{ asset('assets/js/notif-customer.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle (Includes Popper.js for positioning) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


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
            <div class="navbar navbar-expand-lg navbar-dark">
                <!-- Hamburger Menu (Toggler) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Menu -->
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
                    <div class="icon-group-container">
                        <div class="icon-group">
                            <a href="#" class="header-notification me-3" id="notificationDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                @if(auth()->check() && session()->has('notification_count'))
                                    <span id="notification-badge"
                                        class="position-absolute top-0 start-95 translate-middle badge rounded-pill bg-danger">
                                        {{ session('notification_count', auth()->user()->unreadNotifications()->count()) }}
                                    </span>
                                @endif
                            </a>
                            <!-- Notifications Dropdown -->
                            <div class="dropdown-menu dropdown-menu-end bg-white shadow border-0"
                                aria-labelledby="notificationDropdown"
                                style="width: 470px; position: absolute; margin-top: -2%; margin-left: 50%; z-index: 1050;">

                                <div class="dropdown-item text-dark text-center"
                                    style="font-weight: bold; background-color: #f8f9fa; cursor: pointer;">
                                    Notifications
                                </div>

                                @if(auth()->check())
                                    <div id="notification-list" style="padding-bottom: 10px;">
                                        <!-- Notifications will be dynamically loaded here -->
                                    </div>

                                    <!-- Separate container for the "Mark All Read" button -->
                                    <div id="mark-all-read-container" style="margin-top: 5;">
                                        <!-- This creates margin between list and button -->
                                        <!-- Mark All Read Button -->
                                        <form id="mark-all-read-form" action="{{ route('notifications.mark-read') }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a href="#" id="see-all-notifications" class="dropdown-item text-dark text-center"
                                            style="font-weight: bold; background-color: #B7C9E2; cursor: pointer; text-align: center; bottom:0;"
                                            onclick="markAllAndRedirect(event)">
                                            Mark All Read Notifications
                                        </a>
                                    </div>
                                @else
                                    <p class="dropdown-item text-center" style="cursor: pointer;">No notifications available
                                    </p>
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
                                            <h5 class="modal-title" id="reservationDetailsModalLabel">Reservation
                                                Details</h5>
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
                                    class="position-absolute top-0 start-95 translate-middle badge rounded-pill bg-danger">
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
                                            <strong style="font-size: 1.25rem; font-family: 'Arial', sans-serif;">
                                                Hello, {{ Auth::user()->firstname }}
                                            </strong>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider my-1">
                                        </li>
                                        <li><a class="dropdown-item text-dark" href="{{ route('profile') }}">My Profile</a>
                                        </li>
                                        <li><a class="dropdown-item text-dark" href="{{ route('rewards') }}">My Rewards</a>
                                        </li>
                                        <li class="dropdown-item text-dark">
                                            <form action="{{ route('logout.user') }}" method="POST"
                                                class="dropdown-item m-0 p-0">
                                                @csrf
                                                <button type="submit" class="btn btn-link text-dark p-0 m-0">Logout</button>
                                            </form>
                                        </li>
                                    @else
                                        <li><a class="dropdown-item text-dark" href="{{ url('/login-signup') }}">Login</a>
                                        </li>
                                        <li><a class="dropdown-item text-dark"
                                                href="{{ url('/login-signup') }}">Register</a>
                                        </li>
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

<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
    }

    .main-header {
        width: 100%;
    }

    /* Logo Area */
    .logo-area {
        padding: 15px 0;
        background-color: #f8f9fa;
    }

    .logo img {
        max-width: 100%;
        height: auto;
    }

    .header-info {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
    }

    .header-info-box {
        flex: 1;
        margin: 10px;
    }

    .header-info-box h5 {
        margin-top: 10px;
        font-size: 1rem;
        color: #333;
    }

    .header-info-box p {
        font-size: 0.9rem;
        /* Keep the font size as is */
        color: #ddd;
        /* A slightly darker shade of gray */
        font-weight: bold;
        /* Keep the text bold */
    }

    .header-info-icon {
        font-size: 1.5rem;
        color: #007bff;
    }

    /* Navigation Area */
    .mainmenu-area {
        background-color: #343a40;
        padding: 10px 0;
    }

    .navbar {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .navbar-toggler {
        color: #fff;
        /* Icon color (white) for contrast */
        font-size: 2rem;
        /* Larger size for the burger icon */
        background-color: #000 !important;
        /* Ensure the background is fully black */
        border: 3px solid #000;
        /* Black border for consistent black appearance */
        border-radius: 12px;
        /* Rounded corners for a clean look */
        padding: 12px 18px;
        /* Adjust padding to make the button larger */
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.7);
        /* Strong shadow for visibility */
        cursor: pointer;
        /* Pointer cursor for interactivity */
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        /* Smooth animations */
    }

    .navbar-toggler:hover {
        transform: scale(1.2);
        /* Increase size on hover */
        background-color: #000;
        /* Retain black background */
        border-color: #000;
        /* Retain black border */
        box-shadow: 0 12px 25px rgba(0, 0, 0, 1);
        /* Stronger shadow on hover */
        color: #fff;
        /* Keep icon color white for visibility */
    }

    .navbar-toggler:focus {
        outline: none;
        /* Remove default focus outline */
        background-color: #000;
        /* Retain black background */
        border-color: #fff;
        /* Add white border for focus effect */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 1), 0 0 10px rgba(255, 255, 255, 0.8);
        /* Prominent shadow with glow */
    }

    .navbar-nav {
        display: flex;
        flex-direction: row;
        list-style: none;
        padding-left: 0;
        margin: 0;
    }

    .nav-item {
        margin: 0 10px;
    }

    .nav-link {
        color: black;
        text-decoration: none;
        font-size: 1rem;
        transition: color 0.3s;
    }

    .nav-link.active,
    .nav-link:hover {
        color: black;
    }


    /* Parent container for all icons */
    .icon-group {
        position: relative;
        /* Makes dropdown position relative to this container */
        display: flex;
        /* Ensures horizontal alignment of icons */
        align-items: center;
        justify-content: center;
        gap: 15px;
        /* Space between icons */
    }



    /* Individual icon styles */
    .header-notification,
    .header-cart,
    .dropdown-toggle {
        position: relative;
        /* For positioning badges */
        font-size: 1.5rem;
        /* Icon size */
        color: black;
        /* Icon color */
        text-decoration: none;
        /* Remove underline for links */
        display: flex;
        /* Ensure icons align horizontally */
        align-items: center;
        /* Center content inside the icon */
        justify-content: center;
        /* Center content inside the icon */
        width: 40px;
        /* Uniform width for icons */
        height: 40px;
        /* Uniform height for icons */
        cursor: pointer;
        /* Change cursor to pointer for interactivity */
    }

    /* Badge for notifications */
    #notification-badge {
        position: absolute;
        top: -5px;
        /* Vertical position of the badge */
        right: -5px;
        /* Horizontal position of the badge */
        background-color: #dc3545;
        /* Red background */
        color: #fff;
        /* White text for the badge */
        font-size: 0.75rem;
        /* Badge text size */
        padding: 2px 6px;
        /* Inner padding for badge */
        border-radius: 50%;
        /* Circular badge */
        line-height: 1;
        /* Uniform badge height */
    }

    /* Badge for cart count */
    #cart-badge {
        position: absolute;
        top: -5px;
        /* Vertical position of the badge */
        right: -5px;
        /* Horizontal position of the badge */
        background-color: #dc3545;
        /* Red background */
        color: #fff;
        /* White text for the badge */
        font-size: 0.75rem;
        /* Badge text size */
        padding: 2px 6px;
        /* Inner padding for badge */
        border-radius: 50%;
        /* Circular badge */
        line-height: 1;
        /* Uniform badge height */
    }

    /* Profile dropdown */
    .dropdown-toggle {
        font-size: 1.5rem;
        /* Icon size */
        color: black;
        /* Icon color */
        cursor: pointer;
        /* Pointer cursor for interactivity */
    }

    @media (max-width: 768px) {
        .icon-group {
            justify-content: space-around;
            /* Distribute icons evenly */
            flex-wrap: nowrap;
            /* Prevent stacking */
        }
    }


    /* General Dropdown Menu Styles */
    .dropdown-menu {
        border-radius: 8px;
        /* Smooth corners */
        padding: 10px;
        /* Inner spacing */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        /* Subtle shadow */
        max-width: 250px;
        /* Set a reasonable width */
        width: auto;
        /* Adjust to content size */
        z-index: 1050;
        /* Place above other content */
        background-color: #fff;
        /* White background for contrast */
    }

    /* Position Dropdown Below the Bell Icon */
    .dropdown-below {
        position: absolute;
        /* Absolute positioning */
        top: 100%;
        /* Place directly below the bell icon */
        left: 50%;
        /* Center-align dropdown with the bell */
        transform: translateX(-50%);
        /* Offset to ensure alignment */
        margin-top: 5px;
        /* Minimal space between dropdown and bell */
    }

    /* Dropdown Menu Styling */
    .dropdown-menu {
        position: absolute;
        top: 120%;
        /* Position right below the bell icon */
        left: 50%;
        /* Center align the dropdown with the bell icon */
        transform: translateX(-50%);
        /* Adjust for perfect centering */
        width: auto;
        /* Adjust width automatically to content */
        max-width: 350px;
        /* Optional: Limit the width */
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        /* Add shadow for depth */
        background-color: #fff;
        /* White background for the dropdown */
        z-index: 1050;
    }


    /* Dropdown Items */
    .dropdown-item {
        padding: 10px 15px;
        /* Add padding for better usability */
        font-size: 1rem;
        /* Ensure text is readable */
        text-align: left;
        /* Align text to the left */
        color: #000;
        /* Black text for visibility */
        transition: background-color 0.3s ease;
        /* Smooth hover effect */
    }

    .dropdown-item:hover {
        background-color: #f0f0f0;
        /* Highlight on hover */
        color: #333;
        /* Slightly darker text on hover */
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .dropdown-menu {
            width: 90%;
            /* Use 90% of the screen width on smaller screens */
            left: 5%;
            /* Center dropdown horizontally on smaller screens */
            transform: none;
            /* Remove transform for smaller screens */
        }

        .dropdown-item {
            padding: 12px 20px;
            /* Increase padding for touch-friendly items */
            font-size: 1.1rem;
            /* Slightly larger font size */
        }
    }

    @media (max-width: 480px) {
        .dropdown-menu {
            width: 100%;
            /* Utilize full width */
            left: 0;
            /* Align to the left edge */
            padding: 15px;
            /* Add inner padding */
        }

        .dropdown-item {
            font-size: 1rem;
            /* Keep text size readable */
        }
    }


    /* Modal */
    .modal-content {
        padding: 20px;
        border-radius: 5px;
    }

    .table-bordered {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .header-info {
            flex-direction: column;
            align-items: center;
        }

        .header-info-box {
            text-align: center;
        }

        .navbar-nav {
            flex-direction: column;
            align-items: center;
        }

        .nav-item {
            margin: 5px 0;
        }

        .icon-group {
            flex-direction: row;
            justify-content: center;
            gap: 15px;
            align-items: center;
        }
    }

    @media (max-width: 768px) {
        .logo-area {
            text-align: center;
        }

        .header-info {
            flex-wrap: wrap;
        }

        .navbar-toggler {
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .icon-group {
            flex-direction: row;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }
    }

    @media (max-width: 576px) {
        .header-info-box {
            flex: 1 0 100%;
            margin: 10px 0;
        }

        .dropdown-menu {
            width: 100%;
            left: 0;
            right: 0;
        }

        .icon-group {
            flex-direction: row;
            justify-content: center;
            gap: 8px;
            align-items: center;
        }
    }

    /* Additional Styles */
    @media (max-width: 480px) {
        .header-info {
            padding: 10px;
        }

        .navbar-toggler {
            font-size: 1.25rem;
            color: #000 !important;
            text-align: center;
        }

        .nav-link {
            font-size: 0.9rem;
        }

        .badge {
            font-size: 0.65rem;
            padding: 1px 4px;
        }

        .modal-content {
            padding: 15px;
        }

        .icon-group {
            flex-direction: row;
            justify-content: center;
            gap: 5px;
            align-items: center;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notificationList = document.getElementById('notification-list');
        const markAllReadContainer = document.getElementById('mark-all-read-container'); // Get the "Mark All Read" container

        function fetchNotifications() {
            fetch('/notifications/fetch', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    notificationList.innerHTML = ''; // Clear current list
                    let unreadNotificationsCount = 0; // Counter for unread notifications
                    if (data.length > 0) {
                        data.forEach(notification => {
                            const notificationItem = document.createElement('a');
                            notificationItem.classList.add('dropdown-item', 'text-dark', 'notification-item');
                            notificationItem.setAttribute('id', `notification-${notification.id}`);
                            notificationItem.setAttribute('data-notification-id', notification.id);
                            notificationItem.innerHTML = `${notification.data.message}`;

                            // Check if order_id is present
                            if (notification.data.order_id) {
                                notificationItem.setAttribute('data-order-id', notification.data.order_id);
                                notificationItem.innerHTML = `<strong>Order #${notification.data.order_id}</strong>: ${notification.data.message}`;
                                notificationItem.onclick = function () {
                                    markAsRead(event, notification.id, document.querySelector('meta[name="csrf-token"]').getAttribute('content'), '/notifications/mark-read/' + notification.id);
                                };
                            }

                            // Check if reservation_id is present
                            if (notification.data.reservation_id) {
                                notificationItem.setAttribute('data-reservation-id', notification.data.reservation_id);
                                notificationItem.innerHTML = `<strong>Reservation #${notification.data.reservation_id}</strong>: ${notification.data.message}`;
                                notificationItem.onclick = function () {
                                    markAsRead(event, notification.id, document.querySelector('meta[name="csrf-token"]').getAttribute('content'), '/notifications/mark-read/' + notification.id);
                                };
                            }

                            // Add hover and click effects
                            notificationItem.style.cursor = 'pointer';
                            notificationItem.style.transition = 'all 0.3s ease';
                            notificationItem.style.padding = '10px 15px';
                            notificationItem.style.borderRadius = '5px';

                            notificationItem.onmouseover = function () {
                                this.style.boxShadow = '0px 4px 10px rgba(0, 0, 0, 0.1)';
                            };
                            notificationItem.onmouseout = function () {
                                this.style.boxShadow = 'none';
                            };

                            // Handle selection on click
                            notificationItem.onclick = function () {
                                // Remove "selected" state from any previously selected items
                                const previouslySelected = document.querySelector('.selected');
                                if (previouslySelected) {
                                    previouslySelected.classList.remove('selected');
                                    previouslySelected.style.backgroundColor = ''; // Remove background color
                                }

                                // Set this item as selected
                                this.classList.add('selected');
                                this.style.backgroundColor = '#e0e0e0'; // Set background color on click (indicates selection)

                                // Mark as read logic here
                                markAsRead(event, notification.id, document.querySelector('meta[name="csrf-token"]').getAttribute('content'), '/notifications/mark-read/' + notification.id);
                            };

                            notificationList.appendChild(notificationItem);

                            // Check if notification is unread (e.g., based on status)
                            if (!notification.read_at) {
                                unreadNotificationsCount++;
                            }
                        });
                    } else {
                        notificationList.innerHTML = '<p class="dropdown-item text-center">No new notifications</p>';
                    }

                    // Show or hide the "Mark All Read" button based on unread notifications
                    if (unreadNotificationsCount > 0) {
                        markAllReadContainer.style.display = 'block'; // Show the button
                    } else {
                        markAllReadContainer.style.display = 'none'; // Hide the button
                    }
                })
                .catch(error => console.error('Error fetching notifications:', error));
        }

        // Fetch notifications every 2 seconds
        setInterval(fetchNotifications, 2000);

        // Initial fetch when the page loads
        fetchNotifications();
    });

    // Function to mark all notifications as read
    function markAllAndRedirect(event) {
        event.preventDefault(); // Prevent default behavior
        document.getElementById('mark-all-read-form').submit(); // Submit the form to mark all as read

        // Optionally, you can update the notification list or count here
        updateNotificationCount();
    }

    // Function to update the notification count after marking as read
    function updateNotificationCount() {
        fetch('/notifications/count')
            .then(response => response.json())
            .then(data => {
                const notificationBadge = document.getElementById('notification-badge');
                notificationBadge.innerText = data.count; // Update the badge with new count
                notificationBadge.style.display = data.count > 0 ? 'inline' : 'none'; // Hide badge if no notifications
            })
            .catch(error => console.error('Error updating notification count:', error));
    }
</script>