@extends('frontend.master.master')
@section('title', 'Contact Us')
@section('content')
<!-- main -->
<div id="colorlib-contact">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h3>Contact Details</h3>
				<div class="row contact-info-wrap">
					<div class="col-md-3">
						<p><span><i class="icon-location"></i></span> B8A - 18 Vo Van Dung - Hoang Cau - Dong da - Ha Noi</p>
					</div>
					<div class="col-md-3">
						<p><span><i class="icon-phone3"></i></span> <a href="tel://123456789">+ 123 456 789</a></p>
					</div>
					<div class="col-md-3">
						<p><span><i class="icon-paperplane"></i></span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
					</div>
					<div class="col-md-3">
						<p><span><i class="icon-globe"></i></span> <a href="#">http://vietpro.edu.vn</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-10 col-md-offset-1">
				<div class="contact-wrap">
					<h3>Contact</h3>
					<form action="#">
						<div class="row form-group">
							<div class="col-md-12 padding-bottom">
								<label for="fname">Full Name</label>
								<input type="text" id="fname" class="form-control" placeholder="Your firstname">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label for="email">Email</label>
								<input type="text" id="email" class="form-control" placeholder="Your email address">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label for="subject">Subject</label>
								<input type="text" id="subject" class="form-control" placeholder="Enter Subject">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label for="message">Message</label>
								<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Tell us something"></textarea>
							</div>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary">Send</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="map" class="colorlib-map"></div>
<!-- end main -->
@endsection