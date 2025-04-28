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
						<form action="{{ route('approveOrder', ['id' => $order->id]) }}" method="post">
							@csrf
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
													<strong><span class="glyphicon glyphicon-send" aria-hidden="true"></span>: {{ $order->address }}</strong><br>
													<strong>
														@if ($order->status == 0)
															Pending
														@elseif ($order->status == 1)
															Complete
														@else
															Canceled
														@endif
													</strong>
												</div>
											</div>
										</div>
									</div>
								</div>
								<table class="table table-bordered" style="margin-top:20px;">
									<thead>
										<tr class="bg-primary">
											<th></th>
											<th>Product Info</th>
											<th>Quantity</th>
											<th>Price</th>
											<th>Amount</th>
										</tr>
									</thead>
									<tbody>
										@php
										$i=0;
										@endphp
										@foreach ($details as $value)
										@php
										$i++;
										@endphp
										<tr>
											<td>{{ $i }}</td>
											<td>
												<div class="row">
													<div class="col-md-4">
														@php
														$img = $value->img;
														if (!file_exists(public_path('/'.$img))) {
															$img = 'base/img/no-img.jpg';
														}
														@endphp
														<img width="100px" src="{{ url($img) }}" class="thumbnail">
													</div>
													<div class="col-md-8">
														<p>Product Code: {{ $value->code }}</p>
														<p>Product Name: <strong>{{ $value->name }}</strong></p>
														<div class="group-color">Color:
															<div class="product-color" style="background-color: brown;"></div>
														</div>
														<p>Size:xl</p>
													</div>
												</div>
											</td>
											<td>{{ $value->quantity }}</td>
											<td>{{ number_format($value->price,0,'.','.') }} VNĐ</td>
											<td>{{ number_format($value->price*$value->quantity,0,'.','.') }} VNĐ</td>
										</tr>
										@endforeach
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
								@if ($order->status == 0)
								<div>
									<select name="status">
										<option value="1">Approve</option>
										<option value="2">Cancel</option>
									</select>
								</div>
								<div class="alert alert-primary" role="alert" align='right'>
									<button class="btn btn-success" type="submit">Submit Order</button>
								</div>
								@endif
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