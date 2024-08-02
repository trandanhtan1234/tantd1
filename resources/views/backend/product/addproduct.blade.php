@extends('backend.master.master')
@section('title', 'Add New')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Product</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-xs-6 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Add Product</div>
                <div class="panel-body">
                    <div class="row" style="margin-bottom:40px">
                        <div class="col-xs-8">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="form-control">
                                            <option value='1' selected>Nam</option>
                                            <option value='3'>---|Áo khoác nam</option>
                                            <option value='2'>Nữ</option>
                                            <option value='4'>---|Áo khoác nữ</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input required type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input required type="number" name="price" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Featured Product</label>
                                        <select name="featured" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>State</label>
                                        <select required name="state" class="form-control">
                                            <option value="1">In stock</option>
                                            <option value="0">Out of Stock</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Product Image</label>
                                        <input id="img" type="file" name="product_img" class="form-control hidden"
                                            onchange="changeImg(this)">
                                        <img id="avatar" class="thumbnail" width="100%" height="350px" src="img/import-img.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="panel panel-default">
                                <div class="panel-body tabs">
                                    <label>Attributes <a href="#"><span class="glyphicon glyphicon-cog"></span>
                                            Options</a></label>
                                    <ul class="nav nav-tabs">
                                        <li class='active'><a href="#tab17" data-toggle="tab">Size</a></li>
                                        <li><a href="#tab18" data-toggle="tab">Colors</a></li>
                                        <li><a href="#tab-add" data-toggle="tab">+</a></li>
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
                                                                value="61"> </td>
                                                        <td> <input class="form-check-input" type="checkbox" name="attr[17][64]"
                                                                value="64"> </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <div class="form-group">
                                                <label for="">Add variant for attribute</label>
                                                <input type="hidden" name="id_pro" value="17">
                                                <input name="var_name" type="text" class="form-control"
                                                    aria-describedby="helpId" placeholder="">
                                                <div> <button name="add_val" type="submit">Add</button></div>
                                            </div>
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
                                                                value="63"> </td>
                                                        <td> <input class="form-check-input" type="checkbox" name="attr[18][65]"
                                                                value="65"> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <div class="form-group">
                                                <label for="">Add variant for attribute</label>
                                                <input type="hidden" name="id_pro" value="18">
                                                <input name="var_name" type="text" class="form-control"
                                                    aria-describedby="helpId" placeholder="">
                                                <div> <button name="add_val" type="submit">Add</button></div>

                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="tab-add">

                                            <div class="form-group">
                                                <label for="">Add New Attribute</label>
                                                <input type="text" class="form-control" name="pro_name"
                                                    aria-describedby="helpId" placeholder="">
                                            </div>

                                            <button type="submit" name="add_pro" class="btn btn-success"> <span
                                                    class="glyphicon glyphicon-plus"></span>
                                                Add Attribute</button>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea id="editor" required name="description" style="width: 100%;height: 100px;"></textarea>
                                </div>
                                <button class="btn btn-success" name="add-product" type="submit">Add Product</button>
                                <a href="{{ url('/admin/product') }}" class="btn btn-danger" type="reset">Cancel</a>
                            </div>
                        </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>

    <!--/.row-->
</div>
<!--end main-->
@endsection
@section('active')
<script>
    $('.products').addClass('active');
</script>
@endsection