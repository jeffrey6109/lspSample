@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
        <table class="table table-striped table-hover">
            <tr>
                <th>Product Image</th>
                <th>Serial No</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Discount(%)</th>
                <th>Price(RM)</th>

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
                @endif

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
