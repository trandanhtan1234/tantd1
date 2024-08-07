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
                <form action="{{ route('addProduct') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="panel-body">
                        <div class="row" style="margin-bottom:40px">
                            <div class="col-xs-8">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category" class="form-control">
                                                {{ getCategory($category,0,0,'',0) }}
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Name <span class="color-red">*</span></label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <div class="alert alert-danger">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Price <span class="color-red">*</span></label>
                                            <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                                            @if ($errors->has('price'))
                                                <div class="alert alert-danger">
                                                    <strong>{{ $errors->first('price') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Featured Product</label>
                                            <select name="featured" class="form-control">
                                                <option @if(old('featured')==0) selected @endif value="0">No</option>
                                                <option @if(old('featured')==1) selected @endif value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option @if(old('status')==1) selected @endif value="1">In stock</option>
                                                <option @if(old('status')==0) selected @endif value="0">Out of Stock</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" name="quantity" value="{{ old('quantity') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <input id="img" type="file" name="img" class="form-control hidden"
                                                onchange="changeImg(this)" value="{{ old('img') }}" accept="image/jpg">
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
                                        @if ($errors->has('attr_name'))
                                            <div class="alert alert-danger">
                                                <strong>{{ $errors->first('attr_name') }}</strong>
                                            </div>
                                        @endif
                                        @if ($errors->has('value_name'))
                                            <div class="alert alert-danger">
                                                <strong>{{ $errors->first('value_name') }}</strong>
                                            </div>
                                        @endif
                                        <ul class="nav nav-tabs">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($attributes as $attr)
                                                <li @if ($i==0) class="active" @endif><a href="#tab{{ $attr->id }}" data-toggle="tab">{{ $attr->name }}</a></li>
                                            @php
                                                $i=1;
                                            @endphp
                                            @endforeach
                                            <li><a href="#tab-add" data-toggle="tab">+</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            @foreach ($attributes as $attr)
                                            <div class="tab-pane fade @if($i==1) active @endif in" id="tab{{ $attr->id }}">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            @foreach ($attr->values as $item)
                                                                <th><label for="{{ $item->value }}">{{ $item->value }}</label></th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @foreach ($attr->values as $item)
                                                                <td><input class="form-check-input" type="checkbox" id="{{ $item->value }}" name="attr[{{ $attr->id }}][]"
                                                                    value="{{ $item->id }}"></td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <div class="form-group">
                                                    <form action="{{ route('addValue') }}" method="post">
                                                        @csrf
                                                        <label>Add value for attribute</label>
                                                        <input type="hidden" name="attr_id" value="{{ $attr->id }}">
                                                        <input name="value_name" type="text" class="form-control"
                                                            aria-describedby="helpId" placeholder="Enter value">
                                                        <button class="margin-attr" name="add_val" type="submit">Add</button>
                                                    </form>
                                                </div>
                                            </div>
                                            @php
                                            $i=2;
                                            @endphp
                                            @endforeach
                                            <div class="tab-pane fade" id="tab-add">
                                                <form action="" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="">Add New Attribute</label>
                                                        <input type="text" class="form-control" name="attr_name"
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <button type="submit" name="add_pro" class="btn btn-success"> <span
                                                            class="glyphicon glyphicon-plus"></span>
                                                        Add Attribute</button>
                                                </form>
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
                                        <textarea id="editor" name="description" style="width: 100%;height: 100px;"></textarea>
                                    </div>
                                    <button class="btn btn-success" name="add-product" type="submit">Add Product</button>
                                    <a href="{{ url('/admin/product') }}" class="btn btn-danger" type="reset">Cancel</a>
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
    $('.products').addClass('active');

    $('#avatar').on('click', function() {
        $('#img').click();
    });

    function changeImg(event) {
        if (event.files && event.files[0]) {
            const reader = new FileReader();
            reader.onload = function(img) {
                var output = $('#avatar').attr('src', img.target.result);
            }
            reader.readAsDataURL(event.files[0]);
        }
    }
</script>
@endsection