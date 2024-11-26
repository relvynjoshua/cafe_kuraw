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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
		<a href="#" class="brand">
			<i class="fas fa-coffee"></i>
			<span class="text">Kuraw Cafe</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="{{ route('dashboard.index') }}">
					<i class="fas fa-tachometer-alt"></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.category.index') }}">
					<i class="fas fa-chart-pie"></i>
					<span class="text">Category</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.products.index') }}">
					<i class="fas fa-box"></i>
					<span class="text">Products</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.orders.index') }}">
					<i class="fas fa-shopping-cart"></i>
					<span class="text">Orders</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.reservations.index') }}">
					<i class="fas fa-calendar-alt"></i>
					<span class="text">Reservations</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.inventory.index') }}">
					<i class="fas fa-warehouse"></i>
					<span class="text">Inventory</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.supplier.index') }}">
					<i class="fas fa-truck"></i>
					<span class="text">Supplier</span>
				</a>
			</li>
			<li>
				<a href="{{ route('dashboard.profile.index') }}">
					<i class="fas fa-user"></i>
					<span class="text">Profile</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class="fas fa-cog"></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="login-signup" class="logout">
					<i class="fas fa-sign-out-alt"></i>
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
			<i class="fas fa-bars" id="menu-icon"></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class="fas fa-bell"></i>
				<span class="num">99</span>
			</a>
			<a href="#" class="profile">
				<i class="fas fa-user-circle"></i>
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- CONTENT -->
		<div class="main-content">
			@yield('content')
		</div>
	</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
