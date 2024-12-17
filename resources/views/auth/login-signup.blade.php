@extends('layouts.auth')

@section('title', 'Kuraw Coffee Shop - Login / Register')

@section('content')
<div id="container" class="container">
    <!-- FORM SECTION -->
    <div class="row">
        <!-- SIGN UP SECTION -->
        <div class="col align-items-center flex-col sign-up">
            <div class="form-wrapper align-items-center">
                <div class="form sign-up">
                    <h2>Sign Up</h2>
                    <form id="signup-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input-group">
                            <i class='bx bxs-user'></i>
                            <input type="text" name="firstname" placeholder="Name" value="{{ old('firstname') }}" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bx-mail-send'></i>
                            <input type="email" name="email" id="email" placeholder="Enter your Email" value="{{ old('email') }}" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" placeholder="Password" minlength="5" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password_confirmation" placeholder="Confirm password" minlength="5" required>
                        </div>
                        <!-- Hidden OTP field -->
                        <input type="hidden" id="otp-hidden" name="otp">

                        <button type="submit" onclick="sendOTP(event)">Send OTP</button>
                    </form>
                    <p>
                        <span>Already have an account?</span>
                        <b onclick="toggle()" class="pointer">Sign in here</b>
                    </p>
                </div>
            </div>
        </div>

        <!-- SIGN IN SECTION -->
        <div class="col align-items-center flex-col sign-in">
            <div class="form-wrapper align-items-center">
                <div class="form sign-in">
                    <h2>Sign In</h2>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <i class='bx bx-mail-send'></i>
                            <input type="email" name="email" placeholder="Enter your Email" value="{{ old('email') }}" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" id="signin-password" placeholder="Password" minlength="5" required>
                        </div>
                        <button type="submit">Sign in</button>
                    </form>
                    <p>
                        <b>Forgot password?</b>
                    </p>
                    <p>
                        <span>Don't have an account?</span>
                        <b onclick="toggle()" class="pointer">Sign up here</b>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- OTP Verification Modal -->
<div id="otpModal" style="display: none;">
    <div class="modal-content">
        <h3>Verify OTP</h3>
        <p>An OTP has been sent to your email. Please enter it below:</p>
        <input type="text" id="otp-input" placeholder="Enter OTP" required>
        <button onclick="verifyOTP()">Verify OTP</button>
        <button onclick="closeOTPModal()">Cancel</button>
        <p id="timer">Time left: <span id="time-left">03:00</span></p>
    </div>
</div>

<script>
let timer;
let countdownTime = 180;

// Function to Send OTP
function sendOTP(event) {
    event.preventDefault();  // Prevent form submission

    const email = document.getElementById('email').value;

    // AJAX request to send OTP
    fetch('/send-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            return response.json().then(data => {
                throw new Error(data.error || 'Failed to send OTP. Please try again.');
            });
        }
    })
    .then(data => {
        alert("OTP sent to your email!");
        document.getElementById('otpModal').style.display = 'flex'; // Display modal as a flexbox
        startTimer();
    })
    .catch(error => {
        alert(error.message);
    });
}

// Function to Verify OTP
function verifyOTP() {
    const enteredOTP = document.getElementById('otp-input').value;

    fetch('/verify-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ otp: enteredOTP })
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            return response.json().then(data => {
                throw new Error(data.error || 'Invalid OTP. Please try again.');
            });
        }
    })
    .then(data => {
        alert("OTP verified successfully!");
        document.getElementById('otp-hidden').value = enteredOTP;
        document.getElementById('otpModal').style.display = 'none';
        document.getElementById('signup-form').submit();
    })
    .catch(error => {
        alert(error.message);
    });
}

function closeOTPModal() {
    document.getElementById('otpModal').style.display = 'none';
    clearInterval(timer);
}

// Start Countdown Timer
function startTimer() {
    const timeLeftElement = document.getElementById('time-left');
    timer = setInterval(() => {
        const minutes = Math.floor(countdownTime / 60);
        const seconds = countdownTime % 60;
        timeLeftElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        countdownTime--;

        if (countdownTime < 0) {
            clearInterval(timer);
            alert("OTP expired. Please resend OTP.");
        }
    }, 1000);
}
</script>

<style>
.modal-content {
    background-color: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 350px;
    max-width: 100%;
    animation: fadeIn 0.3s ease-in-out;
}

#otpModal {
    display: none;
    background-color: rgba(0, 0, 0, 0.7);
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.input-group input {
    width: 100%;
    padding: 10px 10px 10px 40px;
    border: 1px solid #ddd;
    border-radius: 10px;
    font-size: 1rem;
    outline: none;
    position: relative;
    background: #fff;
}

button {
    margin-top: 15px;
    padding: 10px 20px;
    background-color: #5cb85c;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #4cae4c;
}
</style>
@endsection