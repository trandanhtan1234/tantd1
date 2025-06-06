@extends('frontend.master.master')
@section('title', 'Index')
@section('content')
<!-- main -->
<div id="colorlib-featured-product">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<a href="shop.html" class="f-product-1" style="background-image: url(images/item-1.jpg);">
					<div class="desc">
						<h2>Products <br>for <br>Male</h2>
					</div>
				</a>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<a href="" class="f-product-2" style="background-image: url(images/item-2.jpg);">
							<div class="desc">
								<h2> <br>New <br> Dress</h2>
							</div>
						</a>
					</div>
					<div class="col-md-6">
						<a href="" class="f-product-2" style="background-image: url(images/item-4.jpg);">
							<div class="desc">
								<h2>Sale <br>20% <br>off</h2>
							</div>
						</a>
					</div>
					<div class="col-md-12">
						<a href="" class="f-product-2" style="background-image: url(images/item-3.jpg);">
							<div class="desc">
								<h2>Shoes <br>for <br>Male</h2>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="colorlib-intro" class="colorlib-intro" style="background-image: url(images/cover-img-1.jpg);"
	data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="intro-desc">
					<div class="text-salebox">
						<div class="text-lefts">
							<div class="sale-box">
								<div class="sale-box-top">
									<h2 class="number">45</h2>
									<span class="sup-1">%</span>
									<span class="sup-2">Off</span>
								</div>
								<h2 class="text-sale">Sale</h2>
							</div>
						</div>
						<div class="text-rights">
							<h3 class="title">Order now to get voucher!</h3>
							<p>There have been 1000 orders around the world.</p>
							<p><a href="shop.html" class="btn btn-primary">Buy now</a> <a href="#" class="btn btn-primary btn-outline">Read more</a></p>
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
				<h2><span>Featured Products</span></h2>
				<p>Favourite Products in 2024</p>
			</div>
		</div>
		<div class="row owl-carousel">
			@foreach ($featured as $product)
				<div class="slider-row text-center">
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
									<!-- <span class="addtocart"><a href="cart.html"><i class="icon-shopping-cart"></i></a></span> -->
									<span><a href="{{ url('product/detail/'.$product->id) }}"><i class="icon-eye"></i></a></span>
								</p>
							</div>
						</div>
						<div class="desc">
							<h3><a href={{ url('product/detail/'.$product->id) }}">{{ $product->name }}</a></h3>
							<p class="price"><span>{{ number_format($product->price,0,',','.') }} VNĐ</span> </p>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
<div class="colorlib-shop">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
				<h2><span>New Products</span></h2>
				<p>Newest Products in 2024</p>
			</div>
		</div>
		<div class="row">
			@foreach ($list as $row)
			<div class="col-md-3 text-center">
				<div class="product-entry">
					@php
						$img = $row->img;
						if (!file_exists(public_path($img))) {
							$img = 'base/img/no-img.jpg';
						}
					@endphp
					<div class="product-img" style="background-image: url({{ url($img) }});">
					<p class="tag"><span class="new">New</span></p>
						<div class="cart">
							<p>
								<span><a href="{{ url('product/detail/'.$row->id) }}"><i class="icon-eye"></i></a></span>
							</p>
						</div>
					</div>
					<div class="desc">
						<h3><a href="{{ url('product/detail/'.$row->id) }}">{{ $row->name }}</a></h3>
						<p class="price"><span>{{ number_format($row->price,0,',','.') }} VNĐ</span></p>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
<!-- end main -->
@endsection