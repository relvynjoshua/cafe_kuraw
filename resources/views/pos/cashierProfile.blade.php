<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .sidebar { background-color: #222; color: #fff; height: 100vh; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover, .active { background-color: #444; }
        .main-content { padding: 30px; }
        .alert { border-radius: 5px; }
        .profile-header { font-size: 2rem; color: #333; font-weight: bold; }
        .profile-detail { margin-top: 10px; }
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
                <a href="{{ route('cashierHistory.index') }}">History</a>
                <a href="{{ route('cashierManage.index') }}">Manage Orders</a>
                <a href="{{ route('cashierProfile.index') }}" class="active">Profile</a>
                <a href="{{ route('cashierSettings.index') }}">Settings</a>
                <a href="#" class="text-danger mt-5">Sign Out</a>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <h3 class="mb-4 profile-header">Cashier Profile</h3>

                @if($cashier)
                    <!-- Display Profile Information -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Name: {{ $cashier->name }}</h5>
                            <p class="card-text">Email: {{ $cashier->email }}</p>
                            <p class="card-text">Phone: {{ $cashier->phone ?? 'Not available' }}</p>
                            <p class="card-text">Role: {{ $cashier->role ?? 'Not assigned' }}</p>
                        </div>
                    </div>
                    <a href="{{ route('cashier.edit', $cashier->id) }}" class="btn btn-primary mt-3">Edit Profile</a>
                @else
                    <!-- If cashier is not found -->
                    <div class="alert alert-danger" role="alert">
                        Cashier profile not found. Please make sure you are logged in.
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Go to Login</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
