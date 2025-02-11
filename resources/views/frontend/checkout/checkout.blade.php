@extends('frontend.master.master')
@section('title', 'Checkout Page')
@section('content')
<!-- main -->
<div class="colorlib-shop">
	<div class="container">
		<div class="row row-pb-md">
			<div class="col-md-10 col-md-offset-1">
				<div class="process-wrap">
					<div class="process text-center active">
						<p><span>01</span></p>
						<h3>Cart</h3>
					</div>
					<div class="process text-center active">
						<p><span>02</span></p>
						<h3>Checkout</h3>
					</div>
					<div class="process text-center">
						<p><span>03</span></p>
						<h3>Checkout Completed</h3>
					</div>
				</div>
			</div>
		</div>
		<form action="{{ route('postCheckout') }}" method="post">
			@csrf
			<div class="row">
				<div class="col-md-7">
					<h2>Checkout Details</h2>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="fname">Full Name <span class="color-red">*</span></label>
								<input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" value="{{ old('fname') }}">
								@if ($errors->has('fname'))
									<div class="alert alert-danger">
										<strong>{{ $errors->first('fname') }}</strong>
									</div>
								@endif
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="address">Address <span class="color-red">*</span></label>
								<input type="text" name="address" id="address" class="form-control" placeholder="Enter your address" value="{{ old('address') }}">
								@if ($errors->has('address'))
									<div class="alert alert-danger">
										<strong>{{ $errors->first('address') }}</strong>
									</div>
								@endif
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="payment_method">Payment Method</label>
								<select name="payment_method" class="form-control" id="payment_method">
									<option value="0">Cash</option>
									<option value="1">Momo</option>
									<option value="2">VNPAY</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6">
								<label for="email">Email <span class="color-red">*</span></label>
								<input type="email" name="email" id="email" class="form-control" placeholder="Ex: youremail@domain.com" value="{{ old('email') }}">
								@if ($errors->has('email'))
									<div class="alert alert-danger">
										<strong>{{ $errors->first('email') }}</strong>
									</div>
								@endif
							</div>
							<div class="col-md-6">
								<label for="Phone">Phone <span class="color-red">*</span></label>
								<input type="text" name="phone" id="phone" class="form-control" placeholder="Ex: 0123456789" value="{{ old('phone') }}">
								@if ($errors->has('phone'))
									<div class="alert alert-danger">
										<strong>{{ $errors->first('phone') }}</strong>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="cart-detail">
						<h2>Cart Details</h2>
						<ul>
							<li>
								<ul>
									@foreach ($cart as $prd)
										<li><span>{{ $prd->qty }} x {{ $prd->name }}</span> <span>₫ {{ number_format($prd->price * $prd->qty,0,'','.') }}</span></li>
									@endforeach
								</ul>
							</li>
							<li><span>Total</span> <span>{{ $total }} VNĐ</span></li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" name="total_momo" value="{{ str_replace('.','',$total) }}">
							<p><button type="submit" class="btn btn-primary">Complete</button></p>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- end main -->
@endsection