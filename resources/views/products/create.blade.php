@extends('layouts.app')

@section('content')
<a href="/lsp/public/products" class="btn btn-light"><span uk-icon="reply"></span> Go Back</a>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header text-center">New Product</div>

                <div class="card-body">

    {!! Form::open(['action'=> 'ProductsController@store' , 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('image','Product Image :')}}
        {{Form::file('product_image')}}
    </div>
    <div class="form-group">
        {{Form::label('name', 'Product Name :')}}
        {{Form::text('name','',['class'=>'form-control','placeholder' => 'Product name'])}}
    </div>
        <div class="form-group">
            {{Form::label('quantity', 'Product Quantity :')}}
            {{Form::text('quantity','', ['class'=>'form-control','placeholder' => 'Product Quantity'])}}
        </div>
        <div class="form-group">
            {{Form::label('purchase_price', 'Purchase Price(RM/Per) :')}}
            {{Form::text('purchase_price','', ['class'=>'form-control','placeholder' => 'example 500 or 5.00'])}}
        </div>
        <div class="form-group">
            {{Form::label('sold_price', 'Sold Price(RM/Per) :')}}
            {{Form::text('sold_price','', ['class'=>'form-control','placeholder' => 'example 56 or 5.00'])}}
        </div>
        <div class="form-group">
            {{Form::label('discount', 'Discount(%) :')}}
            {{Form::text('discount','', ['class'=>'form-control','placeholder' => '(optional)'])}}
        </div>

        {{Form::submit('Submit' , ['class' =>'btn btn-primary'])}}
    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
