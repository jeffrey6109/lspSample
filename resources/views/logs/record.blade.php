@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Logs</div>

                <div class="card-body">

        @if(count($log) > 0)
        <table class="table table-striped table-hover table-bordered">
            <tr>
                <th>#</th>
                <th>Serial No</th>
                <th>Product Name</th>
                <th>Action</th>
                <th>Quantity</th>
                <th>purchase price(RM/Per)</th>
                <th>Total Price</th>
                <th>Time execute</th>

            </tr>
            @foreach($log as $logs)
            <tr>
                <td>{{$logs->l_id}}</td>
                <td>{{$logs->l_p_serial_number}}</td>
                <td>{{$logs->l_p_name}}</td>

                @if($logs->l_action = 'Purchase')
                <td style="background-color: palegreen">{{$logs->l_action}}</td>
                @elseif($logs->l_action = 'New')
                <td style="background-color: rgb(225, 228, 78)">{{$logs->l_action}}</td>
                @elseif($logs->l_action = 'Update')
                <td style="background-color: rgb(130, 158, 243)">{{$logs->l_action}}</td>
                @elseif($logs->l_action = 'Delete')
                <td style="background-color: lightcoral">{{$logs->l_action}}</td>
                @else
                <td style="background-color: skyblue">{{$logs->l_action}}</td>
                @endif

                <td>{{$logs->l_quantity}}</td>
                <td>RM {{$logs->l_purchase_price}}</td>
                <td>RM {{$logs->l_amount}}</td>
                <td>{{$logs->created_at}}</td>

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
