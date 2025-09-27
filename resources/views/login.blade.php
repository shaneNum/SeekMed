<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SeekMed</title>
    @vite('resources/css/login.css')
</head>
<body>
    <div class="login-container">
        <h2 class="login-title">Welcome Back!</h2>
        <p class="login-subtitle">Please login to your account</p>
        <form action={{route('login.post')}} method="POST" class="login-form">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <label>
                <input type="checkbox" name="remember"> Remember me
            </label>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="btn-login">Login</button>
        </form>
        <p class="signup-link">Don't have an account? <a href={{route('register')}}>Sign Up</a></p>
    </div>
</body>
</html>