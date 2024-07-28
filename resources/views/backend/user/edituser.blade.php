@extends('backend.master.master')
@section('title', 'Edit User')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Member</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fas fa-user"></i> Edit Member - admin@gmail.com</div>
                    <form action="{{ route('user.editUser', ['id' => $user->id]) }}" method="post">
                        @csrf
                        <div class="panel-body">
                            <div class="row justify-content-center" style="margin-bottom:40px">
                                <div class="col-md-8 col-lg-8 col-lg-offset-2">
                                    <div class="form-group">
                                        <label>Email <span class="color-red">*</span></label>
                                        <input type="text" name="email" class="form-control" readonly value="{{ $user->email }}">
                                        <!-- <div class="alert alert-danger" role="alert">
                                            <strong>email đã tồn tại!</strong>
                                        </div> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Full name <span class="color-red">*</span></label>
                                        <input type="full" name="full" class="form-control" value="{{ old('full', $user->full) }}">
                                        @if ($errors->has('full'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('full') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="address" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone <span class="color-red">*</span></label>
                                        <input type="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                                        @if ($errors->has('phone'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select name="level" class="form-control" value="">
                                            <option @if(old('level', $user->level)==2) selected @endif value="2">Staff</option>
                                            <option @if(old('level', $user->level)==1) selected @endif value="1">Manager</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 col-lg-8 col-lg-offset-2 text-right">
                                        <button class="btn btn-success"  type="submit">Edit</button>
                                        <a class="btn btn-danger" href="javascript:history.back()">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>

        </div>
    </div>
    <!--/.row-->
</div>
<!--end main-->
@endsection
@section('active')
<script>
	$('.manage_members').addClass('active');
</script>
@endsection