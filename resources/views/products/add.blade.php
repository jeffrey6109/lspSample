@extends('layouts.app')

@section('content')
    <h1>Add product</h1>
    <img style="width:5cm;height:5cm;" class="rounded mx-auto d-block" src="/lsp/public/storage/product_image/{{$product->p_image}}">
    <br><br>
    {!! Form::open(['action'=> ['PagesController@added', $product->p_id] , 'method' => 'POST','enctype'=>'multipart/form-data']) !!}

    <div class="form-group">
        {{Form::label('serial_no', 'Serial no :')}}
        {{Form::text('serial_no', $product->p_serial_no,['class'=>'form-control','readonly'])}}
    </div>
    <div class="form-group">
        {{Form::label('name', 'Product Name :')}}
        {{Form::text('name', $product->p_name,['class'=>'form-control','placeholder' => 'Product name','readonly'])}}
    </div>
        <div class="form-group">
            {{Form::label('quantity', 'Product Quantity :')}}
            {{Form::text('quantity','', ['class'=>'form-control','placeholder' => 'Product Quantity'])}}
        </div>
        <div class="form-group">
            {{Form::label('purchase_price', 'Purchase Price(RM/Per) :')}}
            {{Form::text('purchase_price','', ['class'=>'form-control','placeholder' => 'example 500 or 5.00'])}}
        </div>

        {{Form::submit('Submit' , ['class' =>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
