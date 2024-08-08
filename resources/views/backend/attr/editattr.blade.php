@extends('backend.master.master')
@section('title', 'Edit Attribute')
@section('content')
<!-- main -->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Menu/Attributes/Edit Attribute</li>
		</ol>
	</div>
	<!--/.row-->
	<!--/.row-->
	<div class="row col-md-offset-3 ">
		<div class="col-md-6">	
		<div class="panel panel-blue">
			<div class="panel-heading dark-overlay">Edit Attribute</div>
			<div class="panel-body">
				<form action="" method="post">
					@csrf
					<div class="form-group">
						<label>Attribute Name <span class="color-red">*</span></label>
						<input type="text" name="attr_name" id="" value="{{ old('attr_name', $attr->name) }}" class="form-control" placeholder="Enter Attribute Name" aria-describedby="helpId">
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