<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .sidebar { background-color: #222; color: #fff; height: 100vh; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover, .active { background-color: #444; }
        .settings-section { background-color: #fff; border-radius: 10px; padding: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .settings-header { font-size: 2rem; color: #333; font-weight: bold; margin-bottom: 20px; }
        .settings-form label { font-weight: bold; color: #555; }
        .form-group { margin-bottom: 20px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: #007bff; }
        .btn-save { margin-top: 20px; }
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
            <a href="{{ route('cashierProfile.index') }}">Profile</a>
            <a href="{{ route('cashierSettings.index') }}" class="active">Settings</a>
            <a href="#" class="text-danger mt-5">Sign Out</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <div class="settings-section">
                <h3 class="settings-header">Cashier Settings</h3>
                
                <!-- Settings Form -->
                <form action="{{ route('cashierSettings.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" value="{{ auth()->check() ? auth()->user()->phone : '' }}">
                </div>

                <div class="form-group">
                    <label for="password">Password (Leave empty to keep unchanged)</label>
                    <input type="password" id="password" name="password" placeholder="Enter a new password (optional)">
                </div>

                <button type="submit" class="btn btn-primary btn-save">Save Changes</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
