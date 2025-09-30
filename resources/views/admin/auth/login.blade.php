<form method="POST" action="{{ route('admin.login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="checkbox" name="remember"> Remember Me
    <button type="submit">Login</button>
</form>
