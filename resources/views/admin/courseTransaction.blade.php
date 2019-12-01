@extends('layouts.adminApp')

@section('content')
<div class="row">
@include('admin/sidebar')
    <div class="col-8">
        <h1 style="text-align:center">Online Course Transaction Details</h1>
        <table id="UserData" class="display">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Course Name</th>
                    <th>Organizer</th>
                    <th>Buyer</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    
                
                <tr>
                    <td></td>
                    <td>{{ $transaction->title }}</td>
                    <td>{{  DB::table('users')->where('users.id', $transaction->user_id)->get('username')->pluck('username')->first()  }}</td>
                    <td>{{ $transaction->username }}</td>
                    <td>{{ $transaction->price }}</td>
                    <td>
                            <span style="color:green;font-weight:600">Complete</span>
                    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('javascript')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    var t = $('#UserData').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
    </script>
@stop