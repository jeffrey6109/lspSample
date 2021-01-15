
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card ">
                <div class="card-header text-center">Product List</div>

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
            <th colspan="4">Action</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td><img style="width:3cm;height:3cm;" src="/lsp/public/storage/product_image/{{$product->p_image}}"></td>

            <td>{{$product->p_serial_no}}</td>

            <td>{{$product->p_name}}</td>

            <td><!--- Product detail --->
                <button href="#" data-toggle="modal" data-target="#view_{{$product->p_id}}" class="btn btn-outline-secondary"><i class="glyphicon glyphicon-eye-open"></i><span uk-icon="info"></span> Details</button>
                <div class="modal fade" id="view_{{$product->p_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Product Details</h3>
                                    </div>
                                    <div class="panel-body">
                                        <img style="width:5cm;height:5cm;" class="rounded mx-auto d-block " src="/lsp/public/storage/product_image/{{$product->p_image}}">
                                        <br><br>
                                        <table class="table table-striped table-bordered">

                                                <tr>
                                                    <th>Serial no :</th>
                                                    <td>{{$product->p_serial_no}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Product name :</th>
                                                    <td>{{$product->p_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Product Quantity :</th>
                                                    <td>{{$product->p_quantity}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Purchase Price(per) :</th>
                                                    <td>RM {{$product->p_purchase_price}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Purchase:</th>
                                                    <td>RM {{$product->p_total_purchase}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Sold Price(per):</th>
                                                    <td>RM {{$product->p_sold_price}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Discount(%) :</th>
                                                    <td>{{$product->p_discount}} %</td>
                                                </tr>
                                                @if($product->p_discount > 0)
                                                <tr>
                                                    <th>Price after discount :</th>
                                                    <td>RM {{$product->p_sold_price-(($product->p_sold_price * $product->p_discount)/100)}}</td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <th>Last Updated :</th>
                                                    <td>{{$product->updated_at}}</td>
                                                </tr>
                                        </table>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal"><span uk-icon="close"></span> Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
            </td>

            <td><!--- Product purchase --->
                <button href="#" data-toggle="modal" data-target="#view_{{$product->p_id}}" class="btn btn-outline-info"><i class="glyphicon glyphicon-eye-open"></i><span uk-icon="cart"></span> Purchase/Import</button>
                <div class="modal fade" id="view_{{$product->p_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Purchase Product</h3>
                                    </div>
                                    <div class="panel-body">
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
                                        {{Form::number('quantity','0', ['class'=>'form-control','min'=>'0','max'=>'500'])}}
                                        </div>
                                        <div class="form-group">
                                        {{Form::label('purchase_price', 'purchase Price(RM/Per) :')}}
                                        {{Form::text('purchase_price','', ['class'=>'form-control','placeholder' => 'example 500 or 5.00'])}}
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

            <td><a href="/lsp/public/products/{{$product->p_id}}/edit" class="btn btn-outline-primary"><span uk-icon="file-edit"></span> Edit</a></td>

            <td>
                {!!Form::open(['action'=> ['ProductsController@destroy', $product->p_id],'method' => 'post', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::button('<i uk-icon="trash"></i> Delete',['class' => 'btn btn-outline-danger', 'type' => 'submit'])}}
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
