<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SeekMed</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    @vite('resources/css/login.css')
</head>
<body>
    <div class="login-container">
        <h2 class="login-title">Create Your Account</h2>
        <p class="login-subtitle">Sign up to start using SeekMed</p>
        <form action={{route('register.post')}} method="POST" class="login-form">
            @csrf
            <input type="email" name="email" placeholder="Email" required value={{old('email')}}>
            <input type="text" name="username" placeholder="Username" required value={{old('username')}}>
            <select name="role">
                <option value="">Choose your role</option>
                <option value="user" {{old('role') === 'user'?'selected':""}}>User</option>
                <option value="doctor" {{old('role') === 'doctor'?'selected':""}}>Doctor</option>
            </select>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <label>
                <input type="checkbox" name="remember" {{old('remember')?'checked':''}}> Remember me
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
            <button type="submit" class="btn-login">Sign Up</button>
        </form>
        <p class="signup-link">Already have an account? <a href={{route('login')}}>Login</a></p>
    </div>
</body>
</html>