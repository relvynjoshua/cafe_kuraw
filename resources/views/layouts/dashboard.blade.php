<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kuraw Cafe</title>

    <!-- Include your Bootstrap or CSS links here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
    /* Default Sidebar Styles */
    #sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        background: black;
        color: #fff;
        overflow-y: auto;
        transition: all 0.3s ease-in-out;
        z-index: 1000;
    }

    #sidebar .brand {
        padding: 20px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #sidebar ul.side-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #sidebar ul.side-menu li a {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        color: #ddd;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    #sidebar ul.side-menu li a:hover {
        background: #333;
        color: #fff;
    }

    #content {
        margin-left: 250px;
        transition: margin-left 0.3s ease-in-out;
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        #sidebar {
            width: 70px; /* Collapse to icon-only view */
        }

        #sidebar .brand span.text,
        #sidebar ul.side-menu li a span.text {
            display: none; /* Hide text labels */
        }

        #content {
            margin-left: 70px; /* Adjust content margin */
        }
    }

    /* Small Screens */
    @media screen and (max-width: 480px) {
        #sidebar {
            width: 100%; /* Sidebar takes full width on mobile */
            height: auto;
            position: relative;
        }

        #content {
            margin-left: 0;
        }
    }

    /* Dropdown Styles */
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px; /* Adjusted spacing */
        height: 60px; /* Consistent height for the navbar */
        background-color: #000; /* Navbar background color */
        color: #fff; /* Text color */
    }

    .nav-icons {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px; /* Reduced gap for tighter spacing */
        margin-left: auto;
    }

    .notification {
        position: relative;
    }

    .notification .num {
        position: absolute;
        background-color: red;
        color: white;
        font-size: 0.75rem;
        font-weight: bold;
        border-radius: 50%;
        padding: 3px 6px;
        min-width: 18px;
        height: 18px;
        display: flex;
        justify-content: center;
        align-items: center;
        top: -5px;
        right: -5px;
        z-index: 10;
        pointer-events: none;
    }

    .profile {
        color: #E8E4D9;
        font-size: 1.3rem; /* Slightly smaller profile icon */
        cursor: pointer;
    }

    .dropdown-menu {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        min-width: 180px; /* Reduced width */
    }

    .dropdown-item {
        padding: 8px 16px; /* Reduced padding */
        font-size: 0.85rem; /* Adjusted font size */
        color: #333;
        text-decoration: none;
        display: block;
        transition: background-color 0.2s ease-in-out;
    }

    .dropdown-item:hover {
        background-color: rgb(196, 196, 196);
        color: rgb(14, 14, 15);
    }

    .dropdown-item i {
        margin-right: 6px; /* Reduced spacing */
    }

    .profile-icon {
        cursor: pointer;
        color: #E8E4D9;
        font-size: 1.3rem; /* Adjusted size */
        margin-right: 10px;
        position: relative;
    }

    .brand {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: inherit;
        padding: 10px;
        border-radius: 5px;
    }

    .brand i {
        font-size: 2rem;
        margin-right: 10px;
        /* Add spacing between the icon and text */
    }

    .brand span.text {
        font-weight: bold;
        color: #fff;
        /* Keep text color white */
        font-size: 2rem;
        /* Adjust font size if necessary */
    }

    /* Responsive design */
    @media screen and (max-width: 768px) {
        .brand {
            justify-content: center;
            padding: 8px;
        }

        .brand i {
            font-size: 1.2rem;
            margin-right: 5px;
        }

        .brand span.text {
            font-size: 1rem;
        }
    }

    @media screen and (max-width: 480px) {
        .brand span.text {
            display: none; /* Hide text on very small screens */
        }

        .brand i {
            font-size: 1.5rem; /* Keep the icon prominent */
        }
    }
</style>

</head>

<body>

<div class="menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class="fas fa-coffee"></i>
            <span class="text">Kuraw</span>
        </a>
        <ul class="side-menu top">
            <li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('dashboard.category.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.category.index') }}">
                    <i class="fas fa-chart-pie"></i>
                    <span class="text">Category</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('dashboard.products.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.products.index') }}">
                    <i class="fas fa-box"></i>
                    <span class="text">Products</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('dashboard.orders.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="text">Orders</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('dashboard.reservations.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.reservations.index') }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="text">Reservations</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('dashboard.supplier.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.supplier.index') }}">
                    <i class="fas fa-truck"></i>
                    <span class="text">Supplier</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('dashboard.inventory.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.inventory.index') }}">
                    <i class="fas fa-warehouse"></i>
                    <span class="text">Inventory</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('dashboard.gallery.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.gallery.index') }}">
                    <i class="fas fa-images"></i>
                    <span class="text">Gallery Management</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('dashboard.profile.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.profile.index') }}">
                    <i class="fas fa-user"></i>
                    <span class="text">User Management</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('dashboard.logs.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.logs.index') }}">
                    <i class="fas fa-history"></i>
                    <span class="text">View Logs</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('dashboard.pages.settings') ? 'active' : '' }}">
                <a href="{{ route('dashboard.pages.settings') }}">
                    <i class="fas fa-cog"></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <!-- <li>
                <form action="{{ route('logout.admin') }}" method="POST" class="dropdown-item">
                    @csrf
                    <button type="submit" class="logout" style="border: none; background: none; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="text">Logout</span>
                    </button>
                </form>
            </li> -->
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <div class="nav-icons">
                <!-- Notification Bell Icon -->
                <div class="dropdown" style="position: relative; display: inline-block;">
                    <a href="#" class="header-notification me-3" aria-expanded="false" data-bs-toggle="modal" data-bs-target="#notificationsModal">
                        <i class="fas fa-bell" style="color: #dcdcdc;"></i> <!-- Dirty white color -->
                        <span id="notification-badge"
                            class="badge rounded-pill bg-danger"
                            data-count="{{ auth()->user()->unreadNotifications->count() }}"
                            style="position: absolute; top: -12px; left: 5px; transform: translate(0, 0); z-index: 10;">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    </a>
                </div>



                <!-- Profile Dropdown -->
                <div class="dropdown">
                    <a href="#" class="profile-icon dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li class="dropdown-item">
                            Hello, <strong>{{ auth()->user()->firstname }}</strong>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user"></i> My Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout.admin') }}">
                                @csrf
                                <button type="submit" class="logout" style="border: none; background: none; cursor: pointer;">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span class="text">Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- MAIN CONTENT -->
        <div class="main-content">
            @yield('content')
        </div>
    </section>

    <!-- Notifications Modal -->
    <div class="modal fade notification-modal" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationsModalLabel"><i class="fas fa-bell"></i> Notifications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Notification list will be populated dynamically by JavaScript -->
                    <ul class="list-group" id="notificationList"></ul>
                    <div id="noNotifications" class="text-center" style="display: none;">No notifications available.</div>
                </div>

                <div class="modal-footer">
                    <form action="{{ route('notifications.mark-read') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" onclick="toastMarkReadAll()"><i class="fas fa-check"></i> Mark All as Read</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->notifications->count())
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            console.log("Document ready. Initializing force fetch...");

            let prevUnreadCount = 0; // Variable to store the previous unread count
            let hasShownNewNotificationToast = false; // Flag to prevent constant "new notification" toast during fetch

            // Function to show unread count toast on page load
            const showUnreadToastOnLoad = async () => {
                try {
                    const response = await fetch("{{ route('notifications.fetch') }}", {
                        method: "GET",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                    });

                    if (!response.ok) {
                        throw new Error("Failed to fetch notifications.");
                    }

                    const notifications = await response.json();
                    const unreadCount = notifications.filter((notification) => !notification.read_at).length;

                    // Show unread count toast only if unread count is greater than 0
                    if (unreadCount > 0) {
                        toastNotifyUnreadCount(unreadCount); // Show unread count toast
                        toastNotifyNew();
                    }

                    // Update previous unread count after showing the toast
                    prevUnreadCount = unreadCount;

                    const notificationBadge = document.querySelector('.notification .num');
                    if (unreadCount > 0 && notificationBadge) {
                        notificationBadge.textContent = unreadCount;
                        notificationBadge.style.display = 'inline-block';
                        notificationBadge.style.marginTop = '20%';
                    } else if (notificationBadge) {
                        notificationBadge.style.display = 'none';
                    }

                    // Handle "No notifications" message visibility
                    if (unreadCount === 0) {
                        document.getElementById("noNotifications").style.display = 'block';
                    }

                } catch (error) {
                    console.error("Error fetching notifications:", error);
                }
            };

            // Show the unread notification toast when the page loads
            showUnreadToastOnLoad();

            // Define the forceFetch function for regular updates
            const forceFetch = async () => {
                try {
                    console.log("Fetching notifications...");

                    // Fetch unread notifications
                    const response = await fetch("{{ route('notifications.fetch') }}", {
                        method: "GET",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                    });

                    if (!response.ok) {
                        throw new Error("Failed to fetch notifications.");
                    }

                    const notifications = await response.json();
                    const unreadCount = notifications.filter((notification) => !notification.read_at).length;

                    // Check if the notification badge element exists before manipulating it
                    const notificationBadge = document.querySelector('#notification-badge');
                    if (notificationBadge) {
                        if (unreadCount > prevUnreadCount && !hasShownNewNotificationToast) {
                            toastNotifyNew(); // Show "new notification" toast
                            hasShownNewNotificationToast = true; // Prevent multiple toasts in the same fetch
                        }


                        console.log("I REACHED HERE!");
                        notificationBadge.textContent = unreadCount;
                        notificationBadge.style.display = 'inline-block'; // Show badge
                        notificationBadge.style.marginTop = '20%';

                        // Update the previous unread count
                        prevUnreadCount = unreadCount;

                        // Clear existing notifications and update modal
                        const notificationList = document.getElementById("notificationList");
                        notificationList.innerHTML = '';
                        notifications.forEach(notification => {
                            const listItem = document.createElement('li');
                            listItem.className = 'list-group-item';
                            listItem.dataset.notificationId = notification.id;

                            let viewLink = '#'; // Default link if no valid ID exists
                            if (notification.data.order_id) {
                                viewLink = `/dashboard/orders/${notification.data.order_id}`;
                            } else if (notification.data.reservation_id) {
                                viewLink = `/dashboard/reservations/${notification.data.reservation_id}`;
                            }

                            listItem.innerHTML = `
                            <div>
                                <span>${notification.data.message || 'No message available'}</span>
                                <small class="text-muted d-block">${new Date(notification.created_at).toLocaleString()}</small>
                            </div>
                            <a href="${viewLink}" class="badge bg-primary">View</a>
                        `;

                            notificationList.appendChild(listItem);
                        });

                    }

                } catch (error) {
                    console.error("Error fetching notifications:", error);
                }
            };

            // Fetch unread count every 3 seconds
            setInterval(forceFetch, 3000); // 3000ms = 3 seconds
        });

        // Function to show a toast when there is a new notification
        function toastNotifyNew() {
            Toastify({
                text: "There is a new notification!",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "#fff8e1",
                    border: "1px solid #d3ad6e",
                    borderRadius: "12px",
                    padding: "12px",
                    boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)",
                    fontSize: "14px",
                    color: "#222222",
                    margin: "auto"
                },
            }).showToast();
        }

        // Function to show a toast when there is unread notification count
        function toastNotifyUnreadCount(unreadCount) {
            Toastify({
                text: `You have ${unreadCount} unread notifications.`,
                duration: 4000,
                close: true,
                gravity: "top",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "#f4f4f4",
                    border: "1px solid #222222",
                    borderRadius: "12px",
                    padding: "12px",
                    boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)",
                    fontSize: "14px",
                    color: "#222222",
                    margin: "auto"
                },
            }).showToast();
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>