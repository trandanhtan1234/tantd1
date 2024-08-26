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
								<div class="product-img" style="background-image: url(images/item-6.jpg);"></div>
							</div>
						</div>
						<div class="col-md-7">
							<form action="{{ url('addCart') }}" method="get">
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
													@foreach
												</select>
											</div>
										</div>
										@endforeach
									</div>
									<div class="row row-pb-sm">
										<div class="col-md-4">
											<div class="input-group">
												<span class="input-group-btn">
													<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
														<i class="icon-minus2"></i>
													</button>
												</span>
												<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
												<span class="input-group-btn">
													<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
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
								{{ $product->description }}
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
						<div class="product-img" style="background-image: url(images/item-7.jpg);">
							<p class="tag"><span class="new">New</span></p>
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