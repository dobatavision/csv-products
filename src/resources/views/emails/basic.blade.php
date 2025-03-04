<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Processing Notification</title>
</head>
<body>
    <h1>Hello, {{ $details['name'] }}</h1>
    <p>Your CSV file processing has been {{ $details['status'] }}.</p>
    <p>File Path: {{ $details['file_path'] }}</p>
</body>
</html>
