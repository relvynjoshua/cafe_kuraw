<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background-color: #222;
            color: #fff;
            min-height: 100vh;
            height: 100%h;
        }

        .sidebar h4 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5rem;
            color: #fff;
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar a:hover,
        .active {
            background-color: #444;
            color: #fff;
            font-weight: bold;
            transform: translateX(5px);
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .table-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .order-row {
            margin-bottom: 30px;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
        }

        .bg-success {
            background-color: #28a745;
            color: #fff;
        }

        .bg-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .bg-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .modal-body table {
            margin-bottom: 20px;
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-3">
                <h4 class="text-center mb-6"><i class="fas fa-coffee"></i> KURAW CAFE</h4>
                <a href="{{ route('cashier.showPOS') }}">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
                <a href="{{ route('cashier.index') }}" >
                    <i class="fas fa-cash-register me-2"></i>Cashier
                </a>
                <a href="{{ route('cashier.transactions') }}" class="active">
                    <i class="fas fa-receipt me-2"></i>Transaction
                </a>
                <a href="{{ route('masteritem.index') }}">
                    <i class="fas fa-box-open me-2"></i>Master Item
                </a>
                <a href="{{ route('cashierReservation.index') }}">
                    <i class="fas fa-calendar-check me-2"></i>Reservation
                </a>
                <a href="{{ route('cashierHistory.index') }}">
                    <i class="fas fa-history me-2"></i>History
                </a>
                <a href="{{route(name: 'cashierManage.index')}}">
                    <i class="fas fa-tasks me-2"></i>Manage Orders
                </a>
                <a href="{{ route('cashierProfile.index') }}">
                    <i class="fas fa-user me-2"></i>Profile
                </a>
                <a href="{{ route('cashierSettings.index') }}">
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
                <h3>Customer Transactions</h3>

                <div class="table-container">
                    @forelse ($orders as $order)
                        <div class="order-row">
                            <!-- Order Details -->
                            <table class="table table-hover table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Timestamp</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->transaction_id }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->created_at->format('Y-m-d h:i A') }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>₱{{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $order->status == 'completed' ? 'bg-success' : ($order->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <!-- View Details Button -->
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#orderDetailsModal{{ $order->id }}">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Products Table -->
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
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->pivot->variation ?? 'No Variation' }}</td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>₱{{ number_format($product->pivot->price, 2) }}</td>
                                            <td>₱{{ number_format($product->pivot->quantity * $product->pivot->price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Order Details Modal -->
                        <div class="modal fade" id="orderDetailsModal{{ $order->id }}" tabindex="-1"
                            aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderDetailsModalLabel">Order Details - {{ $order->customer_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Email:</strong> {{ $order->email }}</p>
                                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                                        <p><strong>Total Amount:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
                                        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                                        <p><strong>Delivery Method:</strong> {{ ucfirst($order->delivery_method) }}</p>

                                        <!-- Products Table -->
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
                                            <tbody>
                                                @foreach ($order->products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->pivot->variation ?? 'No Variation' }}</td>
                                                        <td>{{ $product->pivot->quantity }}</td>
                                                        <td>₱{{ number_format($product->pivot->price, 2) }}</td>
                                                        <td>₱{{ number_format($product->pivot->quantity * $product->pivot->price, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center">
                            <p>No transactions found.</p>
                        </div>
                    @endforelse

                    <!-- Pagination Links -->
                    <div class="pagination d-flex justify-content-center align-items-center mt-3">
                        <a href="{{ $orders->previousPageUrl() }}#orders-section"
                            class="arrow {{ $orders->onFirstPage() ? 'disabled' : '' }}">«</a>
                        <span class="mx-3">Page {{ $orders->currentPage() }} of
                            {{ $orders->lastPage() }}</span>
                        <a href="{{ $orders->nextPageUrl() }}#orders-section"
                            class="arrow {{ $orders->hasMorePages() ? '' : 'disabled' }}">»</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
