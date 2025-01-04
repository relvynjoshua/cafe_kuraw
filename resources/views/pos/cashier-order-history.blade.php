<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order & Reservation History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .container-fluid { height: 100%;}
        .sidebar { background-color: #222; color: #fff; min-height:100vh; height: 100%h; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover, .active { background-color: #444; }
        .history-table { background-color: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 40px; }
        .table th, .table td { text-align: center; vertical-align: middle; }
        .status-completed { background-color: #d4edda; color: #155724; padding: 5px 10px; border-radius: 5px; }
        .status-pending { background-color: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 5px; }
        .status-cancelled { background-color: #f8d7da; color: #721c24; padding: 5px 10px; border-radius: 5px; }
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
            <a href="{{ route('cashierHistory.index') }}" class="active">History</a>
            <a href="{{ route('cashierManage.index') }}">Manage Orders</a>
            <a href="{{ route('cashierProfile.index') }}">Profile</a>
            <a href="{{ route('cashierSettings.index') }}">Settings</a>
            <a href="#" class="text-danger mt-5">Sign Out</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <!-- Order History Section -->
            <h3 class="mb-4">Order History</h3>
            <div class="history-table">
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
                                <td><span class="status-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">View</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Reservation History Section -->
            <h3 class="mb-4">Reservation History</h3>
            <div class="history-table">
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
                                <td><span class="status-{{ strtolower($reservation->status) }}">{{ ucfirst($reservation->status) }}</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reservationModal{{ $reservation->id }}">View</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
@foreach($orders as $order)
<div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details ({{ $order->transaction_id }})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
                <p><strong>Total Amount:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Order Items:</strong></p>
                <ul>
                    @foreach($order->products as $product)
                        <li>{{ $product->name }} (₱{{ number_format($product->pivot->price, 2) }}) x {{ $product->pivot->quantity }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($reservations as $reservation)
<div class="modal fade" id="reservationModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reservation Details ({{ $reservation->reservation_id }})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Customer Name:</strong> {{ $reservation->name }}</p>
                <p><strong>Date:</strong> {{ $reservation->reservation_date }}</p>
                <p><strong>Time:</strong> {{ $reservation->reservation_time }}</p>
                <p><strong>Number of Guests:</strong> {{ $reservation->number_of_guests }}</p>
                <p><strong>Status:</strong> {{ ucfirst($reservation->status) }}</p>
                <p><strong>Note:</strong> {{ $reservation->note }}</p>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
