<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <p>To reset your password, click the link below:</p>
    <a href="{{ url('/reset-password/'.$token) }}">Reset Password</a>
</body>
</html>
