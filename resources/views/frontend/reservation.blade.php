<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page Title -->
    <title>Kuraw Reservation</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font  -->
    <link
        href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800|Roboto:300,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">
    <!-- Icofont CSS -->
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }


        .container1-wrapper {
            display: flex;
            background-color: #967259;
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            margin-top: 30px;
            border-radius: 2rem;
        }

        #month-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .arrow-button {
            background-color: transparent;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #ffff;
        }

        #currentMonth {
            font-size: 24px;
            font-weight: bold;
            color: #ffff;
            margin: 0 10px;
        }

        .calendar-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        #calendar {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        #calendar th,
        #calendar td {
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        #calendar th {
            background-color: #967259;
            color: #fff;
            font-weight: bold;
        }

        #calendar td {
            cursor: pointer;
            text-align: center;
        }

        .reservation-details {
            flex: 1;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 2rem;
        }

        .reservation-details h2 {
            font-size: 28px;
            margin-bottom: 16px;
            text-align: center;
            color: #967259;
        }

        .form-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            color: #967259;
        }


        .form-control {
            width: 300px;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #967259;
        }

        .btn-primary {
            background-color: #967259;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bolder;
        }
    </style>
</head>


<body id="main">
    <!-- START HEADER SECTION -->
    <header class="main-header">
        <div class="sticky-menu">
            <div class="mainmenu-area">
                <div class="auto-container">
                    <nav class="navbar navbar-expand-lg">
                        <ul class="navbar-nav">
                            <li><a href="index.html" class="nav-link">Home</a></li>
                            <li><a href="about.html" class="nav-link">About Us</a></li>
                            <li><a href="reservation.html" class="nav-link">Reservation</a></li>
                            <li><a href="gallery.html" class="nav-link">Gallery</a></li>
                            <li class="dropdown"><a class="nav-link" href="#">Pages</a>
                                <ul class="dropdown-menu">
                                    <li><a href="teachers.html">Administration</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                </ul>
                            </li>
                            <li><a href="blog.html" class="nav-link">News</a></li>
                            <li><a href="contact.html" class="nav-link">Contact</a></li>
                            <li><a href="admin.html" class="nav-link">Admin</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- END HEADER SECTION -->

    <div class="container1-wrapper">
        <div class="calendar-container">
            <div id="month-nav">
                <button id="prevMonth" class="arrow-button">◀</button>
                <span id="currentMonth"></span>
                <button id="nextMonth" class="arrow-button">▶</button>
            </div>
            <div id="calendar-container">
                <table id="calendar">
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

        <div class="reservation-details">
            <h2>Reservation Details</h2>
            <form id="reservation-form" action="{{ route('reservation.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" name="phone_number" id="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="reservationDate">Reservation Date:</label>
                    <input type="date" name="reservation_date" id="reservationDate" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="reservationTime">Reservation Time:</label>
                    <input type="time" name="reservation_time" id="reservationTime" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="number_of_guests">Number of Guests:</label>
                    <input type="number" name="number_of_guests" id="number_of_guests" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="note">Notes:</label>
                    <textarea name="note" id="note" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit Reservation</button>
                </div>
            </form>

        </div>
    </div>


    <!-- Latest jQuery -->
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <!-- popper js -->
    <script src="assets/bootstrap/js/popper.min.js"></script>
    <!-- Latest compiled and minified Bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <script>
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
                    if ((i === 0 && j < startingDay) || date > totalDays) {
                        row.appendChild(cell);
                    } else {
                        cell.textContent = date;
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

        document.getElementById("reservation-form").addEventListener("submit", function (event) {
            event.preventDefault();
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const phone = document.getElementById("phone").value;
            const reservationDate = document.getElementById("reservationDate").value;
            const reservationTime = document.getElementById("reservationTime").value;

            alert(`Reservation for ${name} on ${reservationDate} at ${reservationTime} has been received. We will contact you at ${email}.`);
        });
    </script>
</body>

</html>