<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Admin - Kuraw Cafe')</title>
    
    <!-- Include your Bootstrap or CSS links here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #967259;
            max-width: 1800px; 
            margin: 0 auto;      
            padding: 0 15px;    
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Kuraw Coffee Shop</span>
		</a>
		<ul class="side-menu top">
		<li class="@if(Request::is('dashboard')) active @endif">
                <a href="{{ route('dashboard') }}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="@if(Request::is('inventory')) active @endif">
                <a href="{{ route('inventory.index') }}">
                    <i class='bx bxs-box'></i>
                    <span class="text">Inventory</span>
                </a>
            </li>
            <li class="@if(Request::is('reservations')) active @endif">
                <a href="{{ route('reservation.index') }}">
                    <i class='bx bxs-calendar-event'></i>
                    <span class="text">Reservations</span>
                </a>
            </li>
			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Analytics</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog'></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="login" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
 
    <!-- CONTENT -->
	<section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">99</span>
            </a>
            <a href="#" class="profile">
                <img src="{{ asset('img/people.png') }}">
            </a>
        </nav>
        <!-- NAVBAR END -->

        <!-- MAIN CONTENT -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>@yield('title')</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">@yield('breadcrumb')</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">@yield('breadcrumb-active')</a>
                        </li>
                    </ul>
                </div>
                <a href="#" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Download PDF</span>
                </a>
            </div>

            @yield('content') <!-- This will be replaced with service-specific content -->
        </main>
        <!-- MAIN CONTENT END -->
    </section>
    <!-- CONTENT END -->

    <!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell'></i>
				<span class="num">99</span>
			</a>
			<a href="#" class="profile">
				<img src="{{ asset('img/people.png') }}">
			</a>
		</nav>
		<!-- NAVBAR -->
         
    <main class="container">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
