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

        <form id="reset-password-form" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your new password" required>
                <small id="password-error" class="form-text text-danger" style="display: none;">
                    Password must be at least 8 characters long, contain at least one special character (!@#$%^&*), and one uppercase letter.
                </small>
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your new password" required>
                <small id="confirm-password-error" class="form-text text-danger" style="display: none;">
                    Password confirmation does not match or lacks required criteria.
                </small>
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

<script>
    // Add client-side validation for password
    document.getElementById('reset-password-form').addEventListener('submit', function (e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const passwordError = document.getElementById('password-error');
        const confirmPasswordError = document.getElementById('confirm-password-error');

        // Check if the password meets the criteria
        const specialCharRegex = /[!@#$%^&*]/;
        const upperCaseRegex = /[A-Z]/;
        let isValid = true;

        if (password.length < 8 || !specialCharRegex.test(password) || !upperCaseRegex.test(password)) {
            e.preventDefault(); // Prevent form submission
            passwordError.style.display = 'block'; // Show error message
            isValid = false;
        } else {
            passwordError.style.display = 'none'; // Hide error message
        }

        // Check if passwords match and confirm password meets the same criteria
        if (password !== confirmPassword || !specialCharRegex.test(confirmPassword) || !upperCaseRegex.test(confirmPassword)) {
            e.preventDefault(); // Prevent form submission
            confirmPasswordError.style.display = 'block'; // Show error message
            isValid = false;
        } else {
            confirmPasswordError.style.display = 'none'; // Hide error message
        }

        return isValid; // Allow form submission only if valid
    });
</script>

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
