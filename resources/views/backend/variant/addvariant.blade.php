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
            <form action="{{ route('addVariant', ['id' => $product->id]) }}" method="post">
                @csrf
                <div class="panel-heading" align='center'>
                    Price for each variant of product: {{ $product->name }} ({{ $product->code }})
                </div>
                <div class="panel-body variant-table" align='center'>
                    <table class="panel-body">
                        <thead>
                            <tr>
                                <th width='33%'>Variant</th>
                                <th width='33%'>Price (Nullable)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->variant as $row)
                            <tr>
                                <td scope="row">
                                    @foreach ($row->values as $val)
                                        {{ $val->attribute->name }} : {{ $val->value }},
                                    @endforeach
                                </td>
                                <td>
                                    <div>
                                        <input type="number" name="var_price[{{ $row->id }}]" class="form-control" placeholder="Variant Price" value="{{ old('var_price', $row->price) }}">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div align='right' class="tab-content">
                    <button class="btn btn-success" type="submit">Update</button>
                    <a class="btn btn-warning" href="{{ url('admin/product') }}" role="button">Ignore</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end main-->
@endsection