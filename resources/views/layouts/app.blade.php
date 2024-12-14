<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Kuraw Coffee Shop')</title>

    <!-- Include your Bootstrap or CSS links here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        @include('components.navbar')
    </header>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer>
        @include('components.footer')
    </footer>

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
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userId = "{{ auth()->id() }}"; // Get the authenticated user's ID

            Echo.private(`App.Models.User.${userId}`)
                .notification((notification) => {
                    // Display the notification message
                    alert(notification.message); // You can replace this with a custom notification UI
                });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

    <script src="{{ asset('css/bootstrap.bundle.min.js') }}"></script>
</body>

</html>