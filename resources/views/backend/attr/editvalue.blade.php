@extends('backend.master.master')
@section('title', 'Edit Value')
@section('content')
<!-- main -->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Menu/Attribute/Edit Attribute's Name</li>
		</ol>
	</div>
	<!--/.row-->
	<!--/.row-->
	<div class="row col-md-offset-3 ">
		<div class="col-md-6">	
		<div class="panel panel-blue">
			<div class="panel-heading dark-overlay">Edit Attribute's Value</div>
			<div class="panel-body">
				<form action="{{ route('') }}" method="post">
					<div class="form-group">
						<label>Value Name <span class="color-red">*</span></label>
						<input type="text" name="value_name" class="form-control" value="{{ old('value_name') }}" placeholder="Enter Value Name" aria-describedby="helpId">
						@if ($error->has('value_name'))
							<div class="alert alert-danger">
								<strong>{{ $errors->first('value_name') }}</strong>
							</div>
						@endif
					</div>
					<div align="right"><button class="btn btn-success" type="submit">Edit</button></div>
				</form>
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
	$('.products').addClass('active');
</script>
@endsection