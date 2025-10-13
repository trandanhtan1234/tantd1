<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" type="x-icon" href="running.png">
    <base href="{{ asset('').'backend/' }}">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
    {{-- This is where you render the Livewire component --}}
    <livewire:login />

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $('.see-password').on('click', function() {
            if ($(this).hasClass('close')) {
                $(this).removeClass('close');
                $(this).parents('.form-group').find('.hide-password').prop('type', 'text');
            } else {
                $(this).addClass('close');
                $(this).parents('.form-group').find('.hide-password').prop('type', 'password')
            }
        });
    </script>
    {{-- The Livewire scripts must be included at the end of the body tag --}}
    @livewireScripts
</body>

</html>
