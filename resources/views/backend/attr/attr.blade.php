@extends('backend.master.master')
@section('title', 'Attributes')
@section('content')
<!-- main -->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Menu</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Manage Attributes</h1>
			@if (session('success'))
				<div class="alert alert-success">
					<strong>{{ session('success') }}</strong>
				</div>
			@endif
			@if (session('failed'))
				<div class="alert alert-danger">
					<strong>{{ session('failed') }}</strong>
				</div>
			@endif
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					@foreach ($attributes as $attr)
					<div class="row margin-attr">
						<div class="col-md-2 panel-blue widget-left">
							<strong class="large">{{ $attr->name }}</strong>
							<a class="delete-attr" href="{{ url('') }}"><i class="fas fa-times"></i></a>
							<a onclick="return delAttr('{{ $attr->name }}')" class="edit-attr" href="{{ url('admin/product/delete-attr/'.$attr->id) }}"><i class="fas fa-edit"></i></a>
						</div>
						<div class="col-md-10 widget-right boxattr">
							@foreach ($attr->values as $value)
							<div class="text-attr">{{ $value->value }} 
								<a href="#" class="edit-value"><i class="fas fa-edit"></i></a>
								<a onclick="return delValue('{{ $value->value }}')" href="{{ url('admin/product/delete-value/'.$value->id) }}" class="del-value"><i class="fas fa-times"></i></a>
							</div>
							@endforeach
							<div class="text-attr"><a href="#" class="add-value"><i class="fas fa-plus-circle"></i></i></a></div>
						</div>		
					</div>
					@endforeach
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

	function delAttr(name) {
		return confirm('Delete Attribute: '+name+'?');
	}
	function delValue(name) {
		return confirm('Delete Value: '+name+'?');
	}
</script>
@endsection