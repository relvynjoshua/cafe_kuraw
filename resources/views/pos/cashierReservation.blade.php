<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .container-fluid { height: 100%;}
        .sidebar { background-color: #222; color: #fff; min-height:100vh; height: 100%h; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover, .active { background-color: #444; }
        .calendar-container { border: 1px solid #ddd; padding: 10px; border-radius: 10px; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        #month-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
        .arrow-button { background: none; border: none; font-size: 1.5rem; cursor: pointer; }
        .table { table-layout: fixed; width: 100%; text-align: center; }
        .table td { cursor: pointer; padding: 10px; height: 50px; }
        .table th { background-color: #f0f0f0; color: #555; padding: 10px; }
        .available-date { background-color: #e0f7e0; border-radius: 5px; transition: background-color 0.3s; }
        .available-date:hover { background-color: #a0e8a0; }
        .booked-date { background-color: #f8d7da; border-radius: 5px; color: #721c24; }
        .past-date { color: #aaa; }
        .reservation-details { border: 1px solid #ddd; padding: 20px; border-radius: 10px; background-color: #fff; width: 35%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .btn-primary { background-color: #007bff; }
        .arrow-button:hover { color: #007bff; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            <h4 class="text-center mb-4">KURAW</h4>
            <a href="{{ route('pos') }}">Dashboard</a>
            <a href="{{ route('cashier.index') }}">Cashier</a>
            <a href="{{ route('cashier.transactions') }}">Transaction</a>
            <a href="{{ route('masteritem.index') }}">Master Item</a>
            <a href="{{ route('cashierReservation.index') }} " class="active">Reservation</a>
            <a href="{{ route('cashierHistory.index') }}">History</a>
            <a href="{{route(name: 'cashierManage.index')}}">Manage Orders</a>
            <a href="{{ route('cashierProfile.index') }}">Profile</a>
            <a href="{{ route('cashierSettings.index') }}">Settings</a>
            <a href="#" class="text-danger mt-5">Sign Out</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Reservation Page</h3>
            </div>

            <div class="d-flex gap-4">
                <!-- Calendar Section -->
                <div class="calendar-container">
                    <div id="month-nav">
                        <button id="prevMonth" class="arrow-button">◀</button>
                        <span id="currentMonth" class="fw-bold"></span>
                        <button id="nextMonth" class="arrow-button">▶</button>
                    </div>
                    <table id="calendar" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
                            </tr>
                        </thead>
                        <tbody id="calendar-body"></tbody>
                    </table>
                </div>

                <!-- Reservation Details Section -->
                <div class="reservation-details">
                    <h4>Reservation Details</h4>
                    <form action="{{ route('cashierReservation.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Phone:</label>
                            <input type="tel" name="phone_number" id="phone" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="reservationDate">Reservation Date:</label>
                            <input type="date" name="reservation_date" id="reservationDate" class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="reservationTime">Reservation Time:</label>
                            <input type="time" name="reservation_time" id="reservationTime" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="number_of_guests">Number of Guests:</label>
                            <input type="number" name="number_of_guests" id="number_of_guests" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="note">Notes:</label>
                            <textarea name="note" id="note" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit Reservation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Calendar Script -->
<script>
    let bookedDates = @json($bookedDates); // Array of booked dates in "YYYY-MM-DD" format

    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    // Function to generate the calendar for the given month and year
    function generateCalendar(month, year) {
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const tbody = document.getElementById("calendar-body");
        tbody.innerHTML = '';
        let date = 1;

        // Calculate which day of the week the first day of the month is on
        let firstDayOfWeek = firstDay.getDay();

        // Create 6 rows for the calendar (maximum 6 weeks in a month)
        for (let i = 0; i < 6; i++) {
            let row = document.createElement("tr");
            for (let j = 0; j < 7; j++) {
                let cell = document.createElement("td");

                // If we're past the last day of the month, leave the cells blank
                if ((i === 0 && j < firstDayOfWeek) || date > lastDay.getDate()) {
                    row.appendChild(cell);
                } else {
                    let fullDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                    cell.textContent = date;
                    
                    // Highlight past dates (disabled)
                    if (new Date(year, month, date) < currentDate) {
                        cell.classList.add('past-date');
                    }
                    // Highlight booked dates
                    else if (bookedDates.includes(fullDate)) {
                        cell.classList.add('booked-date');
                    }
                    // Allow selection for available dates
                    else {
                        cell.classList.add('available-date');
                        cell.onclick = () => document.getElementById("reservationDate").value = fullDate;
                    }

                    row.appendChild(cell);
                    date++;
                }
            }
            tbody.appendChild(row);
        }

        // Display the current month and year at the top
        document.getElementById("currentMonth").textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;
    }

    // Event listener for the previous month button
    document.getElementById("prevMonth").onclick = () => {
        currentMonth--;
        if (currentMonth < 0) { currentMonth = 11; currentYear--; }
        generateCalendar(currentMonth, currentYear);
    };

    // Event listener for the next month button
    document.getElementById("nextMonth").onclick = () => {
        currentMonth++;
        if (currentMonth > 11) { currentMonth = 0; currentYear++; }
        generateCalendar(currentMonth, currentYear);
    };

    // Initially generate the current month calendar
    generateCalendar(currentMonth, currentYear);
</script>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
