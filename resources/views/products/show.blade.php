@extends('layouts.app')

@section('content')
    <a href="/lsp/public/products" class="btn btn-light"><span uk-icon="reply"></span> Go Back</a>
    <br><br>
    <h3 class="text-center">{{$products->p_name}}</h3>
    <img style="width:5cm;height:5cm;" class="rounded mx-auto d-block " src="/lsp/public/storage/product_image/{{$products->p_image}}">
    <br><br>
    <table class="table table-striped table-hover table-bordered">

            <tr>
                <th>Serial no :</th>
                <td>{{$products->p_serial_no}}</td>
            </tr>
            <tr>
                <th>Product name :</th>
                <td>{{$products->p_name}}</td>
            </tr>
            <tr>
                <th>Product Quantity :</th>
                <td>{{$products->p_quantity}}</td>
            </tr>
            <tr>
                <th>Purchase Price(per) :</th>
                <td>RM {{$products->p_purchase_price}}</td>
            </tr>
            <tr>
                <th>Total Purchase:</th>
                <td>RM {{$products->p_total_purchase}}</td>
            </tr>
            <tr>
                <th>Sold Price(per):</th>
                <td>RM {{$products->p_sold_price}}</td>
            </tr>
            <tr>
                <th>Discount(%) :</th>
                <td>{{$products->p_discount}} %</td>
            </tr>
            <tr>
                <th>Last Import :</th>
                <td>{{$products->updated_at}}</td>
            </tr>
    </table>
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-2">
            <a href="/lsp/public/products/{{$products->p_id}}/edit" class="btn btn-primary"><span uk-icon="file-edit"></span> Edit</a>
          </div>
          <div class="col-md-2">
            {!!Form::open(['action'=> ['ProductsController@destroy', $products->p_id],'method' => 'post', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::button('<i uk-icon="trash"></i> Delete',['class' => 'btn btn-danger', 'type' => 'submit'])}}
            {!!Form::close()!!}
            </div>
        </div>
    </div>
    <br><br>
@endsection
