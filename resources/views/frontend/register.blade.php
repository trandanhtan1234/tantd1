@extends('frontend.master.master')
@section('title', 'Register Customer')
@section('content')
<!-- main -->
<div id="colorlib-contact">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
                @if (session('failed'))
                    <div class="alert alert-danger">
                        <strong>{{ session('failed') }}</strong>
                    </div>
                @endif
				<div class="contact-wrap">
					<h3>Login</h3>
					<form action="{{ route('registerCustomer') }}" method="post">
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="full">Full <span class="color-red">*</span></label>
                                <input type="text" name="full" id="full" class="form-control" placeholder="Enter You Full Name" value="{{ old('full') }}">
                                @if ($errors->has('full'))
                                    <div class="alert alert-danger">
                                        <strong>{{ $errors->first('full') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

						<div class="row form-group">
							<div class="col-md-12">
								<label for="email">Email <span class="color-red">*</span></label>
								<input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
							</div>
						</div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="address">Address <span class="color-red">*</span></label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Enter Your Address" value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <div class="alert alert-danger">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="phone">Phone Number <span class="color-red">*</span></label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Your Phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <div class="alert alert-danger">
                                        <strong>{{ $errors->first('phone') }}</strong>
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
                        
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="confirm_password">Confirm Password <span class="color-red">*</span></label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter Confirm Password">
                                @if ($errors->has('confirm_password'))
                                    <div class="alert alert-danger">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary">Register</button>
						</div>
						<p>Already have an account? <a href="{{ url('register-customer') }}">Login</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end main -->
@endsection