@extends('layouts.app')

@section('content')

<div class="row">  
<div class="container">
        @include('profiles.profile')  

        <div class="col-12">
                <h1 style="text-align:center;font-weight:700">Report Post Details</h1>
                <div style="text-align:center">
                    <a href="{{ route('profile.reportPostDetails', Auth::user()->id)}}" class="btn btn-secondary">Report Post Details</a>
                    <a href="{{ route('profile.reportDocDetails', Auth::user()->id)}}" class="btn btn-primary">Report Document Details</a>
                </div>
                <table id="UserData" class="display">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Report Type</th>
                            <th>Report Content</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            
                        
                        <tr>
                            <td></td>
                            <td>{{ $report->caption }}</td>
                            <td>{!! str_limit($report->reportDescription,$words = 50, $end = '...') !!}</td>
                            <td>@if ($report->reportStatus == 0)
                                <span style="color:red;font-weight:600">Pending</span>
                            @else
                                <span style="color:red;font-weight:600">Approved and Post has been Suspended by the Admin</span>
                            @endif</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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