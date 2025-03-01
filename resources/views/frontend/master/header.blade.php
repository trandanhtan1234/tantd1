<div class="colorlib-loader"></div>
	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-xs-2">
							<div id="colorlib-logo"><a href="{{ url('') }}">Fashion</a></div>
						</div>
						<div class="col-xs-10 text-right menu-1">
							<ul>
								<li class="active"><a href="{{ url('') }}">Index</a></li>
								<li class="has-dropdown">
									<a href="{{ url('product') }}">Products</a>
									<ul class="dropdown">
										<li><a href="{{ url('cart') }}">Cart</a></li>
										<li><a href="{{ url('checkout') }}">Checkout</a></li>

									</ul>
								</li>
								<li><a href="{{ url('about-us') }}">About Us</a></li>
								<li><a href="{{ url('contact') }}">Contact</a></li>
								<li><a href="{{ url('cart') }}"><i class="icon-shopping-cart"></i> Checkout [{{ Cart::count() }}]</a></li>
								@if (Auth::guard('customer')->user())
								<li><span>{{ Auth::guard('customer')->user()->email }}</span> <a href="{{ url('/logout-customer') }}">Logout</a></li>
								@else
								<li><a href="{{ url('login-customer') }}">Login</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
					<li style="background-image: url(images/img_bg_1.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-md-pull-2 col-sm-12 col-xs-12 slider-text">
									<div class="slider-text-inner">
										<div class="desc">
											<h1 class="head-1">Sale</h1>
											<h2 class="head-3">45%</h2>
											<p class="category"><span>Professional Designs</span></p>
											<p><a href="#" class="btn btn-primary">Connect with us</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li style="background-image: url(images/img_bg_2.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-md-pull-2 col-sm-12 col-xs-12 slider-text">
									<div class="slider-text-inner">
										<div class="desc">
											<h1 class="head-1">Sale</h1>
											<h2 class="head-3">45%</h2>
											<p class="category"><span>Professional Designs</span></p>
											<p><a href="#" class="btn btn-primary">Connect with us</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li style="background-image: url(images/img_bg_3.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-md-push-3 col-sm-12 col-xs-12 slider-text">
									<div class="slider-text-inner">
										<div class="desc">
											<h1 class="head-1">Sale</h1>
											<h2 class="head-3">45%</h2>
											<p class="category"><span>Professional Designs</span></p>
											<p><a href="#" class="btn btn-primary">Connect with us</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>
	</div>
</div>