<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .sidebar { background-color: #222; color: #fff; height: 100vh; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover, .active { background-color: #444; }
        .table-container { background-color: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .table th, .table td { text-align: center; vertical-align: middle; }

        /* Status Badge Styles */
        .status-completed { background-color: #d4edda; color: #155724; padding: 5px 10px; border-radius: 5px; }
        .status-pending { background-color: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 5px; }
        .status-failed { background-color: #f8d7da; color: #721c24; padding: 5px 10px; border-radius: 5px; }
        .status-complete, .status-pending, .status-failed { display: inline-block; width: 100px; text-align: center; padding: 5px 10px; border-radius: 5px; }
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
            <a href="{{ route('transactions.index') }}" class="active">Transaction</a>
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
                <a href="{{ url('/') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>

            <!-- Transaction Table -->
            <div class="table-container">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Transaction ID</th>
                            <th>Timestamp</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Rows -->
                        <tr>
                            <td>T123456</td>
                            <td>2024-04-15 12:45 PM</td>
                            <td>₱120.00</td>
                            <td><span class="status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>T123457</td>
                            <td>2024-04-16 03:30 PM</td>
                            <td>₱85.00</td>
                            <td><span class="status-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>T123458</td>
                            <td>2024-04-17 10:15 AM</td>
                            <td>₱50.00</td>
                            <td><span class="status-failed">Failed</span></td>
                        </tr>
                        <tr>
                            <td>T123459</td>
                            <td>2024-04-18 02:00 PM</td>
                            <td>₱200.00</td>
                            <td><span class="status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>T123460</td>
                            <td>2024-04-19 04:45 PM</td>
                            <td>₱70.00</td>
                            <td><span class="status-pending">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
