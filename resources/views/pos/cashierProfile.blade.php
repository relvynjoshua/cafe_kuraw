<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #E8E4D9;
            font-family: 'Poppins', Arial, sans-serif;
        }

        .container-fluid {
            height: 100%;
        }

        .sidebar {
            background-color: #222;
            color: #fff;
            min-height: 100vh;
            height: 100%h;
            padding: 10px;
            transition: all 0.3s ease;
            overflow-x: hidden;
            word-wrap: break-word;
        }

        .sidebar h4 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5rem;
            color: #fff;
            word-wrap: break-word;
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            word-wrap: break-word;
        }

        .sidebar a:hover,
        .active {
            background-color: #444;
            color: #fff;
            font-weight: bold;
            transform: translateX(5px);
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .main-content {
            padding: 30px;
        }

        .profile-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .profile-card h5 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .profile-card p {
            font-size: 1rem;
            color: #555;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .modal-content {
            border-radius: 10px;
        }

        .header-container {
            background: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header-container h3 {
            margin: 0;
            margin-top: 15px;
            line-height: 1;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: absolute;
                z-index: 10;
            }

            .sidebar a {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            .sidebar h4 {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 100%;
            }

            .sidebar a {
                font-size: 0.8rem;
                padding: 5px 10px;
            }

            .sidebar h4 {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-3">
                <h4 class="text-center"><i class="fas fa-coffee"></i> KURAW CAFE</h4>
                <a href="{{ route('cashier.showPOS') }}">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
                <a href="{{ route('cashierHistory.index') }}">
                    <i class="fas fa-receipt me-2"></i>Order/Reservation History
                </a>
                <a href="{{ route('masteritem.index') }}">
                    <i class="fas fa-box-open me-2"></i>Products List
                </a>
                <a href="{{route(name: 'cashierManage.index')}}">
                    <i class="fas fa-calendar-check me-2"></i>Manage Order/Reservation
                </a>
                <a href="{{ route('cashierProfile.index') }}" class="active">
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
            <div class="col-md-10 main-content">
                <div class="header-container">
                    <h3 class="mb-4 profile-header"><i class="fas fa-user"></i>
                     Cashier Profile</h3>
                </div>

                @if($cashier)
                    <!-- Display Profile Information -->
                    <div class="profile-card">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center">
                                <img src="https://via.placeholder.com/150" alt="Profile Picture"
                                    class="rounded-circle img-fluid">
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $cashier->firstname }}</h5>
                                <p><strong>Email:</strong> {{ $cashier->email }}</p>
                                <p><strong>Role:</strong> {{ $cashier->role ?? 'Not assigned' }}</p>
                                <button class="btn btn-primary mt-3" data-bs-toggle="modal"
                                    data-bs-target="#editProfileModal">Edit Profile</button>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- If cashier is not found -->
                    <div class="alert alert-danger mt-4" role="alert">
                        Cashier profile not found. Please make sure you are logged in.
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Go to Login</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('cashier.update', $cashier->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control"
                                value="{{ $cashier->firstname }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $cashier->email }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>