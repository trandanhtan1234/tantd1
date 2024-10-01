<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
</head>
<body>
    <h2>Hi {{ $full }}</h2>
    <p>You have been registered as {{ $level == 1 ? 'Admin' : 'Staff' }} on our website</p>
    <p>Here's your information:</p>
    <ul>
        <li>Email: {{ $email }}</li>
        <li>Password: {{ $password }}</li>
        <li>Full: {{ $full }}</li>
        <li>Address: {{ $address }}</li>
    </ul>
</body>
</html>