@extends('layouts.app')

@section('title', 'Reservation')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Link the CSS file -->
    <link rel="stylesheet" href="{{ asset('assets/css/reservation.css') }}">
    
</head>

<body>
<div class="container my-5">
    <!-- Success and Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container1-wrapper">
        <!-- Calendar Section -->
        <div class="calendar-container">
            <div id="month-nav">
                <button id="prevMonth" class="arrow-button">◀</button>
                <span id="currentMonth"></span>
                <button id="nextMonth" class="arrow-button">▶</button>
            </div>
            <div id="calendar-container">
                <table id="calendar" class="table">
                    <thead>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                    </thead>
                    <tbody id="calendar-body"></tbody>
                </table>
            </div>
        </div>

        <!-- Reservation Form Section -->
        <div class="reservation-details">
            <h2>Reservation Details</h2>
            <form id="reservation-form" action="{{ route('reservation.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Phone:</label>
                    <input type="tel" name="phone_number" id="phone" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="reservationDate" class="form-label">Reservation Date:</label>
                    <input type="date" name="reservation_date" id="reservationDate" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="reservationTime" class="form-label">Reservation Time:</label>
                    <input type="time" name="reservation_time" id="reservationTime" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="number_of_guests" class="form-label">Number of Guests:</label>
                    <input type="number" name="number_of_guests" id="number_of_guests" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="note" class="form-label">Notes:</label>
                    <textarea name="note" id="note" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit Reservation</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Get booked dates passed from the backend
    let bookedDates = @json($bookedDates);

    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    function generateCalendar(month, year) {
        let firstDay = new Date(year, month, 1);
        let lastDay = new Date(year, month + 1, 0);
        let startingDay = firstDay.getDay();
        let totalDays = lastDay.getDate();
        let tbody = document.getElementById("calendar-body");
        tbody.innerHTML = '';

        let date = 1;
        let rowCount = Math.ceil((totalDays + startingDay) / 7);

        for (let i = 0; i < rowCount; i++) {
            let row = document.createElement("tr");
            for (let j = 0; j < 7; j++) {
                let cell = document.createElement("td");

                // Empty cells before the first day of the month
                if ((i === 0 && j < startingDay) || date > totalDays) {
                    row.appendChild(cell);
                } else {
                    let fullDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                    cell.textContent = date;

                    // Check if the date is in the bookedDates array
                    if (bookedDates.includes(fullDate)) {
                        cell.classList.add('booked-date');
                        cell.title = "This date is already booked";
                    } else {
                        cell.classList.add('available-date');
                        cell.onclick = () => {
                            document.getElementById("reservationDate").value = fullDate;
                        };
                    }

                    row.appendChild(cell);
                    date++;
                }
            }
            tbody.appendChild(row);
        }

        document.getElementById("currentMonth").textContent = `${getMonthName(month)} ${year}`;
    }

    function getMonthName(month) {
        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];
        return monthNames[month];
    }

    generateCalendar(currentMonth, currentYear);

    document.getElementById("prevMonth").addEventListener("click", () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentMonth, currentYear);
    });

    document.getElementById("nextMonth").addEventListener("click", () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentMonth, currentYear);
    });
</script>

</body>

</html>
@endsection