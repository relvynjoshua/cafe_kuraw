<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuraw Coffee Shop - Forgot Password</title>
    
    <!-- Link to Bootstrap 4 CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<body>
    <div class="container mt-5">
        <img src="{{ asset('img/logo.jpg') }}" alt="Kuraw Coffee Shop Logo" class="logo">
        <h2 class="text-center">Reset Password</h2>

        <!-- Display success or error messages -->
        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger mt-3">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your new password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your new password" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Reset Password</button>
        </form>
    </div>
    <!-- Footer Section -->
    <footer class="footer-section plain-footer">
        <div id="bottom-footer">
            <div class="auto-container text-center">
                <p class="copyright-text">
                    &copy; {{ date('Y') }} Kuraw Coffee Shop. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>

<!-- Custom CSS for additional styling -->
<style>
    body {
        background-color: #f8f9fa; /* Light background color */
        font-family: 'Arial', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .container {
        max-width: 500px; /* Limit the form width */
        padding: 30px;
        background-color: #ffffff; /* White background for the form */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow around the form */
        border-radius: 15px;
        margin-bottom: auto; /* Push footer to the bottom */
    }

    h2 {
        color: #333; /* Dark color for the title */
    }

    .form-control {
        border-radius: 20px; /* Rounded corners for input fields */
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #000000; /* Black background */
        color: #ffffff; /* White text */
        border-color: #ffffff; /* White border */
        border-radius: 20px; /* Rounded button */
        padding: 10px;
        font-size: 16px;
        width: 100%;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #ffffff; /* White background on hover */
        color: #000000; /* Black text on hover */
        border-color: #000000; /* Optional: Change border to black on hover */
    }

    .alert {
        border-radius: 8px; /* Rounded corners for alerts */
        font-size: 16px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .text-center {
        margin-bottom: 20px;
    }

    /* Logo Styling */
    .logo {
        max-width: 150px; /* Maximum width for the logo */
        display: block;
        margin: 0 auto 20px; /* Center the logo with space below */
        border-radius: 15px;
    }

    /* Footer Styles */
    .footer-section {
        background-color: #000000; /* Dark footer background */
        padding: 10px 0; /* Padding for top and bottom */
        color: white; /* White text for contrast */
        text-align: center;
        margin-top: auto; /* Push footer to the bottom of the page */
        font-size: 14px;
    }

    .copyright-text {
        margin: 0;
        font-weight: 400;
        font-size: 18px;
    }

    .footer-section a {
        color: #ffff;
        text-decoration: none;
    }

    .footer-section a:hover {
        text-decoration: underline; /* Underline links on hover */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .footer-section {
            padding: 10px 0; /* Less padding on mobile */
        }

        .copyright-text {
            font-size: 12px; /* Smaller text size on mobile */
        }
    }
</style>
</html> 