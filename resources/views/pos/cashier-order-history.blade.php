<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order & Reservation History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .sidebar { background-color: #222; color: #fff; height: 100vh; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover, .active { background-color: #444; }
        .history-table { background-color: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 40px; }
        .table th, .table td { text-align: center; vertical-align: middle; }
        .status-complete { background-color: #d4edda; color: #155724; padding: 5px 10px; border-radius: 5px; }
        .status-pending { background-color: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 5px; }
        .status-failed { background-color: #f8d7da; color: #721c24; padding: 5px 10px; border-radius: 5px; }
        .status-complete, .status-pending, .status-failed { display: inline-block; width: 100px; text-align: center; padding: 5px 10px; border-radius: 5px;
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
            <a href="{{ route('transactions.index') }}">Transaction</a>
            <a href="{{ route('masteritem.index') }}">Master Item</a>
            <a href="{{ route('cashierReservation.index') }}">Reservation</a>
            <a href="{{ route('cashierHistory.index') }}" class="active">History</a>
            <a href="{{route(name: 'cashierManage.index')}}">Manage Orders</a>
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>TRX12345</td>
                            <td>John Doe</td>
                            <td>2024-04-10</td>
                            <td>₱150</td>
                            <td><span class="status-complete">Completed</span></td>
                        </tr>
                        <tr>
                            <td>TRX12346</td>
                            <td>Jane Smith</td>
                            <td>2024-04-12</td>
                            <td>₱259</td>
                            <td><span class="status-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>TRX12347</td>
                            <td>Michael Johnson</td>
                            <td>2024-04-13</td>
                            <td>₱89</td>
                            <td><span class="status-failed">Failed</span></td>
                        </tr>
                        <tr>
                            <td>TRX12348</td>
                            <td>Anna White</td>
                            <td>2024-04-15</td>
                            <td>₱199</td>
                            <td><span class="status-complete">Completed</span></td>
                        </tr>
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>RES001</td>
                            <td>Emily Brown</td>
                            <td>2024-04-18</td>
                            <td>06:00 PM</td>
                            <td>5</td>
                            <td><span class="status-complete">Completed</span></td>
                        </tr>
                        <tr>
                            <td>RES002</td>
                            <td>James Miller</td>
                            <td>2024-04-20</td>
                            <td>07:30 PM</td>
                            <td>2</td>
                            <td><span class="status-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>RES003</td>
                            <td>Sarah Wilson</td>
                            <td>2024-04-22</td>
                            <td>05:00 PM</td>
                            <td>4</td>
                            <td><span class="status-failed">Failed</span></td>
                        </tr>
                        <tr>
                            <td>RES004</td>
                            <td>David Smith</td>
                            <td>2024-04-25</td>
                            <td>08:00 PM</td>
                            <td>3</td>
                            <td><span class="status-complete">Completed</span></td>
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
