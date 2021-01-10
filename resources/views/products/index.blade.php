
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header text-center">Produce List</div>

                <div class="card-body">

                    <div class="col-md-10 text-center">
                        <form class="input-group input-group-default mb-3" type="get" action="{{ url('/searched') }}">
                            <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">&nbsp;
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>

                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/lsp/public/products/create" class="btn btn-light" ><span uk-icon="plus-circle"></span> New Product</a>
                    </div><br>

    @if(count($products) > 0)
    <table class="table table-striped table-hover table-bordered align-middle center">
        <tr>
            <th>Product image</th>
            <th>Serial no</th>
            <th>Product Name</th>
            <th colspan="3">Action</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td><img style="width:3cm;height:3cm;" src="/lsp/public/storage/product_image/{{$product->p_image}}"></td>

            <td>{{$product->p_serial_no}}</td>

            <td><a href="/lsp/public/products/{{$product->p_id}}">{{$product->p_name}}</a></td>

            <td><a href="/lsp/public/products/{{$product->p_id}}/add" class="btn btn-info"><span uk-icon="cart"></span> Add</a></td>

            <td><a href="/lsp/public/products/{{$product->p_id}}/edit" class="btn btn-primary"><span uk-icon="file-edit"></span> Edit</a></td>

            <td>
                {!!Form::open(['action'=> ['ProductsController@destroy', $product->p_id],'method' => 'post', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::button('<i uk-icon="trash"></i> Delete',['class' => 'btn btn-danger', 'type' => 'submit'])}}
                {!!Form::close()!!}
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <p>You have no product to display</p>
    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
