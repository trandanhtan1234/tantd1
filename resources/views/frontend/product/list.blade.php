@extends('frontend.master.master')
@section('title', 'Products')
@section('content')
<!-- main -->
<div class="colorlib-shop">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="row row-pb-lg">
					@foreach ($list as $row)
						<div class="col-md-4 text-center">
							<div class="product-entry">
								@php
									$img = $row->img;
									if (!file_exists(public_path($img))) {
										$img = 'base/img/no-img.jpg';
									}
									$created_at = strtotime($row->created_at);
									$now = strtotime($now);
									$created_days = round(($now-$created_at)/(60*60*24));
								@endphp
								<div class="product-img" style="background-image: url({{ url($img) }});">
									@if($created_days<=7)<p class="tag"><span class="new">New</span></p>@endif
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
				<div class="row">
					{{ $list->links() }}
				</div>
			</div>
			<div class="col-md-3 col-md-pull-9">
				<div class="sidebar">
					<div class="side">
						<h2>Category</h2>
						<div class="fancy-collapse-panel">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								@foreach ($category as $row)
									@if ($row->parent == 0)
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingOne">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#menu{{ $row->id }}" aria-expanded="true" aria-controls="collapseOne">{{ $row->name }}
													</a>
												</h4>
											</div>
											<div id="menu{{ $row->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
												<div class="panel-body">
													<ul>
														@foreach ($category as $row1)
															@if ($row1->parent == $row->id)
																<li><a href="#">{{ $row1->name }}</a></li>
															@endif
														@endforeach
														<!-- <li><a href="#">Áo thun nam</a></li>
														<li><a href="#">Áo Khoác nam</a></li>
														<li><a href="#">Áo vest Nam</a></li> -->
													</ul>
												</div>
											</div>
										</div>
									@endif
								@endforeach
								<!-- <div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#menu2" aria-expanded="true" aria-controls="collapseOne">Female Fashion
											</a>
										</h4>
									</div>
									<div id="menu2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body">
											<ul>
												<li><a href="#">Female t-shirt</a></li>
												<li><a href="#">Áo thun Nữ</a></li>
												<li><a href="#">Female Jacket</a></li>
											</ul>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
					<div class="side">
						<h2>Price</h2>
						<form method="post" class="colorlib-form-2">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="guests">From:</label>
										<div class="form-field">
											<i class="icon icon-arrow-down3"></i>
											<select name="start" id="people" class="form-control">
												<option value="#">100.000 VNĐ</option>
												<option value="#">200.000 VNĐ</option>
												<option value="#">300.000 VNĐ</option>
												<option value="#">500.000 VNĐ</option>
												<option value="#">1.000.000 VNĐ</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="guests">To:</label>
										<div class="form-field">
											<i class="icon icon-arrow-down3"></i>
											<select name="end" id="people" class="form-control">
												<option value="#">2.000.000 VNĐ</option>
												<option value="#">4.000.000 VNĐ</option>
												<option value="#">6.000.000 VNĐ</option>
												<option value="#">8.000.000 VNĐ</option>
												<option value="#">10.000.000 VNĐ</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" style="width: 100%;border: none;height: 40px;">Search</button>
						</form>
					</div>
					@foreach ($attributes as $attr)
					<div class="side">
						<h2>{{ $attr->name }}</h2>
						<div class="size-wrap">
							<p class="size-desc">
								@foreach ($attr->values as $val)
								<a href="#" class="attr">{{ $val->value }}</a>
								@endforeach
								<!-- <a href="#" class="attr">Blue</a>
								<a href="#" class="attr">Black</a>
								<a href="#" class="attr">White</a> -->
							</p>
						</div>
					</div>
					@endforeach
					<!-- <div class="side">
						<h2>Size</h2>
						<div class="size-wrap">
							<p class="size-desc">
								<a href="#" class="attr">XS</a>
								<a href="#" class="attr">S</a>
								<a href="#" class="attr">M</a>
								<a href="#" class="attr">L</a>
								<a href="#" class="attr">XL</a>
								<a href="#" class="attr">XXL</a>
							</p>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end main -->
@endsection