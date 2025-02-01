<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <div>
        <a href="{{ route('socialite.auth', 'facebook') }}">Facebook Login</a>
        <a href="{{ route('socialite.auth', 'google') }}">Google Login</a>
        <a href="{{ route('socialite.auth', 'github') }}">Github Login</a>
    </div>
</body>
</html>