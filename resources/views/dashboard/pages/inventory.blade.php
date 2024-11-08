@extends('layouts.dashboard')

@section('title', 'Inventory Management')

@section('breadcrumb', 'Dashboard')
@section('breadcrumb-active', 'Inventory')

@section('content')
 <!-- SIDEBAR -->
 <section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Kuraw Coffee Shop</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{ route('inventory.index') }}">
					<i class='bx bxs-box'></i>
					<span class="text">Inventory</span>
				</a>
			</li>
			<li>
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
		<!-- NAVBAR -->

        <!-- CONTENT-->
        <main>

        </main>

    </section>
    <h2>Inventory Management</h2>
    <table>
        <!-- Inventory Management Table Code Here -->
    </table>
@endsection