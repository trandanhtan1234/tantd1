@extends('backend.master.master')
@section('title', 'Orders')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{ url('admin') }}"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Orders</li>
		</ol>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">List of Pending Orders</div>
				<div class="panel-body">
					<div class="bootstrap-table">
						<div class="table-responsive">
							<a href="orderinfo.html" class="btn btn-success">Approved Orders</a>
							<table class="table table-bordered" style="margin-top:20px;">
								<thead>
									<tr class="bg-primary">
										<th>ID</th>
										<th>Customer Name</th>
										<th>Phone</th>
										<th>Address</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($orders as $order)
									<tr>
										<td>{{ $order->id }}</td>
										<td>{{ $order->customer->full }}</td>
										<td>{{ $order->customer->phone }}</td>
										<td>{{ $order->address }}</td>
										<td>
											<a href="{{ url('admin/detailorder/'.$order->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>Details</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
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