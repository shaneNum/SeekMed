<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body>
    <img src="{{$user->profile_picture_data}}">
    <span>Name: {{$user->username}}</span>
    <br>
    @if ($isOwner)
        <form method="POST" enctype="multipart/form-data" action={{route('user.update', $user)}}>
            @csrf
            <label>Username: </label>
            <input type="text" name="username" value={{$user->username}}>
            <br><br>
            <label>Profile Picture: </label>
            <input type="file" name="profile_picture" accept="image/*">
            <button type="submit">Update</button>
        </form>
        @if(session('success'))
            {{session('success')}}
        @endif
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @else
        <span>This is {{$user->username}}'s public profile!</span>
    @endif
</body>
</html>