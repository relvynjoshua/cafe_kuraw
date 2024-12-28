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
                        <div class="input-group password-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" id="signup-password" placeholder="Password" minlength="5" required>
                            <span class="toggle-password" onclick="togglePassword('signup-password', this)">
                                <i class="bx bx-show"></i>
                            </span>
                        </div>
                        <div class="input-group password-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password_confirmation" id="signup-password-confirmation" placeholder="Confirm password" minlength="5" required>
                            <span class="toggle-password" onclick="togglePassword('signup-password-confirmation', this)">
                                <i class="bx bx-show"></i>
                            </span>
                        </div>
                        <!-- Hidden OTP field -->
                        <input type="hidden" id="otp-hidden" name="otp">

                        <div id="error-messages" style="color: red; margin-bottom: 10px;"></div>
                        <button type="button" onclick="sendOTP(event)">Send OTP</button>
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
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <i class='bx bx-mail-send'></i>
                            <input type="email" name="email" placeholder="Enter your Email" value="{{ old('email') }}" required>
                        </div>
                        <div class="input-group password-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" id="signin-password" placeholder="Password" minlength="5" required>
                            <span class="toggle-password" onclick="togglePassword('signin-password', this)">
                                <i class="bx bx-show"></i>
                            </span>
                        </div>
                        <button type="submit">Sign in</button>
                    </form>
                    <p class="forgot-password">
                        <a href="{{ route('password.request') }}">Forgot password?</a>
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
<div id="otpModal" class="modal">
    <div class="modal-content">
        <!-- Error messages container (inside the OTP modal) -->
        <div id="otp-error-messages"></div>

        <!-- OTP Input and Verify Button -->
        <label for="otp-input">Please Enter OTP sent to your email:</label>
        <input type="text" id="otp-input" placeholder="Enter OTP" />

        <button onclick="verifyOTP()">Verify OTP</button>

        <!-- Cancel Button -->
        <button onclick="closeOTPModal()" class="cancel-btn">Cancel</button>
        <!-- Timer and Resend Button -->
        <div id="otp-timer">
            <span id="time-left">01:00</span> <!-- Countdown timer -->
            <button id="resend-btn" onclick="sendOTP(event)" style="display: none;">Resend OTP</button>
        </div>
    </div>
</div>


<script>
let timer;
let countdownTime = 60;  // Initial countdown time (60 seconds)
let otpSent = false; // Flag to track if OTP was sent


// Function to toggle password visibility
function togglePassword(inputId, toggleIcon) {
    const inputField = document.getElementById(inputId);
    const icon = toggleIcon.querySelector('i');

    if (inputField.type === 'password') {
        inputField.type = 'text';
        icon.classList.replace('bx-show', 'bx-hide');
    } else {
        inputField.type = 'password';
        icon.classList.replace('bx-hide', 'bx-show');
    }
}

    // Start the countdown timer
    function startTimer() {
        const timeLeftElement = document.getElementById('time-left');  // Element to display time
        const resendBtn = document.getElementById('resend-btn');  // Reference to resend button
        const otpErrorMessages = document.getElementById('otp-error-messages'); // Reference to error messages container

        resendBtn.style.display = 'none';  // Hide resend button initially
        otpErrorMessages.innerHTML = ''; // Clear any previous error messages

        // Start the countdown timer
        timer = setInterval(() => {
            const minutes = Math.floor(countdownTime / 60);
            const seconds = countdownTime % 60;
            timeLeftElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`; // Format time

            countdownTime--;  // Decrease countdown time by 1 second

            if (countdownTime < 0) {
                clearInterval(timer); // Stop the timer
                timeLeftElement.textContent = '00:00';  // Timer finished

                // Show OTP expired message
                otpErrorMessages.innerHTML = `
                    <div class="alert alert-danger mt-3" style="display: block;">
                        <strong>Error:</strong> OTP expired. Please resend OTP.
                    </div>`;

                resendBtn.style.display = 'block';  // Show the resend button again
                resendBtn.disabled = false;  // Enable the resend button after timer expires
            }
        }, 1000); // Update every second
    }

    // Function to handle Resending OTP
    function resendOTP() {
        const resendBtn = document.getElementById('resend-btn');
        resendBtn.disabled = true; // Disable the resend button immediately to prevent spamming

        // Call the function to resend OTP, this could be the same as sendOTP or a new function
        sendOTP(); // Resend OTP when clicked (you can define sendOTP logic here)

        // After OTP is resent, start the timer again and hide the resend button
        countdownTime = 60; // Reset countdown time to 60 seconds
        startTimer();  // Restart the timer
    }

// Function to Send OTP
async function sendOTP(event) {
    event.preventDefault();  // Prevent form submission
    
    // Disable the "Send OTP" button to prevent further clicks
    const sendOtpButton = event.target;  // Get the button that was clicked
    sendOtpButton.disabled = true;  // Disable the button

    // Reference to the error messages container
    const errorMessages = document.getElementById('error-messages');

    // Get form field values
    const email = document.getElementById('email');
    const password = document.getElementsByName('password')[0];
    const confirmPassword = document.getElementsByName('password_confirmation')[0];

    // Define password regex for validation
    const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    // Define email regex for validation
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    // Reset previous errors
    email.classList.remove('error');
    password.classList.remove('error');
    confirmPassword.classList.remove('error');
    errorMessages.innerHTML = ''; // Clear error messages

    // Start with no errors
    let errors = [];

    // Check if email field is empty
    if (!email.value.trim()) {
        email.classList.add('error');
        errors.push('Please fill out the email field.');
    } else if (!emailRegex.test(email.value)) { // Check if email format is correct
        email.classList.add('error');
        errors.push('Please enter a valid email address.');
    }

    // Check if password field is empty
    if (!password.value) {
        password.classList.add('error');
        errors.push('Please fill out the password field.');
    }

    // Check if confirm password field is empty
    if (!confirmPassword.value) {
        confirmPassword.classList.add('error');
        errors.push('Please fill out the confirm password field.');
    }

    // If there are any errors, display the first one and stop further validation
    if (errors.length > 0) {
        errorMessages.innerHTML = `
            <div class="alert alert-danger mt-3" style="display: block;">
                <strong>Error:</strong> ${errors[0]}
            </div>`;
        // Re-enable the button so the user can fix the error and try again
        sendOtpButton.disabled = false;
        return;  // Stop further validation and display the first error
    }

    // Check if passwords match
    if (password.value && confirmPassword.value && password.value !== confirmPassword.value) {
        password.classList.add('error');
        confirmPassword.classList.add('error');
        errors.push('Passwords do not match.');
    }

    // If there are any errors, display the first one and stop further validation
    if (errors.length > 0) {
        errorMessages.innerHTML = `
            <div class="alert alert-danger mt-3" style="display: block;">
                <strong>Error:</strong> ${errors[0]}
            </div>`;
        // Re-enable the button so the user can fix the error and try again
        sendOtpButton.disabled = false;
        return;  // Stop further validation and display the first error
    }

    // Validate password strength
    if (password.value && !passwordRegex.test(password.value)) {
        password.classList.add('error');
        errors.push('Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.');
    }

    // If there are any errors, display the first one and stop further validation
    if (errors.length > 0) {
        errorMessages.innerHTML = `
            <div class="alert alert-danger mt-3" style="display: block;">
                <strong>Error:</strong> ${errors[0]}
            </div>`;
        // Re-enable the button so the user can fix the error and try again
        sendOtpButton.disabled = false;
        return;  // Stop further validation and display the first error
    }

    // Check if email is already taken
    const emailTaken = await checkEmailAvailability(email.value);
    if (emailTaken) {
        email.classList.add('error');
        errorMessages.innerHTML = `
            <div class="alert alert-danger mt-3" style="display: block;">
                <strong>Error:</strong> Email is already taken. Please use another email.
            </div>`;
        // Re-enable the button so the user can fix the error and try again
        sendOtpButton.disabled = false;
        return;
    }

    // Send OTP request to the backend if validations pass
    fetch('/send-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email.value })
    })
    .then(response => {
        if (response.ok) {
            errorMessages.innerHTML = `
                <div class="alert alert-success mt-3" style="display: block;">
                    <strong>Success:</strong> OTP sent to your email!
                </div>`;
            document.getElementById('otpModal').style.display = 'flex';
            startTimer();  // Start OTP timer
        } else {
            errorMessages.innerHTML = `
                <div class="alert alert-danger mt-3" style="display: block;">
                    <strong>Error:</strong> Failed to send OTP. Please try again.
                </div>`;
        }

        // Re-enable the button after the OTP request is complete (success or failure)
        sendOtpButton.disabled = false;
    })
    .catch(() => {
        errorMessages.innerHTML = `
            <div class="alert alert-danger mt-3" style="display: block;">
                <strong>Error:</strong> An error occurred. Please try again later.
            </div>`;
        
        // Re-enable the button after the error is handled
        sendOtpButton.disabled = false;
    });
}

async function checkEmailAvailability(email) {
    try {
        const response = await fetch('/check-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email: email })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        return result.taken; // true if email is already taken
    } catch (error) {
        console.error("Error checking email availability:", error);
        return false; // Default to false when there's an error
    }
}

// Function to Verify OTP

function verifyOTP() {
    const enteredOTP = document.getElementById('otp-input').value;
    const errorMessages = document.getElementById('otp-error-messages'); // Reference to error messages inside OTP modal

    // Reset previous errors
    errorMessages.innerHTML = '';  // Clear any previous error messages inside the modal

    // Check if the OTP input is empty (basic validation)
    if (!enteredOTP) {
        errorMessages.innerHTML = `
            <div class="alert alert-danger mt-3" style="display: block;">
                <strong>Error:</strong> OTP cannot be empty. Please enter the OTP.
            </div>
        `;
        return; // Stop further execution if OTP is empty
    }

    // Make a POST request to verify OTP
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
            return response.json();  // Proceed if OTP verification is successful
        } else {
            // Display an error if response is not OK
            throw new Error('Invalid OTP');
        }
    })
    .then(() => {
        // Success: OTP verified
        alert("OTP verified successfully!");
        document.getElementById('otp-hidden').value = enteredOTP;
        document.getElementById('otpModal').style.display = 'none';
        document.getElementById('signup-form').submit();
    })
    .catch((error) => {
        // Error handling: Display error message inside the OTP modal
        errorMessages.innerHTML = `
            <div class="alert alert-danger mt-3" style="display: block;">
                <strong>Error:</strong> Invalid OTP. Please try again.
            </div>
        `;
    });
}

// Function to close OTP modal
function closeOTPModal() {
    document.getElementById('otpModal').style.display = 'none';
    clearInterval(timer);
}


document.getElementById('signup-form').addEventListener('submit', function (e) {
    const password = document.getElementsByName('password')[0].value;
    const confirmPassword = document.getElementsByName('password_confirmation')[0].value;
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; 

    // Password strength validation
    if (!passwordRegex.test(password)) {
        e.preventDefault();
        alert('Password must be at least 8 characters long, include an uppercase letter, a number, and a special character.');
        return;
    }

    // Confirm password match validation
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Passwords do not match.');
        return;
    }
});
</script>
@endsection
