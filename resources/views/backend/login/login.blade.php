<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
    <link rel="shortcut icon" type="x-icon" href="running.png">
	<base href="{{ asset('').'backend/' }}">
    <!-- css -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<form action="{{ route('login') }}" method="post" role="form">
						@csrf
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="text" value="{{ old('email') }}" autofocus="">
								@if ($errors->has('email'))
									<div class="alert alert-danger">
										<strong>{{ $errors->first('email') }}</strong>
									</div>
								@endif
							</div>
							<div class="form-group position-relative">
								<input class="form-control hide-password" placeholder="Password" name="password" type="password" value="{{ old('password') }}">
								<span class="far fa-eye eye-login see-password position-absolute close"></span>
							</div>
							<button type="submit" class="btn btn-primary">Login</button>
						</fieldset>
					</form>
				</div>
				@if (session('failed'))
					<div class="alert alert-danger">
						<strong>{{ session('failed') }}</strong>
					</div>
				@endif
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->



	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		// ! function ($) {
		// 	$(document).on("click", "ul.nav li.parent > a > span.icon", function () {
		// 		$(this).find('em:first').toggleClass("glyphicon-minus");
		// 	});
		// 	$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		// }(window.jQuery);

		// $(window).on('resize', function () {
		// 	if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		// })
		// $(window).on('resize', function () {
		// 	if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		// })
		$('.see-password').on('click', function() {
			if ($(this).hasClass('close')) {
				$(this).removeClass('close');
				$(this).parents('.form-group').find('.hide-password').prop('type', 'text');
			} else {
				$(this).addClass('close');
				$(this).parents('.form-group').find('.hide-password').prop('type', 'password')
			}
		});
		let timeout = 5 * 60 * 1000; // 5 minutes
		setTimeout(() => {
			window.location.href = "{{ route('login') }}";
		}, timeout);
	</script>
</body>

</html>