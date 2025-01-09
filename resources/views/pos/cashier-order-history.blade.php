<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order & Reservation History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #E8E4D9;
            font-family: 'Poppins', sans-serif;
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

        .history-table {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .status-confirmed {
            background-color: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
            padding: 5px 10px;
            border-radius: 5px;
        }

        /* Pagination container */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        /* Pagination list */
        .pagination ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        /* Pagination items */
        .pagination li {
            margin: 0 5px;
        }

        /* Pagination links */
        .pagination a {
            display: inline-block;
            padding: 6px 12px;
            color: #007bff;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 3px;
            background-color: #fff;
            transition: background-color 0.3s, color 0.3s;
            font-size: 1rem;
            line-height: 1.5;
        }

        /* Hover and active state */
        .pagination a:hover,
        .pagination .active a {
            background-color: #007bff;
            color: white;
        }

        /* Disabled state */
        .pagination .disabled a {
            color: #ccc;
            pointer-events: none;
        }

        /* Arrow buttons */
        .pagination .arrow {
            font-size: 1.2rem;
            padding: 6px 10px;
        }

        /* Arrow hover effect */
        .pagination .arrow:hover {
            background-color: #007bff;
            color: white;
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
                <a href="{{ route('cashierHistory.index') }}" class="active">
                    <i class="fas fa-receipt me-2"></i>Order/Reservation History
                </a>
                <a href="{{ route('masteritem.index') }}">
                    <i class="fas fa-box-open me-2"></i>Products List
                </a>
                <a href="{{route(name: 'cashierManage.index')}}">
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
                <!-- Order History Section -->
                <div class="history-table">
                    <h3 class="mb-4"><i class="fas fa-shopping-cart"></i> Order History</h3>
                    <form method="GET" action="{{ route('cashierHistory.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="order_search" class="form-control" placeholder="Search orders"
                                    value="{{ request('order_search') }}">
                            </div>
                            <div class="col-md-4">
                                <select name="order_status" class="form-select">
                                    <option value="">All Orders - Filter by Status</option>
                                    <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="completed" {{ request('order_status') == 'completed' ? 'selected' : '' }}>Completed
                                    </option>
                                    <option value="cancelled" {{ request('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Transaction ID</th>
                                <th>Customer Name</th>
                                <th>Date</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->transaction_id }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td>₱{{ number_format($order->total_amount, 2) }}</td>
                                    <td><span
                                            class="status-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#orderModal{{ $order->id }}">View</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination Links -->
                    <div class="pagination d-flex justify-content-center align-items-center mt-3">
                        <a href="{{ $orders->previousPageUrl() }}#orders-section"
                            class="arrow {{ $orders->onFirstPage() ? 'disabled' : '' }}">«</a>
                        <span class="mx-3">Page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}</span>
                        <a href="{{ $orders->nextPageUrl() }}#orders-section"
                            class="arrow {{ $orders->hasMorePages() ? '' : 'disabled' }}">»</a>
                    </div>
                </div>

                <hr>

                <!-- Reservation History Section -->
                <div class="history-table">
                    <h3 class="mb-4"><i class="fas fa-calendar-alt"></i> Reservation History</h3>
                    <form method="GET" action="{{ route('cashierHistory.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="reservation_search" class="form-control"
                                    placeholder="Search reservations" value="{{ request('reservation_search') }}">
                            </div>
                            <div class="col-md-4">
                                <select name="reservation_status" class="form-select">
                                    <option value="">All Reservations - Filter by Status</option>
                                    <option value="pending" {{ request('reservation_status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="confirmed" {{ request('reservation_status') == 'confirmed' ? 'selected' : '' }}>
                                        Confirmed</option>
                                    <option value="cancelled" {{ request('reservation_status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Reservation ID</th>
                                <th>Customer Name</th>
                                <th>Reservation Date</th>
                                <th>Reservation Time</th>
                                <th>Number of Guests</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->reservation_id }}</td>
                                    <td>{{ $reservation->name }}</td>
                                    <td>{{ $reservation->reservation_date }}</td>
                                    <td>{{ $reservation->reservation_time }}</td>
                                    <td>{{ $reservation->number_of_guests }}</td>
                                    <td><span
                                            class="status-{{ strtolower($reservation->status) }}">{{ ucfirst($reservation->status) }}</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#reservationModal{{ $reservation->id }}">View</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination Links -->
                    <div class="pagination d-flex justify-content-center align-items-center mt-3">
                        <a href="{{ $reservations->previousPageUrl() }}#reservations-section"
                            class="arrow {{ $reservations->onFirstPage() ? 'disabled' : '' }}">«</a>
                        <span class="mx-3">Page {{ $reservations->currentPage() }} of
                            {{ $reservations->lastPage() }}</span>
                        <a href="{{ $reservations->nextPageUrl() }}#reservations-section"
                            class="arrow {{ $reservations->hasMorePages() ? '' : 'disabled' }}">»</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @foreach($orders as $order)
        <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Details ({{ $order->transaction_id }})</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Total Amount:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
                        <hr>
                        <p><strong>Order Items:</strong></p>
                        <ul>
                            @foreach($order->products as $product)
                                <li><strong>{{ $product->name }}</strong> | {{ $product->pivot->variation ?? 'No Variation'}} |
                                    (₱{{ number_format($product->pivot->price, 2) }}) x
                                    {{ $product->pivot->quantity }}
                                </li>
                            @endforeach
                        </ul>
                        <hr>
                        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach($reservations as $reservation)
        <div class="modal fade" id="reservationModal{{ $reservation->id }}" tabindex="-1"
            aria-labelledby="reservationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reservation Details ({{ $reservation->reservation_id }})</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Customer Name:</strong> {{ $reservation->name }}</p>
                        <hr>
                        <p><strong>Reservation Date:</strong> {{ $reservation->reservation_date }}</p>
                        <p><strong>Reservation Time:</strong> {{ $reservation->reservation_time }}</p>
                        <p><strong>Number of Guests:</strong> {{ $reservation->number_of_guests }}</p>
                        <p><strong>Event/Notes:</strong> {{ $reservation->note }}</p>
                        <hr>
                        <p><strong>Status:</strong> {{ ucfirst($reservation->status) }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>