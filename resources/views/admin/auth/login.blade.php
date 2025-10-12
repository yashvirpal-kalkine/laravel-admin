<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
<h2>Admin Login</h2>

<form method="POST" action="{{ route('admin.login') }}">
    @csrf
    <div>
        <label>Email</label>
        <input type="email" name="email" required autofocus>
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Login</button>
</form>

@if ($errors->any())
    <div>{{ $errors->first() }}</div>
@endif

</body>
</html>
