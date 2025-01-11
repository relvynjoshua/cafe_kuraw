@extends('layouts.app')

@section('title', 'Reservation')

@section('content')

<head>
    <!--Meta Tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!--Favicons-->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.ico') }}" />

    <!--Page Title-->
    <title>Reservation</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800|Roboto:300,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.default.min.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- Venobox -->
    <link rel="stylesheet" href="{{ asset('assets/venobox/css/venobox.min.css') }}" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <!-- Reservation CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/reservation.css') }}">
</head>

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
                    <label for="phone">Phone:</label>
                    <input type="tel" name="phone_number" id="phone" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="reservationDate" class="form-label">Reservation Date:</label>
                    <input type="date" name="reservation_date" id="reservationDate" class="form-control" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="reservationTime" class="form-label">Reservation Time:</label>
                    <input type="time" name="reservation_time" id="reservationTime" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="number_of_guests" class="form-label">Number of Guests:</label>
                    <input type="number" name="number_of_guests" id="number_of_guests" class="form-control" min="1"
                        required>
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
    let bookedDates = @json($bookedDates);
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    function generateCalendar(month, year) {
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const startingDay = firstDay.getDay();
        const totalDays = lastDay.getDate();
        const tbody = document.getElementById("calendar-body");
        tbody.innerHTML = '';
        let date = 1;
        let today = new Date().toISOString().split('T')[0];
        const rowCount = Math.ceil((totalDays + startingDay) / 7);

        for (let i = 0; i < rowCount; i++) {
            let row = document.createElement("tr");
            for (let j = 0; j < 7; j++) {
                let cell = document.createElement("td");
                if ((i === 0 && j < startingDay) || date > totalDays) {
                    row.appendChild(cell);
                } else {
                    let fullDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                    cell.textContent = date;
                    if (new Date(fullDate) < new Date(today)) {
                        cell.classList.add('past-date');
                        cell.title = "Past dates cannot be reserved";
                    } else if (bookedDates.includes(fullDate)) {
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
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        return monthNames[month];
    }

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

    document.getElementById("reservationTime").addEventListener("change", (e) => {
        const selectedDate = document.getElementById("reservationDate").value;
        const selectedTime = e.target.value;
        const dayOfWeek = new Date(selectedDate).getDay();

        const storeHours = {
            0: { open: "13:00", close: "20:00" },
            1: { open: "12:00", close: "21:00" },
            2: { open: "12:00", close: "21:00" },
            3: { open: "12:00", close: "21:00" },
            4: { open: "12:00", close: "21:00" },
            5: { open: "12:00", close: "21:00" },
            6: { open: "12:00", close: "21:00" },
        };

        const { open, close } = storeHours[dayOfWeek];

        if (selectedTime < open || selectedTime > close) {
            alert(`Please select a time between ${open} and ${close}.`);
            e.target.value = "";
        }
    });

    generateCalendar(currentMonth, currentYear);

    document.getElementById("number_of_guests").addEventListener("input", function (e) {
        const value = parseInt(e.target.value, 10);
        if (value < 1) {
            alert("Number of guests must be at least 1.");
            e.target.value = ""; // Clear the invalid input
        }
    });
</script>


<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/form-contact.js') }}"></script>
<script src="{{ asset('assets/js/isotope.3.0.6.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
<script src="{{ asset('assets/js/jquery.inview.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
<script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/modal.js') }}"></script>
<script src="{{ asset('assets/js/order-summary.js') }}"></script>
<script src="{{ asset('assets/js/ordermodal.js') }}"></script>
<script src="{{ asset('assets/js/proceed.js') }}"></script>
<script src="{{ asset('assets/js/redirectorder.js') }}"></script>
<script src="{{ asset('assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/scrolltopcontrol.js') }}"></script>
<script src="{{ asset('assets/venobox/js/venobox.min.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
@endsection