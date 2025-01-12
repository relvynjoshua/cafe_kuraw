@extends('layouts.auth')

@section('title', 'Kuraw Coffee Shop - Login / Register')

@section('content')

<div id="container" class="container">
    <!-- Welcome Message -->
    <div class="welcome-message">
        <h1>WELCOME TO KURAW COFFEE SHOP!</h1>
    </div>

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
                            <input type="text" name="firstname" placeholder="Name" value="{{ old('firstname') }}"
                                required>
                        </div>
                        <div class="input-group">
                            <i class='bx bx-mail-send'></i>
                            <input type="email" name="email" id="email" placeholder="Enter your Email"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="input-group password-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" id="signup-password" placeholder="Password"
                                minlength="5" required>
                            <span class="toggle-password" onclick="togglePassword('signup-password', this)">
                                <i class="bx bx-show"></i>
                            </span>
                        </div>
                        <div class="input-group password-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password_confirmation" id="signup-password-confirmation"
                                placeholder="Confirm password" minlength="5" required>
                            <span class="toggle-password"
                                onclick="togglePassword('signup-password-confirmation', this)">
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

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Error Message -->
                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <!-- Email Input -->
                        <div class="input-group">
                            <i class='bx bx-mail-send'></i>
                            <input type="email" name="email" placeholder="Enter your Email" value="{{ old('email') }}"
                                class="{{ $errors->has('email') ? 'error' : '' }}" required>
                        </div>

                        <!-- Password Input -->
                        <div class="input-group password-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" id="signin-password" placeholder="Password"
                                minlength="5" required>
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

<!-- Send OTP Button -->
<button onclick="sendOTPWithLoader()">Send OTP</button>
<div id="loading-spinner" class="spinner" style="display: none;"></div>

<!-- OTP Verification Modal -->
<div id="otpModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>One-Time PIN Sent!</h2>
        </div>
        <div class="modal-body">
            <p>
                We have sent a PIN to your email. Please enter OTP below.
            </p>

            <div class="otp-inputs">
                <input type="text" maxlength="1" class="otp-digit" oninput="moveToNext(this)"
                    onkeydown="moveToPrevious(this, event)" />
                <input type="text" maxlength="1" class="otp-digit" oninput="moveToNext(this)"
                    onkeydown="moveToPrevious(this, event)" />
                <input type="text" maxlength="1" class="otp-digit" oninput="moveToNext(this)"
                    onkeydown="moveToPrevious(this, event)" />
                <input type="text" maxlength="1" class="otp-digit" oninput="moveToNext(this)"
                    onkeydown="moveToPrevious(this, event)" />
                <input type="text" maxlength="1" class="otp-digit" oninput="moveToNext(this)"
                    onkeydown="moveToPrevious(this, event)" />
                <input type="text" maxlength="1" class="otp-digit" oninput="moveToNext(this)"
                    onkeydown="moveToPrevious(this, event)" />
            </div>

            <div id="otp-error-messages"></div> <!-- Error messages container -->
            <div style="display: flex; flex-direction: column; align-items: center; margin-top: 20px;">
                <div style="display: flex; gap: 10px;">
                    <button id="resend-otp" style="display: none;" onclick="resendOTP()">Resend OTP</button>
                    <button onclick="verifyOTP()">Proceed</button>
                </div>
                <p id="resend-timer" style="margin-top: 10px;">Resend OTP (<span id="timer">15:00</span>)</p>
            </div>
        </div>
    </div>
</div>


<script>
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

    function moveToNext(input) {
        if (input.value.length === 1) {
            const nextInput = input.nextElementSibling;
            if (nextInput) {
                nextInput.focus();
            }
        }
    }

    // Start the countdown timer
    function startTimer() {
        const timeLeftElement = document.getElementById('timer');  // Element to display time
        const resendBtn = document.getElementById('resend-otp');  // Reference to resend button
        const otpErrorMessages = document.getElementById('otp-error-messages'); // Reference to error messages container

        resendBtn.style.display = 'none';  // Hide resend button initially
        otpErrorMessages.innerHTML = ''; // Clear any previous error messages

        // Start the countdown timer
        let countdownTime = 15 * 60; // 15 minute countdown (4 * 60 seconds)
        let timer = setInterval(() => {
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
        const resendBtn = document.getElementById('resend-otp');
        const loadingSpinner = document.getElementById('loading-spinner');
        resendBtn.disabled = true; // Disable the resend button immediately to prevent spamming

        // Show loading spinner
        loadingSpinner.style.display = 'block';

        // Show "Resending..." loader
        resendBtn.innerText = "resending...";

        // Call the function to resend OTP
        fetch('/send-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email: document.getElementById('email').value })
        })
            .then(response => {
                if (response.ok) {
                    document.getElementById('otpModal').style.display = 'flex';
                    startTimer();  // Start OTP timer
                } else {
                    throw new Error('Failed to send OTP');  // Handle errors appropriately
                }
            })
            .catch(error => {
                console.error('Error resending OTP:', error);
                // Show error message in the modal
                document.getElementById('otp-error-messages').innerHTML = `
            <div class="alert alert-danger mt-3" style="display: block;">
                <strong>Error:</strong> An error occurred while resending the OTP. Please try again later.
            </div>`;
            })
            .finally(() => {
                loadingSpinner.style.display = 'none'; // Hide spinner after completion
                resendBtn.disabled = false;  // Re-enable the button
            });
    }



    async function sendOTP(event) {
        event.preventDefault();  // Prevent form submission

        // Get the button that was clicked
        const sendOtpButton = event.target;
        // Reference to the error messages container
        const errorMessages = document.getElementById('error-messages');

        // Get form field values
        const firstname = document.getElementsByName('firstname')[0];
        const email = document.getElementById('email');
        const password = document.getElementsByName('password')[0];
        const confirmPassword = document.getElementsByName('password_confirmation')[0];

        // Define password and email regex for validation
        const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        // Reset previous errors
        [firstname, email, password, confirmPassword].forEach(input => input.classList.remove('error'));
        errorMessages.innerHTML = ''; // Clear previous error messages

        // Start with no errors
        let errors = [];

        // Validate fields
        if (!firstname.value.trim()) {
            firstname.classList.add('error');
            errors.push('Name field is required.');
        }

        if (!email.value.trim()) {
            email.classList.add('error');
            errors.push('Please fill out the email field.');
        } else if (!emailRegex.test(email.value)) {
            email.classList.add('error');
            errors.push('Please enter a valid email address.');
        }

        if (!password.value) {
            password.classList.add('error');
            errors.push('Please fill out the password field.');
        }

        if (!confirmPassword.value) {
            confirmPassword.classList.add('error');
            errors.push('Please fill out the confirm password field.');
        }

        if (password.value !== confirmPassword.value) {
            password.classList.add('error');
            confirmPassword.classList.add('error');
            errors.push('Passwords do not match.');
        }

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
            sendOtpButton.disabled = false;  // Re-enable the button
            return;
        }

        // Show "Sending..." loader after all validations are successful
        sendOtpButton.innerText = "Sending...";
        sendOtpButton.disabled = true;

        // Send OTP request to the backend
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
                    // If email is already taken, show this message
                    errorMessages.innerHTML = `
                <div class="alert alert-danger mt-3" style="display: block;">
                    <strong>Error:</strong> Email is already taken. Please use another email.
                </div>`;
                }
            })
            .catch(() => {
                errorMessages.innerHTML = `
            <div class="alert alert-danger mt-3" style="display: block;">
                <strong>Error:</strong> An error occurred. Please try again later.
            </div>`;
            })
            .finally(() => {
                sendOtpButton.innerText = "Send OTP";  // Reset button text after completion
                sendOtpButton.disabled = false;  // Re-enable the button
            });
    }


    // Function to Verify OTP
    function verifyOTP() {
        const otpInputs = document.querySelectorAll('.otp-digit');
        const enteredOTP = Array.from(otpInputs).map(input => input.value).join('');
        const errorMessages = document.getElementById('otp-error-messages'); // Reference to error messages inside OTP modal

        // Reset previous errors
        errorMessages.innerHTML = '';  // Clear any previous error messages inside the modal

        // Check if the OTP input is empty (basic validation)
        if (enteredOTP.length !== 6) {
            errorMessages.innerHTML = `
            <div class="alert alert-danger mt-3" style="display: block;">
                <strong>Error:</strong> Please enter a 6-digit OTP.
            </div>
        `;
            return; // Stop further execution if OTP is incomplete
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

    function moveToNext(current) {
        if (current.value.length === current.maxLength) {
            let next = current.nextElementSibling; // Get the next sibling
            if (next && next.classList.contains('otp-digit')) {
                next.focus(); // Focus the next input
            }
        }
    }

    function moveToPrevious(current, event) {
        if (event.key === "Backspace" && current.value === "") {
            let previous = current.previousElementSibling; // Get the previous sibling
            if (previous && previous.classList.contains('otp-digit')) {
                previous.focus(); // Focus the previous input
            }
        }
    }

    // Select the input fields and error message container
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('signin-password');
    const errorMessage = document.querySelector('.alert.alert-danger');

    // Check if error message exists
    if (errorMessage) {
        const errorText = errorMessage.textContent.trim();

        // Check for specific errors
        if (errorText.includes("Invalid email") || errorText.includes("password")) {
            emailInput.classList.add('error');
            passwordInput.classList.add('error');
        } else {
            emailInput.classList.remove('error');
            passwordInput.classList.remove('error');
        }
    } else {
        // No error message, remove the error state
        emailInput.classList.remove('error');
        passwordInput.classList.remove('error');
    }
</script>
@endsection