<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Kuraw Cafe</title>

	<!-- Include your Bootstrap or CSS links here -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<style>
		/* Custom styles for notifications */
		.notification-modal .list-group-item {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.notification-modal .list-group-item .badge {
			font-size: 0.8rem;
		}

		.side-menu .active a {
			background-color: #007bff;
			color: #fff !important;
			border-radius: 5px;
		}

		.side-menu .active a i {
			color: #fff;
		}
	</style>
</head>

<body>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class="fas fa-coffee"></i>
			<span class="text">Kuraw Cafe</span>
		</a>
		<ul class="side-menu top">
			<li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
				<a href="{{ route('dashboard.index') }}">
					<i class="fas fa-tachometer-alt"></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="{{ request()->routeIs('dashboard.category.*') ? 'active' : '' }}">
				<a href="{{ route('dashboard.category.index') }}">
					<i class="fas fa-chart-pie"></i>
					<span class="text">Category</span>
				</a>
			</li>
			<li class="{{ request()->routeIs('dashboard.products.*') ? 'active' : '' }}">
				<a href="{{ route('dashboard.products.index') }}">
					<i class="fas fa-box"></i>
					<span class="text">Products</span>
				</a>
			</li>
			<li class="{{ request()->routeIs('dashboard.orders.*') ? 'active' : '' }}">
				<a href="{{ route('dashboard.orders.index') }}">
					<i class="fas fa-shopping-cart"></i>
					<span class="text">Orders</span>
				</a>
			</li>
			<li class="{{ request()->routeIs('dashboard.reservations.*') ? 'active' : '' }}">
				<a href="{{ route('dashboard.reservations.index') }}">
					<i class="fas fa-calendar-alt"></i>
					<span class="text">Reservations</span>
				</a>
			</li>
			<li class="{{ request()->routeIs('dashboard.supplier.*') ? 'active' : '' }}">
				<a href="{{ route('dashboard.supplier.index') }}">
					<i class="fas fa-truck"></i>
					<span class="text">Supplier</span>
				</a>
			</li>
			<li class="{{ request()->routeIs('dashboard.inventory.*') ? 'active' : '' }}">
				<a href="{{ route('dashboard.inventory.index') }}">
					<i class="fas fa-warehouse"></i>
					<span class="text">Inventory</span>
				</a>
			</li>
			<li class="{{ request()->routeIs('dashboard.gallery.*') ? 'active' : '' }}">
				<a href="{{ route('dashboard.gallery.index') }}">
					<i class="fas fa-images"></i>
					<span class="text">Gallery Management</span>
				</a>
			</li>
			<li class="{{ request()->routeIs('dashboard.profile.*') ? 'active' : '' }}">
				<a href="{{ route('dashboard.profile.index') }}">
					<i class="fas fa-user"></i>
					<span class="text">User Management</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li class="{{ request()->routeIs('dashboard.pages.settings') ? 'active' : '' }}">
				<a href="{{ route('dashboard.pages.settings') }}">
					<i class="fas fa-cog"></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
			<form action="{{ route('logout.admin') }}" method="POST" class="dropdown-item">
			@csrf
					<button type="submit" class="logout" style="border: none; background: none; cursor: pointer;">
						<i class="fas fa-sign-out-alt"></i>
						<span class="text">Logout</span>
					</button>
				</form>
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
			<a href="#" class="notification" data-bs-toggle="modal" data-bs-target="#notificationsModal">
				<i class="fas fa-bell"></i>
				@if (auth()->user()->unreadNotifications->count())
					<span class="num">{{ auth()->user()->unreadNotifications->count() }}</span>
				@endif
			</a>
			<a href="#" class="profile">
				<i class="fas fa-user-circle"></i>
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN CONTENT -->
		<div class="main-content">
			@yield('content')
		</div>
	</section>

	<!-- Notifications Modal -->
	<div class="modal fade notification-modal" id="notificationsModal" tabindex="-1"
		aria-labelledby="notificationsModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="notificationsModalLabel"><i class="fas fa-bell"></i> Notifications</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					@if (auth()->user()->notifications->count())
								<ul class="list-group">
									@foreach (auth()->user()->notifications as $notification)
													<li class="list-group-item">
														<div>
															@if ($notification->type === \App\Notifications\OrderStatusNotification::class)
																<span>Order #{{ $notification->data['order_id'] }} is now
																	<strong>{{ ucfirst($notification->data['status']) }}</strong>.
																</span>
															@elseif ($notification->type === \App\Notifications\NewOrderPlaced::class)
																<span>New Order #{{ $notification->data['order_id'] }} placed by
																	<strong>{{ $notification->data['customer_name'] }}</strong>
																	(₱{{ number_format($notification->data['total_amount'], 2) }}).
																</span>
															@elseif ($notification->type === \App\Notifications\NewReservationNotification::class)
																<span>New Reservation #{{ $notification->data['reservation_id'] }} from
																	<strong>{{ $notification->data['customer_name'] }}</strong>
																	on {{ $notification->data['reservation_date'] }} at
																	{{ $notification->data['reservation_time'] }}.
																</span>
															@endif
															<small
																class="text-muted d-block">{{ $notification->created_at->diffForHumans() }}</small>
														</div>
														@if (isset($notification->data['order_id']))
															<a href="{{ route('dashboard.orders.show', $notification->data['order_id']) }}"
																class="badge bg-primary">View</a>
														@elseif (isset($notification->data['reservation_id']))
															<a href="{{ route('dashboard.reservations.show', $notification->data['reservation_id']) }}"
																class="badge bg-primary">View</a>
														@else
																			@php
																				\Log::error('Missing keys in notification data', $notification->data);
																			@endphp
																			<span class="text-muted">No link available</span>
														@endif
													</li>
									@endforeach
								</ul>
					@else
						<div class="text-center">No notifications available.</div>
					@endif
				</div>
				<div class="modal-footer">
					<form action="{{ route('notifications.mark-read') }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Mark All as
							Read</button>
					</form>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		Echo.private(`App.Models.User.{{ auth()->id() }}`)
			.notification((notification) => {
				alert(`New Notification: ${notification.customer_name} placed Order #${notification.order_id}`);
			});
	</script>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>