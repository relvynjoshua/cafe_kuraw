@extends('layouts.auth') <!-- Extending the new auth layout -->

@section('title', 'Kuraw Coffee Shop - Login / Register')

@section('content')
<div id="container" class="container">
    <!-- FORM SECTION -->
    <div class="row">
        <!-- SIGN UP -->
        <div class="col align-items-center flex-col sign-up">
            <div class="form-wrapper align-items-center">
                <div class="form sign-up">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <i class='bx bxs-user'></i>
                            <input type="text" name="firstname" placeholder="Name" value="{{ old('firstname') }}"
                                required>
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
                            <input type="password" name="password_confirmation" placeholder="Confirm password"
                                minlength="5" required>
                        </div>
                        <button type="submit">
                            Sign up
                        </button>
                    </form>
                    <p>
                        <span>
                            Already have an account?
                        </span>
                        <b onclick="toggle()" class="pointer">
                            Sign in here
                        </b>
                    </p>
                    <p>
                        <a href="{{ url('/') }}">
                            <span>
                            Go back to Home
                            </span>
                        </a>
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
                        @csrf
                        <div class="input-group">
                            <i class='bx bxs-user'></i>
                            <input type="text" name="firstname" placeholder="Username" value="{{ old('firstname') }}"
                                required>
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" placeholder="Password" minlength="5" required>
                        </div>
                        <button type="submit">
                            Sign in
                        </button>
                    </form>
                    <p>
                        <b>
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
                    <p>
                        <a href="{{ url('/') }}">
                            <span>
                            Go back to Home
                            </span>
                        </a>
                    </p>
                </div>
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
@endsection