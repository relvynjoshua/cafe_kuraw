<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
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
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px;
            text-decoration: none;
        }

        .sidebar a:hover,
        .active {
            background-color: #444;
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

        /* Status Badge Styles */
        .status-completed {
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

        .status-failed {
            background-color: #f8d7da;
            color: #721c24;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .status-complete,
        .status-pending,
        .status-failed {
            display: inline-block;
            width: 100px;
            text-align: center;
            padding: 5px 10px;
            border-radius: 5px;
        }
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
                <a href="{{ route('cashier.transactions') }}" class="active">Transaction</a>
                <a href="{{ route('masteritem.index') }}">Master Item</a>
                <a href="{{ route('cashierReservation.index') }}">Reservation</a>
                <a href="{{ route('cashierHistory.index') }}">History</a>
                <a href="{{route(name: 'cashierManage.index')}}">Manage Orders</a>
                <a href="{{ route('cashierProfile.index') }}">Profile</a>
                <a href="{{ route('cashierSettings.index') }}">Settings</a>
                <a href="#" class="text-danger mt-5">Sign Out</a>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Customer Transactions</h3>
                    <a href="{{ url('/pos') }}" class="btn btn-secondary">Back to Dashboard</a>
                </div>

                <!-- Transaction Table -->
                <div class="table-container">
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
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d h:i A') }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>₱{{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $order->status == 'completed' ? 'bg-success' : ($order->status == 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <!-- View Details Button -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#orderDetailsModal{{ $order->id }}">
                                            View
                                        </button>

                                        <!-- Status Update Form -->
                                        <form action="{{ route('cashier.updateStatus', $order->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm d-inline-block w-auto"
                                                onchange="this.form.submit()">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Order Details Modal -->
                                <div class="modal fade" id="orderDetailsModal{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details -
                                                    {{ $order->customer_name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Email:</strong> {{ $order->email }}</p>
                                                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                                                <p><strong>Total Amount:</strong>
                                                    ₱{{ number_format($order->total_amount, 2) }}</p>
                                                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}
                                                </p>
                                                <p><strong>Delivery Method:</strong> {{ ucfirst($order->delivery_method) }}
                                                </p>

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
                                                                <td>₱{{ number_format($product->pivot->quantity * $product->pivot->price, 2) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No transactions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>