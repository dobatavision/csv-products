<!DOCTYPE html>
<html>
<body>
    <h1>Hello, {{ $details['name'] }}</h1>
    <p>Please click the following link to login: <a href="{{ $details['action_url'] }}">{{ $details['action_url'] }}</a></p>
</body>
</html>
