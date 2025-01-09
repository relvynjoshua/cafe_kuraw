<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders & Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #E8E4D9;
            font-family: Arial, sans-serif;
        }

        .container-fluid {
            height: 100%;
        }

        .sidebar {
            background-color: #222;
            color: #fff;
            min-height: 100vh;
            height: 100%h;
            padding: 10px;
            transition: all 0.3s ease;
            overflow-x: hidden;
            word-wrap: break-word;
        }

        .sidebar h4 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5rem;
            color: #fff;
            word-wrap: break-word;
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            word-wrap: break-word;
        }

        .sidebar a:hover,
        .active {
            background-color: #444;
            color: #fff;
            font-weight: bold;
            transform: translateX(5px);
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .main-content {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            F
        }

        .tab-category {
            margin-bottom: 20px;
        }

        .tab-category button {
            margin-right: 10px;
        }

        .tab-category .active {
            background-color: #000;
            color: #fff;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .btn-accept {
            background-color: #28a745;
            color: #fff;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-accept:hover,
        .btn-cancel:hover {
            opacity: 0.9;
        }

        .header-container {
            background: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header-container h3 {
            margin: 0;
            margin-top: 15px;
            line-height: 1;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: absolute;
                z-index: 10;
            }

            .sidebar a {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            .sidebar h4 {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 100%;
            }

            .sidebar a {
                font-size: 0.8rem;
                padding: 5px 10px;
            }

            .sidebar h4 {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-3">
                <h4 class="text-center"><i class="fas fa-coffee"></i> KURAW CAFE</h4>
                <a href="{{ route('cashier.showPOS') }}">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
                <a href="{{ route('cashierHistory.index') }}">
                    <i class="fas fa-receipt me-2"></i>Order/Reservation History
                </a>
                <a href="{{ route('masteritem.index') }}">
                    <i class="fas fa-box-open me-2"></i>Products List
                </a>
                <a href="{{route(name: 'cashierManage.index')}}" class="active">
                    <i class="fas fa-calendar-check me-2"></i>Manage Order/Reservation
                </a>
                <a href="{{ route('cashierProfile.index') }}">
                    <i class="fas fa-cogs me-2"></i>Settings
                </a>
                <form action="{{ route('cashier.logoutCashier') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link text-danger mt-5">
                        <i class="fas fa-sign-out-alt me-2"></i>Sign Out
                    </button>
                </form>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="header-container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3><i class="fas fa-calendar-check me-2"></i> Manage Orders & Reservations</h3>
                    </div>

                    <!-- Category Tabs -->
                    <div class="tab-category">
                        <button id="ordersBtn" class="btn active" onclick="showCategory('orders')">Orders</button>
                        <button id="reservationsBtn" class="btn btn-outline-dark"
                            onclick="showCategory('reservations')">Reservations</button>
                    </div>
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
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td>₱{{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <form action="{{ route('orders.accept', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-accept btn-sm">Accept</button>
                                        </form>
                                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-cancel btn-sm">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
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
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->id }}</td>
                                    <td>{{ $reservation->customer_name }}</td>
                                    <td>{{ $reservation->reservation_date }}</td>
                                    <td>{{ $reservation->reservation_time }}</td>
                                    <td>{{ $reservation->number_of_guests }}</td>
                                    <td>
                                        <form action="{{ route('reservations.accept', $reservation->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-accept btn-sm">Accept</button>
                                        </form>
                                        <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-cancel btn-sm">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Pop-Up Notifications -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
        aria-hidden="true">
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