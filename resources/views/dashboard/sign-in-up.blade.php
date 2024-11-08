<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up / Sign In</title>
    
</head>
<body>
<div id="container" class="container">
    <!-- FORM SECTION -->
    <div class="row">
        <!-- SIGN UP -->
        <div class="col align-items-center flex-col sign-up">
            <div class="form-wrapper align-items-center">
                <div class="form sign-up">
                <form action="{{ route('register') }}" method="POST">
   REGISTER
    <div class="input-group">
        <i class='bx bxs-user'></i>
        <input type="text" name="firstname" placeholder="Firstname" value="{{ old('firstname') }}" required>
    </div>
    <div class="input-group">
        <i class='bx bxs-user'></i>
        <input type="text" name="lastname" placeholder="Lastname" value="{{ old('lastname') }}" required>
    </div>
    <div class="input-group">
        <i class='bx bxs-user'></i>
    </div>
    <div class="input-group">
        <i class='bx bxs-user'></i>
        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
    </div>
    <div class="input-group">
        <i class='bx bx-mail-send'></i>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
    </div>
    <div class="input-group">
        <i class='bx bxs-lock-alt'></i>
        <input type="password" name="password" placeholder="Password" minlength="5" required>
    </div>
    <div class="input-group">
        <i class='bx bxs-lock-alt'></i>
        <input type="password" name="password_confirmation" placeholder="Confirm password" minlength="5" required>
    </div>
    <button type="submit">Sign up</button>
</form>
                    <p>
                        <span>
                            Already have an account?
                        </span>
                        <b onclick="toggle()" class="pointer">
                            Sign in here
                        </b>
                    </p>
                </div>
            </div>
        </div>
        <!-- END SIGN UP -->

        <!-- SIGN IN -->
        <div class="col align-items-center flex-col sign-in">
            <div class="form-wrapper align-items-center">
                <div class="form sign-in">
                <form action="{{ route('login') }}" method="POST">
    LOGIN
    <div class="input-group">
        <i class='bx bxs-user'></i>
        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
    </div>
    <div class="input-group">
        <i class='bx bxs-lock-alt'></i>
        <input type="password" name="password" placeholder="Password" minlength="5" required>
    </div>
    <button type="submit">Sign in</button>
</form>

                    <p>
                        <b onclick="forgotPassword()" class="pointer">
                            Forgot password?
                        </b>
                    </p>
                    <p>
                        <span>
                            Don't have an account?
                        </span>
                        <b onclick="toggle()" class="pointer">
                            Sign up here
                        </b>
                    </p>
                </div>
            </div>

            <!-- Forgot Password Modal -->
            <div id="forgot-password-modal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeForgotPasswordModal()">&times;</span>
                    <h2>Forgot Password</h2>
                    <p>Please enter your email address. You will receive a link to create a new password via email.</p>
                    <div class="input-group">
                        <i class='bx bx-mail-send'></i>
                        <input type="email" id="forgot-password-email" placeholder="Email" required>
                    </div>
                    <button onclick="submitForgotPassword()">Submit</button>
                </div>
            </div>
        </div>
        <!-- END SIGN IN -->
    </div>
</div>

        
    </div>
    <div id="custom-alert" class="custom-alert">
        <div class="custom-alert-content">
            <span id="custom-alert-message"></span>
            <button id="custom-alert-ok" onclick="closeCustomAlert()">OK</button>
        </div>
    </div>
    
    

                <div class="logo-wrapper">
                    <img src="logo.png" alt="Logo" class="logo"> <!-- Logo added here -->
                </div>
            </div>
            <!-- END SIGN IN -->
        </div>
        <!-- END FORM SECTION -->
        <!-- CONTENT SECTION -->
        <div class="row content-row">
            <!-- SIGN IN CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="text sign-in">
                    <h2>
                        Welcome
                    </h2>
                </div>
            </div>
            <!-- END SIGN IN CONTENT -->
            <!-- SIGN UP CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="text sign-up">
                    <h2>
                        Join with us
                    </h2>
                </div>
            </div>
            <!-- END SIGN UP CONTENT -->
        </div>
        <!-- END CONTENT SECTION -->
    </div>
    
    <style>
    :root {
        --primary-color: #967259;
        --secondary-color: #bd9578;
        --black: #000000;
        --white: #ffffff;
        --gray: #efefef;
        --gray-2: #757575;
        --background-color: #ece0d1;
    
        --facebook-color: #4267B2;
        --google-color: #DB4437;
        --twitter-color: #1DA1F2;
        --insta-color: #E1306C;
    }
    
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
    
    * {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    html,
    body {
        height: 100vh;
        overflow: hidden;
    }
    
    .container {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
    }
    
    .row {
        display: flex;
        flex-wrap: wrap;
        height: 100vh;
    }
    
    .col {
        width: 50%;
    }
    
    .align-items-center {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    
    /* Adjust the form width */
    .form-wrapper {
        width: 100%;
        max-width: 23rem; /* Reduced from 28rem to 20rem */
    }
    
    /* Adjust padding and margins */
    .form {
        padding: 0.8rem; /* Reduced padding */
        background-color: var(--white);
        border-radius: 1rem; /* Reduced border-radius */
        width: 100%;
        box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 12px; /* Slightly smaller shadow */
        transform: scale(0);
        transition: .5s ease-in-out;
        transition-delay: 1s;
    }
    
    .input-group {
        position: relative;
        width: 100%;
        margin: 1rem 0;
    }
    
    /* Adjust input field padding */
    .input-group i {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
        font-size: 1.2rem;
        color: var(--gray-2);
    }
    
    .input-group input,
    .input-group select {
        width: 100%;
        padding: 0.8rem 2rem; /* Reduced padding */
        font-size: 0.9rem; /* Reduced font size */
        background-color: var(--gray);
        border-radius: .4rem; /* Reduced border-radius */
        border: 0.1rem solid var(--white);
        outline: none;
    }
    
    .input-group input:focus,
    .input-group select:focus {
        border: 0.125rem solid var(--primary-color);
    }
    
    /* Adjust button size */
    .form button {
        cursor: pointer;
        width: 100%;
        padding: 0.5rem 0; /* Reduced padding */
        border-radius: .4rem; /* Reduced border-radius */
        border: none;
        background-color: var(--primary-color);
        color: var(--white);
        font-size: 1rem; /* Reduced font size */
        outline: none;
    }
    
    /* Adjust paragraph font size */
    .form p {
        margin: 0.8rem 0; /* Reduced margin */
        font-size: 0.6rem; /* Reduced font size */
    }
    
    .flex-col {
        flex-direction: column;
    }
    
    .social-list {
        margin: 2rem 0;
        padding: 1rem;
        border-radius: 1rem; /* Reduced border-radius */
        width: 100%;
        box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 12px; /* Slightly smaller shadow */
        transform: scale(0);
        transition: .5s ease-in-out;
        transition-delay: 1.2s;
    }
    
    .social-list>div {
        color: var(--white);
        margin: 0 .5rem;
        padding: .6rem; /* Reduced padding */
        cursor: pointer;
        border-radius: .4rem; /* Reduced border-radius */
        cursor: pointer;
        transform: scale(0);
        transition: .5s ease-in-out;
    }
    
    .social-list>div:nth-child(1) {
        transition-delay: 1.4s;
    }
    
    .social-list>div:nth-child(2) {
        transition-delay: 1.6s;
    }
    
    .social-list>div:nth-child(3) {
        transition-delay: 1.8s;
    }
    
    .social-list>div:nth-child(4) {
        transition-delay: 2s;
    }
    
    .social-list>div>i {
        font-size: 1.3rem; /* Reduced font size */
        transition: .4s ease-in-out;
    }
    
    .social-list>div:hover i {
        transform: scale(1.5);
    }
    
    .facebook-bg {
        background-color: var(--facebook-color);
    }
    
    .google-bg {
        background-color: var(--google-color);
    }
    
    .twitter-bg {
        background-color: var(--twitter-color);
    }
    
    .insta-bg {
        background-color: var(--insta-color);
    }
    
    .pointer {
        cursor: pointer;
    }
    
    .container.sign-in .form.sign-in,
    .container.sign-in .social-list.sign-in,
    .container.sign-in .social-list.sign-in>div,
    .container.sign-up .form.sign-up,
    .container.sign-up .social-list.sign-up,
    .container.sign-up .social-list.sign-up>div {
        transform: scale(1);
    }
    
    .content-row {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: 6;
        width: 100%;
    }
    
    .text {
        margin: 4rem;
        color: var(--white);
    }
    
    .text h2 {
        font-size: 3.5rem;
        font-weight: 800;
        margin: 2rem 0;
        transition: 1s ease-in-out;
    }
    
    .text p {
        font-weight: 600;
        transition: 1s ease-in-out;
        transition-delay: .2s;
    }
    
    .img img {
        width: 30vw;
        transition: 1s ease-in-out;
        transition-delay: .4s;
    }
    
    .text.sign-in h2,
    .text.sign-in p,
    .img.sign-in img {
        transform: translateX(-250%);
    }
    
    .text.sign-up h2,
    .text.sign-up p,
    .img.sign-up img {
        transform: translateX(250%);
    }
    
    .container.sign-in .text.sign-in h2,
    .container.sign-in .text.sign-in p,
    .container.sign-in .img.sign-in img,
    .container.sign-up .text.sign-up h2,
    .container.sign-up .text.sign-up p,
    .container.sign-up .img.sign-up img {
        transform: translateX(0);
    }
    
    /* BACKGROUND */
    
    .container::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        height: 100vh;
        width: 300vw;
        transform: translate(35%, 0);
        background-image: linear-gradient(-45deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        transition: 1s ease-in-out;
        z-index: 6;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        border-bottom-right-radius: max(50vw, 50vh);
        border-top-left-radius: max(50vw, 50vh);
    }
    
    .container.sign-in::before {
        transform: translate(0, 0);
        right: 50%;
    }
    
    .container.sign-up::before {
        transform: translate(100%, 0);
        right: 50%;
    }
    
    /* RESPONSIVE */
    
    @media only screen and (max-width: 425px) {
    
        .container::before,
        .container.sign-in::before,
        .container.sign-up::before {
            height: 100vh;
            border-bottom-right-radius: 0;
            border-top-left-radius: 0;
            z-index: 0;
            transform: none;
            right: 0;
        }
    
        .container.sign-in .col.sign-in,
        .container.sign-up .col.sign-up {
            transform: translateY(0);
        }
    
        .content-row {
            align-items: flex-start !important;
        }
    
        .content-row .col {
            transform: translateY(0);
            background-color: unset;
        }
    
        .col {
            width: 100%;
            position: absolute;
            padding: 2rem;
            background-color: var(--white);
            border-top-left-radius: 2rem;
            border-top-right-radius: 2rem;
            transform: translateY(100%);
            transition: 1s ease-in-out;
        }
    
        .row {
            align-items: flex-end;
            justify-content: flex-end;
        }
    
        .form,
        .social-list {
            box-shadow: none;
            margin: 0;
            padding: 0;
        }
    
        .text {
            margin: 0;
        }
    
        .text p {
            display: none;
        }
    
        .text h2 {
            margin: .5rem;
            font-size: 2rem;
        }
    }
    
    /* Logo CSS */
    .logo-wrapper {
        position: absolute;
        top: 10px; /* Adjust as needed */
        left: 10px; /* Adjust as needed */
        z-index: 10;
    }
    
    .logo {
        width: 150px; /* Adjust logo size as needed */
        height: auto;
    }
    
    /* Modal Background */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; 
        z-index: 1000; /* On top of everything */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        background-color: rgba(0, 0, 0, 0.5); /* Black with opacity */
        align-items: center;
        justify-content: center;
    }
    
    /* Modal Content */
    .modal-content {
        background-color: var(--white);
        padding: 2rem;
        border-radius: 0.5rem;
        width: 90%;
        max-width: 400px;
        box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 12px;
        text-align: center;
        position: relative;
    }
    
    /* Close Button */
    .close-btn {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--black);
        cursor: pointer;
    }
    
    /* Modal Heading */
    .modal-content h2 {
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }
    
    /* Modal Input */
    .modal-content .input-group {
        margin: 1rem 0;
        position: relative;
        width: 100%;
    }
    
    .modal-content .input-group i {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
        font-size: 1.2rem;
        color: var(--gray-2);
    }
    
    .modal-content .input-group input {
        width: 100%;
        padding: 0.8rem 2rem;
        font-size: 0.9rem;
        background-color: var(--gray);
        border-radius: 0.4rem;
        border: 0.1rem solid var(--white);
        outline: none;
    }
    
    .modal-content .input-group input:focus {
        border: 0.125rem solid var(--primary-color);
    }
    
    /* Modal Button */
    .modal-content button {
        width: 100%;
        padding: 0.8rem;
        background-color: var(--primary-color);
        border: none;
        border-radius: 0.4rem;
        color: var(--white);
        font-size: 1rem;
        cursor: pointer;
        outline: none;
    }
    
    /* Custom Alert Modal */
    #custom-alert {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background-color: var(--white);
        padding: 20px;
        border-radius: 0.5rem;
        box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 12px;
        text-align: center;
        width: 300px; /* Adjust width as needed */
    }
    
    /* Alert Message */
    #custom-alert-message {
        margin-bottom: 20px;
        font-size: 1.3rem;
    }
    
    /* OK Button */
    #custom-alert button {
        width: 100px; /* Button width */
        padding: 5px;
        background-color: var(--primary-color);
        border: none;
        border-radius: 0.4rem;
        color: var(--white);
        font-size: 1rem;
        cursor: pointer;
        outline: none;
        display: block;
        margin: 0 auto; /* Center the button */
    }

</style>
    
<script>
    // Function to toggle between sign-in and sign-up views
let container = document.getElementById('container');

function toggle() {
    container.classList.toggle('sign-in');
    container.classList.toggle('sign-up');
}

// Initialize sign-in view on page load
setTimeout(() => {
    container.classList.add('sign-in');
}, 200);

// Function to open the Forgot Password modal
function forgotPassword() {
    document.getElementById('forgot-password-modal').style.display = 'flex';
}

// Function to close the Forgot Password modal
function closeForgotPasswordModal() {
    document.getElementById('forgot-password-modal').style.display = 'none';
}

// Function to display a custom alert
function showCustomAlert(message) {
    document.getElementById('custom-alert-message').innerText = message;
    document.getElementById('custom-alert').style.display = 'flex';
}

// Function to close the custom alert
function closeCustomAlert() {
    document.getElementById('custom-alert').style.display = 'none';
}

// Function to validate the Forgot Password form
function submitForgotPassword() {
    let email = document.getElementById('forgot-password-email');
    if (email.value.trim() === "") {
        email.style.border = "2px solid red";
        showCustomAlert("Email is required!");
    } else {
        email.style.border = ""; // Reset border
        showCustomAlert("Password reset link has been sent to your email.");
        closeForgotPasswordModal(); // Close the modal after submission
    }
}

// Function to validate a form
function validateForm(form) {
    let valid = true;
    const inputs = form.querySelectorAll('input[required], select[required]');
    
    inputs.forEach(input => {
        if (input.value.trim() === "") {
            input.style.border = "2px solid red";
            valid = false;
        } else {
            input.style.border = ""; // Reset border
        }
    });
    
    return valid;
}

// Event listener for sign-up form submission
document.querySelector('.form.sign-up button').addEventListener('click', function(event) {
    const form = document.querySelector('.form.sign-up');
    if (!validateForm(form)) {
        event.preventDefault();
        showCustomAlert("Please fill in all required fields.");
    }
});

// Event listener for sign-in form submission
document.querySelector('.form.sign-in button').addEventListener('click', function(event) {
    const form = document.querySelector('.form.sign-in');
    if (!validateForm(form)) {
        event.preventDefault();
        showCustomAlert("Please fill in all required fields.");
    }
});
</script>
</body>
</html>