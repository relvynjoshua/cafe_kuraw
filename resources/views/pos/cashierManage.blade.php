<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders & Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .container-fluid { height: 100%;}
        .sidebar { background-color: #222; color: #fff; min-height:100vh; height: 100%h; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover, .active { background-color: #444; }
        .main-content { background-color: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .tab-category { margin-bottom: 20px; }
        .tab-category button { margin-right: 10px; }
        .tab-category .active { background-color: #000; color: #fff; }
        .table th, .table td { text-align: center; vertical-align: middle; }
        .btn-accept { background-color: #28a745; color: #fff; }
        .btn-cancel { background-color: #dc3545; color: #fff; }
        .btn-accept:hover, .btn-cancel:hover { opacity: 0.9; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            <h4 class="text-center mb-4">KURAW</h4>
            <a href="{{ route('pos') }}">Dashboard</a>
            <a href="{{ route('cashier.index') }}">Cashier</a>
            <a href="{{ route('cashier.transactions') }}">Transaction</a>
            <a href="{{ route('masteritem.index') }}">Master Item</a>
            <a href="{{ route('cashierReservation.index') }}">Reservation</a>
            <a href="{{ route('cashierHistory.index') }}">History</a>
            <a href="{{route(name: 'cashierManage.index')}}" class="active">Manage Orders</a>
            <a href="{{ route('cashierProfile.index') }}">Profile</a>
            <a href="{{ route('cashierSettings.index') }}">Settings</a>
            <a href="#" class="text-danger mt-5">Sign Out</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Manage Orders & Reservations</h3>
            </div>

            <!-- Category Tabs -->
            <div class="tab-category">
                <button id="ordersBtn" class="btn active" onclick="showCategory('orders')">Orders</button>
                <button id="reservationsBtn" class="btn btn-outline-dark" onclick="showCategory('reservations')">Reservations</button>
            </div>

            <!-- Orders Table -->
            <div id="orders-section" class="main-content">
                <h4>Upcoming Orders</h4>
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ORD12345</td>
                            <td>John Doe</td>
                            <td>2024-04-20</td>
                            <td>₱350</td>
                            <td>
                                <button class="btn btn-accept btn-sm" onclick="showPopup('Order Accepted')">Accept</button>
                                <button class="btn btn-cancel btn-sm" onclick="showPopup('Order Cancelled')">Cancel</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD12346</td>
                            <td>Jane Smith</td>
                            <td>2024-04-21</td>
                            <td>₱520</td>
                            <td>
                                <button class="btn btn-accept btn-sm" onclick="showPopup('Order Accepted')">Accept</button>
                                <button class="btn btn-cancel btn-sm" onclick="showPopup('Order Cancelled')">Cancel</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Reservations Table -->
            <div id="reservations-section" class="main-content d-none">
                <h4>Upcoming Reservations</h4>
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Reservation ID</th>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Guests</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>RES56789</td>
                            <td>Michael Johnson</td>
                            <td>2024-04-22</td>
                            <td>6:00 PM</td>
                            <td>5</td>
                            <td>
                                <button class="btn btn-accept btn-sm" onclick="showPopup('Reservation Accepted')">Accept</button>
                                <button class="btn btn-cancel btn-sm" onclick="showPopup('Reservation Cancelled')">Cancel</button>
                            </td>
                        </tr>
                        <tr>
                            <td>RES56790</td>
                            <td>Anna White</td>
                            <td>2024-04-23</td>
                            <td>7:30 PM</td>
                            <td>3</td>
                            <td>
                                <button class="btn btn-accept btn-sm" onclick="showPopup('Reservation Accepted')">Accept</button>
                                <button class="btn btn-cancel btn-sm" onclick="showPopup('Reservation Cancelled')">Cancel</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Pop-Up Notifications -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Action Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-message">
                <!-- Dynamic Message -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    function showCategory(category) {
        const ordersSection = document.getElementById('orders-section');
        const reservationsSection = document.getElementById('reservations-section');
        const ordersBtn = document.getElementById('ordersBtn');
        const reservationsBtn = document.getElementById('reservationsBtn');

        if (category === 'orders') {
            ordersSection.classList.remove('d-none');
            reservationsSection.classList.add('d-none');
            ordersBtn.classList.add('active');
            reservationsBtn.classList.remove('active');
        } else {
            reservationsSection.classList.remove('d-none');
            ordersSection.classList.add('d-none');
            reservationsBtn.classList.add('active');
            ordersBtn.classList.remove('active');
        }
    }

    function showPopup(message) {
        const modalMessage = document.getElementById('modal-message');
        modalMessage.textContent = message;
        const notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
        notificationModal.show();
    }
</script>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
