@extends('backend.master.master')
@section('title', 'Comments')
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
        <div class="panel-heading">Bình luận cần phê duyệt</div>
        <div class="panel-body">
            <div class="bootstrap-table">
                <div class="fixed-table-toolbar"></div>
                <div class="fixed-table-container">
                    <div class="fixed-table-header">
                        <div class="alert bg-success" role="alert">
                            <svg class="glyph stroked checkmark">
                                <use xlink:href="#stroked-checkmark"></use>
                            </svg> comment đã được phê duyệt !<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>
                    </div>
                    <div class="fixed-table-body">
                        <div class="fixed-table-loading" style="top: 37px; display: none;">Loading, please wait…</div>
                        <table data-toggle="table" data-url="tables/data2.json" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Tên</th>
                                    <th>Comment</th>
                                    <th>Tuỳ chỉnh</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="Popovers-product" href="#">Áo Khoác Bomber Nỉ Xanh
                                            <div class="Popovers-info">
                                                <div class="panel panel-info product-info">
                                                    <div class="panel-heading" align='center'>
                                                        Thông tin
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <img width="100%" src="img/ao-khoac.jpg" class="thumbnail">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p><strong>Mã sản phẩm : SP01</strong></p>
                                                                <p>Tên sản phẩm :Áo Khoác Bomber Nỉ Xanh Lá Cây
                                                                    AK179</p>
                                                                <p>Danh mục:Áo khoác nam</p>
                                                                <p>size:xl,xxl</p>
                                                                <div class="group-color">Màu tuỳ chọn:
                                                                    <div class="product-color" style="background-color: blueviolet;"></div>
                                                                    <div class="product-color" style="background-color: brown;"></div>
                                                                    <div class="product-color" style="background-color: darkorange;"></div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                    <td>zimpro94</td>
                                    <td>Tôi muốn đặt sản phẩm này .... </td>
                                    <td>
                                        <a name="" id="" class="btn btn-success" href="#" role="button"><span class="glyphicon glyphicon-ok"
                                                aria-hidden="true"></span> Xác nhận</a>
                                        <a name="" id="" class="btn btn-warning" href="editcomment.html" role="button"><span
                                                class="glyphicon glyphicon-edit" aria-hidden="true"></span>Sửa</a>
                                        <a name="" id="" class="btn btn-danger" href="#" role="button"><span class="glyphicon glyphicon-remove"
                                                aria-hidden="true"></span>Xoá</a>

                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="Popovers-product" href="#">Áo Khoác Nam oritan
                                            <div class="Popovers-info">
                                                <div class="panel panel-info product-info">
                                                    <div class="panel-heading" align='center'>
                                                        Thông tin
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <img width="100%" src="img/ao-khoac.jpg" class="thumbnail">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p><strong>Mã sản phẩm : SP01</strong></p>
                                                                <p>Tên sản phẩm :Áo Khoác Bomber Nỉ Xanh Lá Cây
                                                                    AK179</p>
                                                                <p>Danh mục:Áo khoác nam</p>
                                                                <p>size:xl,xxl</p>
                                                                <div class="group-color">Màu tuỳ chọn:
                                                                    <div class="product-color" style="background-color: blueviolet;"></div>
                                                                    <div class="product-color" style="background-color: brown;"></div>
                                                                    <div class="product-color" style="background-color: darkorange;"></div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                    <td>zimpro95</td>
                                    <td>Sản phẩm đẹp quá .... </td>
                                    <td>
                                        <a name="" id="" class="btn btn-success" href="#" role="button"><span class="glyphicon glyphicon-ok"
                                                aria-hidden="true"></span> Xác nhận</a>
                                        <a name="" id="" class="btn btn-warning" href="editcomment.html" role="button"><span
                                                class="glyphicon glyphicon-edit" aria-hidden="true"></span>Sửa</a>
                                        <a name="" id="" class="btn btn-danger" href="#" role="button"><span class="glyphicon glyphicon-remove"
                                                aria-hidden="true"></span>Xoá</a>

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="pull-right pagination">
                            <ul class="pagination">
                                <li class="page-first disabled"><a href="javascript:void(0)">&lt;&lt;</a></li>
                                <li class="page-pre disabled"><a href="javascript:void(0)">&lt;</a></li>
                                <li class="page-number active disabled"><a href="javascript:void(0)">1</a></li>
                                <li class="page-number"><a href="javascript:void(0)">2</a></li>
                                <li class="page-number"><a href="javascript:void(0)">3</a></li>
                                <li class="page-next"><a href="javascript:void(0)">&gt;</a></li>
                                <li class="page-last"><a href="javascript:void(0)">&gt;&gt;</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>




</div>
<!--end main-->
@endsection