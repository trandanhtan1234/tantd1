@extends('backend.master.master')
@section('title', 'Category')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{ url('admin') }}"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Category</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Manage Category</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<form action="{{ route('category.add') }}" method="post">
							<div class="col-md-5">
								<div class="form-group">
									<label for="">Category Parents:</label>
									<select class="form-control" name="parent" id="parent">
										<option>----ROOT----</option>
										{{ getCategory($category, 0, '', 0) }}
									</select>
								</div>
								<div class="form-group">
									<label for="">Category Name <span class="color-red">*</span></label>
									<input type="text" class="form-control" name="name" id="" placeholder="New Category Name">

									<!-- <div class="alert bg-danger" role="alert">
										<svg class="glyph stroked cancel">
											<use xlink:href="#stroked-cancel"></use>
										</svg>Tên danh mục đã tồn tại!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
									</div> -->
								</div>
								<button type="submit" class="btn btn-primary">Add Category</button>
							</div>
						</form>
						<div class="col-md-7">
							<!-- <div class="alert bg-success" role="alert">
								<svg class="glyph stroked checkmark">
									<use xlink:href="#stroked-checkmark"></use>
								</svg> Đã thêm danh mục thành công! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
							</div> -->
							<h3 style="margin: 0;"><strong>Category Orders</strong></h3>
							<div class="vertical-menu">
								<div class="item-menu active">Category </div>
								{{ showCategory($category, 0, '') }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/.col-->


	</div>
	<!--/.row-->
</div>
<!--/.main-->
@endsection
@section('acitve')
<script>
	$('.category').addClass('active');
</script>
@endsection