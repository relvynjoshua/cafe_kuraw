<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .container-fluid { height: 100%;}
        .sidebar { background-color: #222; color: #fff; min-height:100vh; height: 100%h; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover, .active { background-color: #444; }
        .reservation-table { background-color: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .table th, .table td { text-align: center; vertical-align: middle; }
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
            <a href="{{route(name: 'cashierManage.index')}}">Manage Orders</a>
            <a href="#">Profile</a>
            <a href="#">Settings</a>
            <a href="#" class="text-danger mt-5">Sign Out</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Submitted Reservations</h3>
                <a href="{{ url('/') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Reservation Table -->
            <div class="reservation-table">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Reservation Date</th>
                            <th>Reservation Time</th>
                            <th>Guests</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Data -->
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>johndoe@example.com</td>
                            <td>+639123456789</td>
                            <td>2024-04-20</td>
                            <td>06:00 PM</td>
                            <td>4</td>
                            <td>Birthday celebration</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>janesmith@example.com</td>
                            <td>+639987654321</td>
                            <td>2024-04-22</td>
                            <td>07:30 PM</td>
                            <td>2</td>
                            <td>Anniversary dinner</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Michael Johnson</td>
                            <td>michaelj@example.com</td>
                            <td>+639123098765</td>
                            <td>2024-04-25</td>
                            <td>08:00 PM</td>
                            <td>6</td>
                            <td>No special requests</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
