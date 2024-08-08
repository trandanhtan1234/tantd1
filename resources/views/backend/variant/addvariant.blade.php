@extends('backend.master.master')
@section('title', 'Add Variant')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Variants</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Variants</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="col-md-12">
        <div class="panel panel-default">
        
                <div class="panel-heading" align='center'>
                    Price for each variant of product: Armor level 3 (AN01)
                </div>
                <div class="panel-body" align='center'>
                    <table class="panel-body">
                        <thead>
                            <tr>
                                <th width='33%'>Variant</th>
                                <th width='33%'>Price (Nullable)</th>
                                <th width='33%'>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">
                                    Size : M,
                                    Color : Black,
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input name="var_name" class="form-control" placeholder="Variant Price" value="{{ old('var_name') }}">
                                    </div>
                                </td>
                                <td>
                                    <a id="" class="btn btn-warning" href="admin/product/delete-variant/1" role="button">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">
                                    Size : L,
                                    Color : Black,
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input name="" class="form-control" placeholder="Giá cho biến thể" value="">
                                    </div>
                                </td>
                                <td>
                                    <a id="" class="btn btn-warning" href="admin/product/delete-variant/2" role="button">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div align='right'><button class="btn btn-success" type="submit"> Update </button> <a class="btn btn-warning"
                        href="admin/product" role="button">Ignore</a></div>
        </div>
    </div>
</div>
<!--end main-->
@endsection