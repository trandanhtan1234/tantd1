@extends('backend.master.master')
@section('title', 'List Customers')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{ url('admin') }}"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Manage Customers</li>
		</ol>
	</div>
	
	<!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">List Customers</h1>
		</div>
	</div>
	<!--/.row-->

	<!--/.row-->
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="bootstrap-table">
						<div class="table-responsive">
							@if (session('success'))
							<div class="alert bg-success" role="alert">
								<svg class="glyph stroked checkmark">
									<use xlink:href="#stroked-checkmark"></use>
								</svg>{{ session('success') }}<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
							</div>
							@elseif (session('failed'))
							<div class="alert bg-danger" role="alert">
								<svg class="glyph stroked checkmark">
									<use xlink:href="#stroked-checkmark"></use>
								</svg>{{ session('failed') }}<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
							</div>
							@endif
							<div class="display-flex justify-between">
								<a href="{{ url('/admin/customer/add') }}" class="btn btn-primary">Add Customer</a>
								<a href="#" class="excel-btn btn" target="_blank">Export</a>
							</div>
							<table class="table table-bordered" style="margin-top:20px;">
								<thead>
									<tr class="bg-primary">
										<th>ID</th>
										<th>Email</th>
										<th>Full</th>
										<th>Address</th>
										<th>Phone</th>
										<th width='18%'>Options</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($customers as $customer)
									<tr>
										<td>{{ $customer->id }}</td>
										<td>{{ $customer->email }}</td>
										<td>{{ $customer->full }}</td>
										<td>{{ $customer->address }}</td>
										<td>{{ $customer->phone }}</td>
										<td>
											<a href="{{ url('/admin/customer/edit/'. $customer->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
											<a onclick="return delCustomer('<?= $customer->full ?>')" href="{{ url('admin/customer/delete/'. $customer->id') }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<div align='right'>
								{{ $customers->onEachSide(3)->links() }}
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->
</div>
<!--end main-->
@endsection
<!-- @section('user')
<script src="js/user.js"></script>
@endsection -->
@section('active')
<script>
	$('.manage_customers').addClass('active');

	function delCustomer(name) {
		return confirm('Delete Customer: '+name+'?');
	}
</script>
@endsection