<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up New Account</title>
</head>
<body>
    <h2>Dear {{ $full }}</h2>
    <p>You have signed up to our website: Test Shop</p>
    <p>Here's your information:</p>
    <ul>
        <li>Full: {{ $full }}</li>
        <li>Email: {{ $email }}</li>
        <li>Password: {{ $password }}</li>
        <li>Address: {{ $address }}</li>
        <li>Phone: {{ $phone }}</li>
    </ul>
    <p>Wish you a good day!</p>
</body>
</html>