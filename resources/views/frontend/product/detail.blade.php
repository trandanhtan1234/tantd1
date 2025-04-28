@extends('frontend.master.master')
@section('title', 'Detail Product')
@section('content')
<!-- main -->
<div class="colorlib-shop">
	<div class="container">
		<div class="row row-pb-lg">
			<div class="col-md-10 col-md-offset-1">
				<div class="product-detail-wrap">
					@if (session('success'))
						<div class="alert bg-success">
							<strong>{{ session('success') }}</strong>
						</div>
					@elseif (session('failed'))
						<div class="alert alert-danger">
							<strong>{{ session('failed') }}</strong>
						</div>
					@endif
					<div class="row">
						<div class="col-md-5">
							<div class="product-entry">
								@php
								$img = $product->img;
								if (!file_exists(public_path($img))) {
									$img = 'base/img/no-img.jpg';
								}
								@endphp
								<div class="product-img" style="background-image: url({{ url($img) }});"></div>
							</div>
						</div>
						<div class="col-md-7">
							<form action="{{ route('addCart') }}" method="get">
								<div class="desc">
									<h3>{{ $product->name }}</h3>
									<p class="price">
										<span>{{ number_format($product->price,0,',','.') }} VNĐ</span>
									</p>
									<p>Information</p>
									@foreach (valueAttr($product->values) as $values => $value)
									<div class="size-wrap">
										<p class="size-desc">
											{{ $values }}:
											@foreach ($value as $val)
												@if ($values != 'Color')
													<span class="size cursor-pointer" data-value="{{ $val['id'] }}">{{ $val['value'] }}</span>
												@else
													<span class="size cursor-pointer" data-value="{{ $val['id'] }}" style="background-color: {{ $val['value'] }}">{{ $val['value'] }}</span>
												@endif
											@endforeach
										</p>
									</div>
									@endforeach
									<input type="hidden" name="size" id="selected-size">
									<input type="hidden" name="color" id="selected-color">
									<h4>Options</h4>
									<div class="row row-pb-sm">
										<div class="col-md-4">
											<div class="input-group inStock hidden">
												<span class="input-group-btn">
													<button type="button" class="quantity-left-minus btn" onclick="minusOne()" data-type="minus" data-field="">
														<i class="icon-minus2"></i>
													</button>
												</span>
												<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
												<input type="hidden" id="max" value="">
												<span class="input-group-btn">
													<button type="button" class="quantity-right-plus btn" onclick="plusOne()" data-type="plus" data-field="">
														<i class="icon-plus2"></i>
													</button>
												</span>
											</div>
											<div class="outOfStock hidden">
												<span>Out Of Stock</span>
											</div>
										</div>
									</div>
									<input type="hidden" name="product_id" value="{{ $product->id }}">
									<p><button class="btn btn-primary btn-addtocart" type="submit" disabled>Add To Cart</button></p>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-md-12 tabulation">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#description">Description</a></li>
						</ul>
						<div class="tab-content">
							<div id="description" class="tab-pane fade in active">
								{!! $product->description !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="colorlib-shop">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
				<h2><span>New Products</span></h2>
			</div>
		</div>
		<div class="row">
			@foreach ($prd_new as $product)
				<div class="col-md-3 text-center">
					<div class="product-entry">
						@php
							$img = $product->img;
							if (!file_exists(public_path($img))) {
								$img = 'base/img/no-img.jpg';
							}
							$created_at = strtotime($product->created_at);
							$now = strtotime($now);
							$created_days = round(($now-$created_at)/(60*60*24));
						@endphp
						<div class="product-img" style="background-image: url({{ url($img) }});">
							@if($created_days<=7)<p class="tag"><span class="new">New</span></p>@endif
							<div class="cart">
								<p>
									<span><a href="{{ url('product/detail/'.$product->id) }}"><i class="icon-eye"></i></a></span>
								</p>
							</div>
						</div>
						<div class="desc">
							<h3><a href="{{ url('product/detail/'.$product->id) }}">{{ $product->name }}</a></h3>
							<p class="price"><span>{{ number_format($product->price,0,',','.') }} VNĐ</span></p>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
<!-- end main -->
@endsection
@section('detailProduct')
<script>
	function minusOne() {
		const curQuantity = parseInt($('#quantity').val());
		if (curQuantity > 1) {
			$('#quantity').val(curQuantity - 1);
		}
	}
	function plusOne() {
		const curQuantity = parseInt($('#quantity').val());
		const max = parseInt($('#max').val());
		if (curQuantity < max) {
			$('#quantity').val(curQuantity + 1);
		}
	}
	$('.size-wrap .size').on('click', function() {
		const clicked = $(this);
		const groupLabel = clicked.closest('.size-desc').contents().get(0).nodeValue.trim().replace(':', '');

		// Highlight the selected span
		clicked.siblings().removeClass('selected');
		clicked.addClass('selected');

		const sizeVal = $('#selected-size');
		const colorVal = $('#selected-color');
		const productId = $('input[name="product_id"]').val();

		// Update the hidden input
		if (groupLabel === 'Size') {
			$('#selected-size').val(clicked.attr('data-value'));
		} else if (groupLabel === 'Color') {
			$('#selected-color').val(clicked.attr('data-value'));
		}

		if (sizeVal.val() != '' && colorVal.val() != '') {
			$.ajax({
				url: '<?= route('getVariant') ?>',
				type: 'POST',
				data: {
					size: sizeVal.val(),
					color: colorVal.val(),
					product_id: productId,
					_token: '{{ csrf_token() }}'
				},
				success: function(response) {
					if (response.variant.quantity > 0) {
						$('.price span').html(response.variant.price.toLocaleString('vi-VN')+'  VNĐ');
						$('.btn-addtocart').removeAttr('disabled');
						$('.inStock').removeClass('hidden');
						$('.outOfStock').addClass('hidden');
					} else {
						$('.price span').html(response.variant.price.toLocaleString('vi-VN')+'  VNĐ');
						$('.btn-addtocart').attr('disabled', '');
						$('.inStock').addClass('hidden');
						$('.outOfStock').removeClass('hidden');
					}
					$('#max').val(response.variant.quantity);
				},
				error: function(xhr) {
					alert('Something went wrong');
				}
			});
		}
	});
</script>
@endsection