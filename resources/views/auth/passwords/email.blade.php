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

    <div class="container mt-5">
        <!-- Logo -->
        <img src="{{ asset('img/logo.jpg') }}" alt="Kuraw Coffee Shop Logo" class="logo">
        <h2 class="text-center">Forgot Password</h2>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
        <div class="alert alert-danger mt-3">
            {{ $errors->first() }}
        </div>
        @endif

        <!-- Forgot Password Form -->
        <form id="forgot-password-form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <button type="submit" id="reset-button" class="btn btn-primary mt-3">Send Password Reset Link</button>
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

    <!-- Link to Bootstrap JS for additional functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Disable button on click to prevent multiple submissions
        document.getElementById('forgot-password-form').addEventListener('submit', function (e) {
            const resetButton = document.getElementById('reset-button');
            resetButton.disabled = true; // Disable the button
            resetButton.innerText = 'Processing...'; // Change button text to indicate action
        });
    </script>
</body>

<!-- Custom CSS for additional styling -->
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .container {
        max-width: 500px;
        padding: 30px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        margin-bottom: auto;
    }

    h2 {
        color: #333;
    }

    .form-control {
        border-radius: 20px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #000000;
        color: #ffffff;
        border-color: #ffffff;
        border-radius: 20px;
        padding: 10px;
        font-size: 16px;
        width: 100%;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #ffffff;
        color: #000000;
        border-color: #000000;
    }

    .alert {
        border-radius: 8px;
        font-size: 16px;
    }

    .logo {
        max-width: 150px;
        display: block;
        margin: 0 auto 20px;
        border-radius: 15px;
    }

    .footer-section {
        background-color: #000000;
        padding: 10px 0;
        color: white;
        text-align: center;
        margin-top: auto;
        font-size: 14px;
    }
</style>
</html>
