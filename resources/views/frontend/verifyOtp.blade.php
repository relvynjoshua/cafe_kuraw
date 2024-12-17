<form method="POST" action="{{ route('verify-otp') }}">
    @csrf
    <label for="otp">Enter OTP:</label>
    <input type="text" id="otp" name="otp" required>
    <button type="submit">Verify OTP</button>
</form>