<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kuraw Coffee Shop')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Header Section -->
    <header>
        @include('components.navbar')
    </header>

    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer>
        @include('components.footer')
    </footer>

    <!-- Pusher & Laravel Echo (Optional Real-Time Notifications) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.1/echo.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ config('broadcasting.connections.pusher.key') }}',
            cluster: '{{ config('broadcasting.connections.pusher.cluster') }}',
            forceTLS: true
        });

        document.addEventListener('DOMContentLoaded', function () {
            const userId = "{{ auth()->id() }}"; // Get the authenticated user's ID

            Echo.private(`App.Models.User.${userId}`)
                .notification((notification) => {
                    // Display the notification message
                    alert(notification.message); // Replace with custom notification UI
                });
        });
    </script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    @stack('scripts') <!-- Allows pushing scripts dynamically -->
</body>

</html>