@extends('frontend.master.master')
@section('title', 'Detail Product')
@section('content')
<!-- main -->
<div class="colorlib-shop">
	<div class="container">
		<div class="row row-pb-lg">
			<div class="col-md-10 col-md-offset-1">
				<div class="product-detail-wrap">
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
											@foreach ($value as $name)
												@if ($values != 'Color')
													<span class="size">{{ $name }}</span>
												@else
													<span class="size" style="background-color: {{ $name }}">{{ $name }}</span>
												@endif
											@endforeach
										</p>
									</div>
									@endforeach
									<h4>Options</h4>
									<div class="row">
										@foreach (valueAttr($product->values) as $values => $value)
										<div class="col-md-3">
											<div class="form-group">
												<label>{{ $values }}:</label>
												<select class="form-control " name="attr[{{ $values }}]" id="">
													@foreach ($value as $name)
														<option value="{{ $name }}"> {{ $name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										@endforeach
									</div>
									<div class="row row-pb-sm">
										<div class="col-md-4">
											<div class="input-group">
												<span class="input-group-btn">
													<button type="button" class="quantity-left-minus btn" onclick="minusOne()" data-type="minus" data-field="">
														<i class="icon-minus2"></i>
													</button>
												</span>
												<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
												<input type="hidden" id="max" value="{{ $product->quantity }}">
												<span class="input-group-btn">
													<button type="button" class="quantity-right-plus btn" onclick="plusOne()" data-type="plus" data-field="">
														<i class="icon-plus2"></i>
													</button>
												</span>
											</div>
										</div>
									</div>
									<input type="hidden" name="product_id" value="{{ $product->id }}">
									<p><button class="btn btn-primary btn-addtocart" type="submit">Add To Cart</button></p>
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
</script>
@endsection