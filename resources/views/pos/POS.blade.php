<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .dashboard-card {
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .table th,
        .table td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-3">
                <h4 class="text-center mb-6"><i class="fas fa-coffee"></i> KURAW CAFE</h4>
                <a href="{{ route('cashier.showPOS') }}" class="active">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
                <a href="{{ route('cashier.index') }}">
                    <i class="fas fa-cash-register me-2"></i>Cashier
                </a>
                <a href="{{ route('cashier.transactions') }}">
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
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Dashboard</h4>
                    <!-- <div>
                    <span class="me-2">Jhony Soda</span>
                    <img src="https://via.placeholder.com/30" class="rounded-circle" alt="Admin" />
                </div> -->
                </div>

                <!-- Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="dashboard-card bg-white">
                            <div class="card-icon text-success">💵</div>
                            <h5>Today's Gross Profit</h5>
                            <h3>₱{{ number_format($grossProfit, 2) }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-card bg-white">
                            <div class="card-icon text-primary">📦</div>
                            <h5>Today's Net Profit</h5>
                            <h3>₱{{ number_format($netProfit, 2) }}</h3>
                        </div>
                    </div>
                </div>


                <!-- Latest Transactions, Popular Products, Stock Receipt/Issued -->
                <div class="row">
                    <!-- Latest Transaction -->
                    <div class="col-md-4">
                        <h5>Latest Transactions</h5>
                        <table class="table table-bordered table-hover bg-white">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Customer Name</th>
                                    <th>Timestamp</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestTransactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->transaction_id }}</td>
                                        <td>{{ $transaction->customer_name }}</td>
                                        <td>{{ $transaction->created_at->format('M d, Y - H:i') }}</td>
                                        <td>₱{{ number_format($transaction->total_amount, 2) }}</td>
                                        <td
                                            class="{{ $transaction->status === 'completed' ? 'text-success' : 'text-danger' }}">
                                            {{ ucfirst($transaction->status) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Popular Product -->
                    <div class="col-md-4">
                        <h5>Popular Products</h5>
                        <table class="table table-bordered table-hover bg-white">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Total Orders</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($popularProducts as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->orders_count }}</td>
                                        <td>{{ $product->stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Recent Reservations -->
                    <div class="col-md-4">
                        <h5>Recent Reservations</h5>
                        <table class="table table-bordered table-hover bg-white">
                            <thead>
                                <tr>
                                    <th>Reservation ID</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Guests</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentReceipts as $receipt)
                                    <tr>
                                        <td>{{ $receipt->reservation_id }}</td>
                                        <td>{{ $receipt->name }}</td>
                                        <td>{{ $receipt->reservation_date }}</td>
                                        <td>{{ $receipt->reservation_time }}</td>
                                        <td>{{ $receipt->number_of_guests }}</td>
                                        <td class="{{ $receipt->status === 'confirmed' ? 'text-success' : 'text-danger' }}">
                                            {{ ucfirst($receipt->status) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>