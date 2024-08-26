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
		<div class="row">
			<div class="col-md-7">
				<form method="post" class="colorlib-form">
					<h2>Checkout Details</h2>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="fname">Full Name <span class="color-red">*</span></label>
								<input type="text" id="fname" class="form-control" placeholder="First Name">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="address">Address <span class="color-red">*</span></label>
								<input type="text" id="address" class="form-control" placeholder="Enter your address">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6">
								<label for="email">Email <span class="color-red">*</span></label>
								<input type="email" id="email" class="form-control" placeholder="Ex: youremail@domain.com">
							</div>
							<div class="col-md-6">
								<label for="Phone">Phone <span class="color-red">*</span></label>
								<input type="text" id="phone" class="form-control" placeholder="Ex: 0123456789">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">

							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-5">
				<div class="cart-detail">
					<h2>Cart Details</h2>
					<ul>
						<li>
							<ul>
								<li><span>1 x Tên sản phẩm</span> <span>₫ 990.000</span></li>
								<li><span>1 x Tên sản phẩm</span> <span>₫ 780.000</span></li>
							</ul>
						</li>
						<li><span>Total</span> <span>1.370.000 VNĐ</span></li>
					</ul>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p><a href="{{ url('checkout/complete') }}" class="btn btn-primary">Complete</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end main -->
@endsection