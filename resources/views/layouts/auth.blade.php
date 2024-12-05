<!-- resources/views/layouts/auth_layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Authentication')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Auth CSS -->
    <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet">
</head>
<body>
    <div id="auth-container" class="container">
        @yield('content')
    </div>
    <!-- Include JavaScript -->
    <script src="{{ asset('assets/js/auth.js') }}"></script>
    <!-- Optional: Add Auth-Specific JavaScript Here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
