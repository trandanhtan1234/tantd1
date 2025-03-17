@extends('frontend.master.master')
@section('title', 'Login Customer')
@section('content')
<!-- main -->
<div id="colorlib-contact">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				@if (session('success'))
					<div class="alert bg-success">
						<strong>{{ session('success') }}</strong>
					</div>
				@endif
				<div class="contact-wrap">
					<h3>Login</h3>
					<form action="{{ route('loginCustomer') }}" method="post">
                        @csrf
						<input type="hidden" name="previous_page" value="{{ url()->previous() }}">
						@if (session('failed'))
							<div class="alert alert-danger">
								<strong>{{ session('failed') }}</strong>
							</div>
						@endif
						<div class="row form-group">
							<div class="col-md-12">
								<label for="email">Email <span class="color-red">*</span></label>
								<input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label for="password">Password <span class="color-red">*</span></label>
								<input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                                @if ($errors->has('password'))
                                    <div class="alert alert-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
							</div>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</form>
					<div><a class="btn btn-primary" href="{{ url('register-customer') }}">Register</a></div>
					<div><a class="btn btn-primary" href="{{ route('google.login') }}">Login With Google</a></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end main -->
@endsection