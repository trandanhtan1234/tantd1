@extends('backend.master.master')
@section('title', 'List Users')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{ url('admin') }}"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Manage Members</li>
		</ol>
	</div>
	
	<!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">List Users</h1>
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
								<a href="{{ url('admin/user/add') }}" class="btn btn-primary">Add User</a>
								<a href="{{ url('admin/user/export-users') }}" class="excel-btn btn" target="_blank">Export</a>
							</div>

							<form method="GET" action="{{ route('user') }}" class="form-inline mb-3" style="margin-top:20px;">
                                <div class="form-group">
                                    <input type="text" name="full" class="form-control" placeholder="Enter Name" value="{{ request('full') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Enter Email" value="{{ request('email') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ url('admin/user') }}" class="btn btn-default">Reset</a>
                            </form>

							<table class="table table-bordered" style="margin-top:20px;">
								<thead>
									<tr class="bg-primary">
										<th>ID</th>
										<th>Email</th>
										<th>Full</th>
										<th>Address</th>
										<th>Phone</th>
										<th>Level</th>
										<th width='18%'>Options</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($users as $user)
									<tr>
										<td>{{ $user->id }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->full }}</td>
										<td>{{ $user->address }}</td>
										<td>{{ $user->phone }}</td>
										<td>{{ $user->level==1?'Manager':'Staff' }}</td>
										<td>
											<a href="{{ url('admin/user/edit/'. $user->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
											<a onclick="return delUser('<?= $user->full ?>')" href="{{ url('admin/user/delete/'. $user->id) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							@if ($users)
							<div align='right'>
								{{ $users->onEachSide(3)->links() }}
							</div>
							@endif
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

@section('user')
<script src="{{  asset('js/user.js')  }}"></script>
@endsection

@section('active')
<script>
	$('.manage_members').addClass('active');
</script>
@endsection
