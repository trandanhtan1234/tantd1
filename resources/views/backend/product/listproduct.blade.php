@extends('backend.master.master')
@section('title', 'List')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('admin') }}"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a>
			</li>
			<li class="active">List Products</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">List Products</h1>
		</div>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">

			<div class="panel panel-primary">

				<div class="panel-body">
					<div class="bootstrap-table">
						<div class="table-responsive">
							@if (session('success'))
							<div class="alert alert-success">
								<strong>{{ session('success') }}</strong>
							</div>
							@endif
							@if (session('failed'))
							<div class="alert alert-success">
								<strong>{{ session('success') }}</strong>
							</div>
							@endif
							<a href="{{ url('admin/product/add') }}" class="btn btn-primary">Add New Produt</a>
							<table class="table table-bordered" style="margin-top:20px;">
								<thead>
									<tr class="bg-primary">
										<th>ID</th>
										<th>Product Information</th>
										<th>Price</th>
										<th>Status</th>
										<th>Category</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($products as $row)
									<tr>
										<td>{{ $row->id }}</td>
										<td> 
											<div class="row">
												@php
													$img = $row->img;
													$no_img = '../../base/img/no-img.jpg';
												@endphp
												<div class="col-md-3"><img src="{{ file_exists(public_path('/'.$img))?'../../'.$img:$no_img }}" alt="{{ $row->name }}" width="100px" class="thumbnail"></div>
												<div class="col-md-9">
													<p><strong>Product Code : {{ $row->code }}</strong></p>
													<p>Product Name :{{ $row->name }}</p>
													@foreach (attr_values($row->values) as $key=>$value)
														<div class="@if($key == 'Color') group-color @endif">{{ $key }}:
															@foreach ($value as $name)
																<span class="@if($key == 'Color') product-color @else product-value @endif" @if($key == 'Color') style="background-color: <?= $name ?>" @endif>{{ $key!='Color'?$name:'' }}</span>
															@endforeach
														</div>
													@endforeach
												</div>
											</div>
										</td>
										<td>{{ number_format($row->price,0,'.','.') }} VND</td>
										<td>
											<p class="btn btn-{{ $row->status==1?'success':'danger' }}">{{ productStatus($row->status) }}</p>
										</td>
										<td>{{ $row->category->name }}</td>
										<td>
											<a href="{{ url('admin/product/edit/'.$row->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
											<a onclick="return del_prd(name)" name="{{ $row->name }}" href="{{ url('admin/product/delete/'.$row->id) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<div align='right'>
								{{ $products->links() }}
							</div>
						</div>
						<div class="clearfix"></div>
					</div>

				</div>
			</div>
			<!--/.row-->
		</div>
	</div>
</div>
<!--end main-->
@endsection 
@section('active')
<script>
	$('.products').addClass('active');

	function del_prd(name) {
		return confirm('Delete Product: '+name+'?');
	}
</script>
@endsection