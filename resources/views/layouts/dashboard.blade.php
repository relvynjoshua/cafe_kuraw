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

</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Kuraw Cafe</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="#">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.product.index') }}">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Products</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.category.index') }}">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Category</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.inventory.index') }}">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Inventory</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.supplier.index') }}">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Supplier</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.profile.index') }}">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Profile</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.reservation.index') }}">
					<i class='bx bxs-calendar-event'></i>
					<span class="text">Reservations</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group'></i>
					<span class="text">Team</span>
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
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' id="menu-icon"></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">99</span>
			</a>
			<a href="#" class="profile">
				<img src="{{ asset('img/user.png') }}" alt="profile picture">
			</a>
			<a href="#" class="profile">
				<i class='bx bxs-user-circle' ></i>
				
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- CONTENT -->
		<div class="main-content">
			@yield('content')
		</div>
	</section>
	<!-- CONTENT -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
