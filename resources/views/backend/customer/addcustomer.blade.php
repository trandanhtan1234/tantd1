@extends('backend.master.master')
@section('title', 'Add User')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add User</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fas fa-user"></i> Add User</div>
                    <div class="panel-body">
                        <form action="{{ route('user.postUser') }}" method="post">
                            @csrf
                            <div class="row justify-content-center" style="margin-bottom:40px">

                                <div class="col-md-8 col-lg-8 col-lg-offset-2">
                                
                                    <div class="form-group">
                                        <label>Email <span class="color-red">*</span></label>
                                        <input type="text" placeholder="Email" name="email" value="{{ old('email') }}" class="form-control">
                                        @if ($errors->has('email'))
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group position-relative navbar">
                                        <label>Password (Default)</label>
                                        <input type="text" name="password" class="form-control hide-password" value="123456" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Full name <span class="color-red">*</span></label>
                                        <input type="full" name="full" class="form-control" value="{{ old('full') }}">
                                        @if ($errors->has('full'))
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $errors->first('full') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="address" name="address" class="form-control" value="{{ old('address') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone <span class="color-red">*</span></label>
                                        <input type="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 col-lg-8 col-lg-offset-2 text-right">
                                        <button class="btn btn-success"  type="submit">Add Customer</button>
                                        <a class="btn btn-danger" href="javascript:history.back()">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>

        </div>
    </div>

    <!--/.row-->
</div>
<!--end main-->
@endsection
<!-- @section('user')
<script src="js/user.js"></script>
@endsection -->
@section('active')
<script>
	$('.manage_customers').addClass('active');
</script>
@endsection