@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-30">
            <div class="card">
                <div class="card-header text-center">Catalog</div>

                <div class="card-body">

                    <div class="col-md-6 text-center">
                        <form class="input-group input-group-default mb-3" type="get" action="{{ url('/search') }}">
                            <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">&nbsp
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
        @if(count($products) > 0)
        <table class="table table-striped table-bordered table-hover text-center">
            <tr>
                <th>Product Image</th>
                <th>Serial No</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Discount(%)</th>
                <th>Price(RM)</th>
                <th>Action</th>

            </tr>
            @foreach($products as $product)
            <tr>
                <td><img style="width:3cm;height:3cm;" src="/lsp/public/storage/product_image/{{$product->p_image}}"></td>
                <td>{{$product->p_serial_no}}</td>
                <td>{{$product->p_name}}</td>
                <td>{{$product->p_quantity}}</td>
                <td>{{$product->p_discount}} %</td>
                @if($product->p_discount >0)
                <td>{{$product->p_sold_price-(($product->p_sold_price * $product->p_discount)/100)}}</td>
                @else
                <td>{{$product->p_sold_price}}</td>
                @endif
                <td>
                    <button href="#" data-toggle="modal" data-target="#view_{{$product->p_id}}" class="btn btn-outline-success"><i class="glyphicon glyphicon-eye-open"></i><span uk-icon="credit-card"></span> Sold/export</button>
                    <div class="modal fade" id="view_{{$product->p_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Sold Product</h3>
                                        </div>
                                        <div class="panel-body">
                                            {!! Form::open(['action'=> ['PagesController@minus', $product->p_id] , 'method' => 'POST','enctype'=>'multipart/form-data']) !!}

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
                                            {{Form::number('quantity','0', ['class'=>'form-control','min'=>'0','max'=>'500'])}}
                                            </div>
                                            <div class="form-group">
                                            {{Form::label('sold_price', 'Sold Price(RM/Per) :')}}
                                            {{Form::text('sold_price','', ['class'=>'form-control','placeholder' => 'example 500 or 5.00'])}}
                                            </div>

                                            <div class="form-group">
                                            {{Form::submit('Submit' , ['class' =>'btn btn-outline-primary'])}}
                                            </div>

                                            <div class="form-group">
                                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> Cancel</button>
                                            </div>

                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <a href="/lsp/public/" class="btn btn-light"><span uk-icon="reply"></span> Go Back</a>
        <h3>No product to display</h3>
        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
