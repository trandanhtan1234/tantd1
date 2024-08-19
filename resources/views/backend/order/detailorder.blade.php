@extends('backend.master.master')
@section('title', 'Detail')
@section('content') 
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{ url('admin') }}"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Orders / Detail Order</li>
		</ol>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Detail Order</div>
				<div class="panel-body">
					<div class="bootstrap-table">
						<form action="{{ route('approveOrder') }}" method="post">
							<input type="hidden" name="order_id" value="{{ $order->id }}">
							<div class="table-responsive">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<div class="panel panel-blue">
												<div class="panel-heading dark-overlay">Customer Infomation</div>
												<div class="panel-body">
													<strong><span class="glyphicon glyphicon-user" aria-hidden="true"></span>: {{ $order->customer->full }}</strong> <br>
													<strong><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>: Phone: {{ $order->customer->phone }}</strong><br>
													<strong><span class="glyphicon glyphicon-send" aria-hidden="true"></span>: {{ $order->address }}</strong>
												</div>
											</div>
										</div>
									</div>
								</div>
								<table class="table table-bordered" style="margin-top:20px;">
									<thead>
										<tr class="bg-primary">
											<th>ID</th>
											<th>Product Info</th>
											<th>Quantity</th>
											<th>Price</th>
											<th>Amount</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>
												<div class="row">
													<div class="col-md-4">
														<img width="100px" src="img/ao-khoac.jpg" class="thumbnail">
													</div>
													<div class="col-md-8">
														<p>Product Code: Sp01</p>
														<p>Product Name: <strong>Áo Khoác Bomber Nỉ Xanh Lá Cây AK179</strong></p>
														<div class="group-color">Color:
															<div class="product-color" style="background-color: brown;"></div>
														</div>
														<p>Size:xl</p>
													</div>
												</div>
											</td>
											<td>2</td>
											<td>500.000 VNĐ</td>
											<td>1.000.000 VNĐ</td>
										</tr>
										<tr>
											<td>1</td>
											<td>
												<div class="row">
													<div class="col-md-4">
														<img width="100px" src="img/ao-khoac.jpg" class="thumbnail">
													</div>
													<div class="col-md-8">
														<p>Mã sản phẩm: SP02</p>
														<p>Tên Sản phẩm: <strong>Áo Khoác Bomber Nỉ Xanh Lá Cây AK177</strong></p>
														<div class="group-color">Color:
															<div class="product-color" style="background-color: blueviolet;"></div>
														</div>
														<p>Size:xl</p>
													</div>
												</div>
											</td>
											<td>1</td>
											<td>500.000 VNĐ</td>
											<td>500.000 VNĐ</td>

										</tr>
									</tbody>
								</table>
								<table class="table">
									<thead>
										<tr>
											<th width='70%'>
												<h4 align='right'>Total :</h4>
											</th>
											<th>
												<h4 align='right' style="color: brown;">{{ number_format($order->total,0,',','.') }} VNĐ</h4>
											</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<div>
									<select name="status">
										<option value="1">Approve</option>
										<option value="2">Cancel</option>
									</select>
								</div>
								<div class="alert alert-primary" role="alert" align='right'>
									<button class="btn btn-success" type="submit">Approved</button>
								</div>
							</div>
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->
</div>
<!--end main-->
@endsection
@section('active')
<script>
	$('.orders').addClass('active');
</script>
@endsection