@extends('frontend.master.master')
@section('title', 'Cart')
@section('content')
<!-- main -->
<div class="colorlib-shop">
	@if ($count > 0)
	<div class="container">
		<div class="row row-pb-md">
			<div class="col-md-10 col-md-offset-1">
				<div class="process-wrap">
					<div class="process text-center active">
						<p><span>01</span></p>
						<h3>Cart</h3>
					</div>
					<div class="process text-center">
						<p><span>02</span></p>
						<h3>Checkout</h3>
					</div>
					<div class="process text-center">
						<p><span>03</span></p>
						<h3>Complete</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row row-pb-md">
			<div class="col-md-10 col-md-offset-1">
				<div class="product-name">
					<div class="one-forth text-center">
						<span>Details</span>
					</div>
					<div class="one-eight text-center">
						<span>Price</span>
					</div>
					<div class="one-eight text-center">
						<span>Quantity</span>
					</div>
					<div class="one-eight text-center">
						<span>Total</span>
					</div>
					<div class="one-eight text-center">
						<span>Remove</span>
					</div>
				</div>
				@foreach ($cart as $prd)
					<div class="product-cart">
						<div class="one-forth">
							<div class="product-img">
								@php
								$img = $prd->options->img;
								if (!file_exists(public_path($img))) {
									$img = 'base/img/no-img.jpg';
								}
								@endphp
								<img class="img-thumbnail cart-img" src="{{ url($img) }}">
							</div>
							<div class="detail-buy">
								<h4>{{ $prd->name }}</h4>
								<div class="row">
									@foreach ($prd->options->attr as $val => $key)
									<div class="col-md-3"><strong>{{ $val }}: {{ $key }}</strong></div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="one-eight text-center">
							<div class="display-tc">
								<span class="price">₫ {{ number_format($prd->price,0,'','.') }}</span>
							</div>
						</div>
						<div class="one-eight text-center">
							<div class="display-tc">
								<input onchange="updateQty('{{ $prd->rowId }}',this.value)" type="number" id="quantity" name="quantity" class="form-control input-number text-center" value="{{ $prd->qty }}">
							</div>
						</div>
						<div class="one-eight text-center">
							<div class="display-tc">
								<span class="price">₫ {{ number_format($prd->price * $prd->qty,0,'','.') }}</span>
							</div>
						</div>
						<div class="one-eight text-center">
							<div class="display-tc">
								<a href="{{ route('removeProduct', $prd->id) }}" onclick="return delProduct(id)" id="{{ $prd->name }}" class="closed"></a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="total-wrap">
					<div class="row">
						<div class="col-md-8">
						</div>
						<div class="col-md-3 col-md-push-1 text-center flex">
							<div class="total">
								<div class="grand-total">
									<form action="{{ route('postOnepay') }}" method="post">
										@csrf
										<input type="hidden" name="onepay_method" value="{{ str_replace('.','',$total) }}">
										<p><span><strong>Total:</strong></span> <span>₫ {{ $total }}</span></p>
										<button type="submit" class="btn btn-primary">Onepay Method</button>
									</form>
								</div>
							</div>
							<div class="total">
								<div class="grand-total">
									<p><span><strong>Total:</strong></span> <span>₫ {{ $total }}</span></p>
									<a href="{{ url('checkout') }}" class="btn btn-primary">Checkout <i class="icon-arrow-right-circle"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="flex justify-center">
		<h1>You have no Products in Cart!</h1>
	</div>
	@endif
</div>
<!-- end main -->
@endsection
@section('cart')
<script>
	function delProduct(name) {
		return confirm('Remove '+name+' from Cart?');
	}

	function updateQty(rowId,qty) {
		$.get('/cart/update-cart/'+rowId+'/'+qty, function() {
			window.location.reload();
		});
	}
</script>
@endsection