<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP Verification</title>
</head>
<body>
    <form method="POST" action={{route('verify-otp')}}>
        @csrf
        <input type="hidden" name="email" value={{$email}}>
        <input type="hidden" name="service" value={{$service}}>
        <input type="hidden" name="remember" value={{$remember}}>
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" required value={{$old['otp']??''}}>
        <button type="submit">Verify</button>
    </form>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>