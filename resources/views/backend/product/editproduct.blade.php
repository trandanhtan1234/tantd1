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
    <form action="{{ route('editProduct', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-6 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Edit Product {{ $product->name }} ({{ $product->code }})</div>
                    <div class="panel-body">
                        <div class="row" style="margin-bottom:40px">
                            <div class="col-xs-8">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category" class="form-control">
                                                {{ getCategory($category,0,0,'',$product->category_id) }}
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input required type="text" name="name" class="form-control"
                                                value="{{ old('name', $product->name) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Price</label> <a href="{{ url('admin/variant/editvariant') }}"><span
                                                    class="glyphicon glyphicon-chevron-right"></span>
                                                Price By Variants</a>
                                            <input required type="number" name="price" class="form-control"
                                                value="{{ old('price', $product->price) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Featured</label>
                                            <select name="featured" class="form-control">
                                                <option @if($product->featured==0) selected @endif value="0">No</option>
                                                <option @if($product->featured==1) selected @endif value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select required name="status" class="form-control">
                                                <option @if($product->status==1) selected @endif value="1">In Stock</option>
                                                <option @if($product->status==0) selected @endif value="0">Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <input id="img" type="file" name="img" class="form-control hidden" value="{{ old('img', $product->img) }}"
                                                onchange="changeImg(this)">
                                            @php
                                                $img = $product->img;
                                                if (!file_exists(public_path($img))) {
                                                    $img = 'base/img/no-img.jpg';
                                                }
                                            @endphp
                                            <img id="avatar" class="thumbnail" width="100%" height="350px" src="{{ url($img) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="panel panel-default">
                                    <div class="panel-body tabs">
                                        <label>Attributes</label>
                                        @if ($errors->has('attr'))
                                            <div class="alert alert-danger">
                                                <strong>{{ $errors->first('attr') }}</strong>
                                            </div>
                                        @endif
                                        <ul class="nav nav-tabs">
                                            @php
                                                $i=0;
                                            @endphp
                                            @foreach ($attrs as $attr)
                                            <li @if($i==0) class='active' @endif><a href="#tab{{ $attr->id }}" data-toggle="tab">{{ $attr->name }}</a></li>
                                            @php
                                                $i=1;
                                            @endphp
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach ($attrs as $attr)
                                            <div class="tab-pane fade @if($i==1) active @endif in" id="tab{{ $attr->id }}">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            @foreach ($attr->values as $val)
                                                            <th><label for="{{ $val->id }}">{{ $val->value }}</label></th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @foreach ($attr->values as $val)
                                                            <td><input class="form-check-input" @if(checkValue($product,$val->id)) checked @endif id="{{ $val->id }}" type="checkbox" name="attr[{{ $attr->id }}][]"
                                                                    value="{{ $val->id }}"></td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                            </div>
                                                @php
                                                    $i=2;
                                                @endphp
                                            @endforeach
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
                                    <textarea id="editor" name="description" style="width: 100%;height: 100px;">{{ old('description', $product->description) }}</textarea>
                                </div>
                                <button class="btn btn-success" name="add-product" type="submit">Edit Product</button>
                                <a class="btn btn-danger" href="{{ URL::previous() }}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--/.row-->

    <div class="clearfix"></div>
</div>
<!--end main-->
@endsection
@section('active')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
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