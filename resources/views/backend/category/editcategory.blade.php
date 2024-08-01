@extends('backend.master.master')
@section('title', 'Edit Category')
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
						<form action="{{ route('category.edit', ['id' => $category->id]) }}" method="post">
							@csrf
							<div class="col-md-5">
								<div class="form-group">
									<label for="">Category Parents:</label>
									<select class="form-control" name="parent" id="">
										<option value="0">----ROOT----</option>
										{{ getCategory($list, 0, '', $category->id, $category->parent) }}
									</select>
								</div>
								<div class="form-group">
									<label for="">CategoryName</label>
									<input type="text" class="form-control" name="name" id="" placeholder="Tên danh mục mới" value="{{ old('name', $category->name) }}">
									@if ($errors->has('name'))
										<div class="alert bg-danger" role="alert">
											<svg class="glyph stroked cancel">
												<use xlink:href="#stroked-cancel"></use>
											</svg>{{ $errors->first('name') }}<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
										</div>
									@endif
								</div>
								<button type="submit" class="btn btn-primary">Edit Category</button>
							</div>
						</form>
						<div class="col-md-7">
							@if (session('success'))
								<div class="alert alert-success" role="alert">
									<strong>{{ session('success') }}</strong>
								</div>
							@elseif (session('failed'))
								<div class="alert alert-danger">
									<strong>{{ session('failed') }}</strong>
								</div>
							@endif
							<h3 style="margin: 0;"><strong>Category Orders</strong></h3>
							<div class="vertical-menu">
								<div class="item-menu active">Category </div>
								{{ showCategory($list, 0, '') }}
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
@section('active')
<script>
	$('.category').addClass('active');
</script>
@endsection