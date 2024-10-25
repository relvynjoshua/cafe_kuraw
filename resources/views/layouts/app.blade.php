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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #ece0d1;
            max-width: 1800px; 
            margin: 0 auto;      
            padding: 0 15px;    
        }
        .container {
            margin-top: 100px;
        }
        /* main {
            background-image: url('img/bgd/board_2.jpg'); 
            background-size: cover;           
            background-position: center;         
            background-repeat: no-repeat;        
            height: 500px;
        } */
    </style>
</head>
<body>
    <header>
        @include('components.navbar')
    </header>
    
    <main class="container">
        @yield('content')
    </main>
    
    <footer>
    @include('components.footer')
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
