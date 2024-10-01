@extends('backend.master.master')
@section('title', 'Attributes')
@section('content')
<!-- main -->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main position-relative">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{ url('admin') }}"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Attributes</li>
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
			@if ($errors->has('value_name'))
				<div class="alert alert-danger">
					<strong>{{ $errors->first('value_name') }}</strong>
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
							<a onclick="return delAttr('{{ $attr->name }}')" class="delete-attr" href="{{ url('/admin/product/delete-attr/'.$attr->id) }}"><i class="fas fa-times"></i></a>
							<a class="edit-attr" href="{{ url('admin/product/edit-attr/'.$attr->id) }}"><i class="fas fa-edit"></i></a>
						</div>
						<div class="col-md-10 widget-right boxattr">
							@foreach ($attr->values as $value)
							<div class="text-attr">{{ $value->value }} 
								<a href="{{ url('admin/product/edit-value/'.$value->id) }}" class="edit-value"><i class="fas fa-edit"></i></a>
								<a onclick="return delValue('{{ $value->value }}')" href="{{ url('admin/product/delete-value/'.$value->id) }}" class="del-value"><i class="fas fa-times"></i></a>
							</div>
							@endforeach
							<div class="text-attr add-attr">
								<i class="fas fa-plus-circle">
									<input type="hidden" id="attr_id" value="{{ $attr->id }}">
								</i>
							</div>
						</div>		
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<!--/.col-->
	</div>
	<!--/.row-->
	<!-- Popup add value -->
	<div class="popup popup-add-value position-absolute hidden">
		<div class="panel panel-blue">
			<div class="panel-heading dark-overlay">Add Attribute's Value</div>
			<div class="panel-body">
				<form action="{{ route('addVal') }}" method="post">
					@csrf
					<div class="form-group">
						<label>Value Name <span class="color-red">*</span></label>
						<input type="hidden" class="attr_id" name="attr_id">
						<input type="text" name="value_name" class="form-control" value="{{ old('value_name') }}" placeholder="Enter Value Name" aria-describedby="helpId">
					</div>
					<div class="display-flex justify-between">
						<button class="btn btn-success" type="submit">Edit</button>
						<div class="btn btn-danger close-popup">Cancel</div>
					</div>
				</form>
			</div>
		</div>
	</div>
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

	const popups = [...document.getElementsByClassName('popup')];

	window.addEventListener('click', ({ target }) => {
		const popup = target.closest('.popup');
		const clickedOnClosedPopup = popup && !popup.classList.contains('show');
		
		popups.forEach(p => p.classList.remove('show'));
		
		if (clickedOnClosedPopup) popup.classList.add('show');  
	});

	$('.add-attr').on('click', function() {
		const attr_id = $(this).find('#attr_id').val();

		$('.popup-add-value .attr_id').val(attr_id);
		$('.popup-add-value').removeClass('hidden');
	});

	$('.close-popup').on('click', function() {
		$('.popup-add-value').addClass('hidden');
	});
</script>
@endsection