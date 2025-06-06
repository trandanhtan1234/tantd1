@extends('backend.master.master')
@section('title', 'Edit Customer')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Customer</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fas fa-user"></i> Edit Customer - {{ $customer->email }}</div>
                    <form action="{{ route('update.customer', ['id' => $customer->id]) }}" method="post">
                        @csrf
                        <div class="panel-body">
                            <div class="row justify-content-center" style="margin-bottom:40px">
                                <div class="col-md-8 col-lg-8 col-lg-offset-2">
                                    <div class="form-group">
                                        <label>Email <span class="color-red">*</span></label>
                                        <input type="text" name="email" class="form-control" readonly value="{{ $customer->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Full name <span class="color-red">*</span></label>
                                        <input type="full" name="full" class="form-control" value="{{ old('full', $customer->full) }}">
                                        @if ($errors->has('full'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('full') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="address" name="address" class="form-control" value="{{ old('address', $customer->address) }}">
                                        @if ($errors->has('phone'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Phone <span class="color-red">*</span></label>
                                        <input type="phone" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}">
                                        @if ($errors->has('phone'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </div>
                                        @endif
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
	$('.manage_customers').addClass('active');
</script>
@endsection