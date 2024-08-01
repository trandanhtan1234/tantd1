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
							<!-- <div class="alert bg-success" role="alert">
								<svg class="glyph stroked checkmark">
									<use xlink:href="#stroked-checkmark"></use>
								</svg>Add Product Successfully<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
							</div> -->
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
									<tr>
										<td>1</td>
										<td>
											<div class="row">
												<div class="col-md-3"><img src="img/ao-khoac.jpg" alt="Áo đẹp" width="100px" class="thumbnail"></div>
												<div class="col-md-9">
													<p><strong>Product Code : SP01</strong></p>
													<p>Product Name :Default Shirt</p>
													<p>Size:xl,xxl,</p>
													<div class="group-color">Color:
														<div class="product-color" style="background-color: blueviolet;"></div>
														<div class="product-color" style="background-color: brown;"></div>
														<div class="product-color" style="background-color: darkorange;"></div>
													</div>
												</div>
											</div>
										</td>
										<td>500.000 VND</td>
										<td>
											<a name="" id="" class="btn btn-success" href="#" role="button">In Stock</a>
										</td>
										<td>Female Jacket</td>
										<td>
											<a href="{{ url('admin/product/edit') }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
											<a href="{{ url('admin/product/delete') }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
										</td>
									</tr>
								</tbody>
							</table>
							<div align='right'>
								<ul class="pagination">
									<li class="page-item"><a class="page-link" href="#">Trở lại</a></li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item"><a class="page-link" href="#">tiếp theo</a></li>
								</ul>
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
</script>
@endsection