<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .sidebar { background-color: #222; color: #fff; height: 100vh; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover, .active { background-color: #444; }
        .dashboard-card { border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .card-icon { font-size: 24px; margin-bottom: 10px; }
        .table th, .table td { text-align: center; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            <h4 class="text-center mb-4">KURAW</h4>
            <a href="{{ route('pos') }}" class="active">Dashboard</a>
            <a href="{{ route('cashier.index') }}">Cashier</a>
            <a href="{{ route('transactions.index') }}">Transaction</a>
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
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Dashboard</h4>
                <div>
                    <span class="me-2">Jhony Soda</span>
                    <img src="https://via.placeholder.com/30" class="rounded-circle" alt="Admin" />
                </div>
            </div>

            <!-- Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="dashboard-card bg-white">
                        <div class="card-icon text-success">💵</div>
                        <h5>Today Gross Profit</h5>
                        <h3>$23.560.000</h3>
                        <small class="text-success">8.5% Up from yesterday</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card bg-white">
                        <div class="card-icon text-primary">📦</div>
                        <h5>Today Item Receipt</h5>
                        <h3>$1.500.350</h3>
                        <small class="text-success">8.5% Up from yesterday</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card bg-white">
                        <div class="card-icon text-danger">📉</div>
                        <h5>Today Estimation Loss</h5>
                        <h3>$35.000</h3>
                        <small class="text-success">8.5% Down from yesterday</small>
                    </div>
                </div>
            </div>

            <!-- Latest Transactions, Popular Products, Stock Receipt/Issued -->
            <div class="row">
                <!-- Latest Transaction -->
                <div class="col-md-4">
                    <h5>Latest Transaction</h5>
                    <table class="table table-bordered table-hover bg-white">
                        <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Timestamp</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>T2131321</td>
                            <td>Today - 12:45</td>
                            <td>$50.000</td>
                            <td class="text-success">Complete</td>
                        </tr>
                        <tr>
                            <td>T2131321</td>
                            <td>Today - 12:45</td>
                            <td>$120.000</td>
                            <td class="text-success">Complete</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Popular Product -->
                <div class="col-md-4">
                    <h5>Popular Product</h5>
                    <table class="table table-bordered table-hover bg-white">
                        <thead>
                        <tr>
                            <th>Price</th>
                            <th>Item Name</th>
                            <th>Stock</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>P2131321</td>
                            <td>Photocopy machine x230</td>
                            <td>14 Pcs</td>
                        </tr>
                        <tr>
                            <td>P2131321</td>
                            <td>Laptop Asus x243</td>
                            <td>14 Pcs</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Stock Receipt / Issued -->
                <div class="col-md-4">
                    <h5>Stock Receipt / Issued</h5>
                    <table class="table table-bordered table-hover bg-white">
                        <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Item Name</th>
                            <th>Event</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Today - 12:45</td>
                            <td>Photocopy machine x230</td>
                            <td>3 Pcs</td>
                        </tr>
                        <tr>
                            <td>Today - 12:45</td>
                            <td>Asus X541U</td>
                            <td>3 Pcs</td>
                        </tr>
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
