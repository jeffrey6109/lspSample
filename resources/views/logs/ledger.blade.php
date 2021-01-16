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
                <th>Product Serial No</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Action</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Transaction Time</th>

            </tr>
            <tr>
                <td>{{$ledger->uuid}}</td>

                <td>{{$ledger->l_p_serial_no}}</td>

                <td>{{$ledger->p_name}}</td>

                <td>{{$ledger->quantity}}</td>

                <td>{{$ledger->action}}</td>

                <td style="background-color: palegreen">{{$ledger->debit}}</td>

                <td style="background-color:lightcoral ">{{$ledger->credit}}</td>

                <td>{{$ledger->created_at}}</td>
            </tr>
            <tr>
                <th rowspan="4">Total :</th>
                <td>{{SUM($ledger->debit)}}</td>
                <td>{{SUM($ledger->credit)}}</td>
            </tr>
        </table>
        @else
        <p>You have no ledger to display</p>
        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
