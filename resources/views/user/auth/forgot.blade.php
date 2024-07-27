<form method="POST" action="{{ route('forgot-password') }}">
    @csrf
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
    </div>
    <button type="submit">Send Password Reset Link</button>
</form>