@extends('backend.master.master')
@section('title', 'Edit')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Quản lý bình luận</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Bình luận</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="panel panel-default">
        <div class="panel-heading">Sửa bình luận</div>
        <div class="panel-body">
            <div class="panel panel-info">
                <div class="panel-heading">
                    zimpro94
                </div>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea class="form-control" rows="3">Tôi muốn đặt sản phẩm này nhé bạn! giá bao nhiêu thế? có giảm được không?
                                        
                                </textarea>
                </div>
                <button class="btn btn-success" role="button">Sửa</button>
            </div>
        </div>
    </div>
</div>
<!--end main-->
@endsection