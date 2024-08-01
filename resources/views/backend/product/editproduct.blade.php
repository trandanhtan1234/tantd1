@extends('backend.master.master')
@section('title', 'Edit')
@section('content')
<!--/. end sidebar left-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Product</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-xs-6 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Edit Product Áo khoác nam đẹp (AN01)</div>
                <div class="panel-body">
                    <div class="row" style="margin-bottom:40px">
                        <div class="col-xs-8">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="form-control">
                                            <option value='1'>Nam</option>
                                            <option value='3' selected>---|Áo khoác nam</option>
                                            <option value='2'>Nữ</option>
                                            <option value='4'>---|Áo khoác nữ</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input required type="text" name="product_name" class="form-control"
                                            value="Áo khoác nam đẹp">
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label> <a href="admin/product/edit-variant/1"><span
                                                class="glyphicon glyphicon-chevron-right"></span>
                                            Price By Variants</a>
                                        <input required type="number" name="product_price" class="form-control"
                                            value="150000">
                                    </div>
                                    <div class="form-group">
                                        <label>Featured</label>
                                        <select name="featured" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select required name="product_state" class="form-control">
                                            <option selected value="1">In Stock</option>
                                            <option value="0">Out of Stock</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Product Image</label>
                                        <input id="img" type="file" name="product_img" class="form-control hidden"
                                            onchange="changeImg(this)">
                                        <img id="avatar" class="thumbnail" width="100%" height="350px" src="img/ao-khoac.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="panel panel-default">
                                <div class="panel-body tabs">
                                    <label>Attributes</label>
                                    <ul class="nav nav-tabs">
                                        <li class='active'><a href="#tab17" data-toggle="tab">Size</a></li>
                                        <li><a href="#tab18" data-toggle="tab">Colors</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade  active  in" id="tab17">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>S</th>
                                                        <th>M</th>
                                                        <th>L</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td> <input class="form-check-input" type="checkbox" name="attr[17][60]"
                                                                value="60"> </td>
                                                        <td> <input class="form-check-input" type="checkbox" name="attr[17][61]"
                                                                value="61" checked> </td>
                                                        <td> <input class="form-check-input" type="checkbox" name="attr[17][64]"
                                                                value="64" checked> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                        </div>

                                        <div class="tab-pane fade  in" id="tab18">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Red</th>
                                                        <th>Black</th>
                                                        <th>Gray</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td> <input class="form-check-input" type="checkbox" name="attr[18][62]"
                                                                value="62"> </td>
                                                        <td> <input class="form-check-input" type="checkbox" name="attr[18][63]"
                                                                value="63" checked> </td>
                                                        <td> <input class="form-check-input" type="checkbox" name="attr[18][65]"
                                                                value="65"> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <p></p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="editor" required name="description" style="width: 100%;height: 100px;"></textarea>
                    </div>
                    <button class="btn btn-success" name="add-product" type="submit">Edit Product</button>
                    <button class="btn btn-danger" type="reset">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->

    <div class="clearfix"></div>
</div>
<!--end main-->
@endsection
@section('active')
<script>
    $('.products').addClass('active');
</script>
@endsection