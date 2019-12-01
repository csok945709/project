@extends('layouts.adminApp')

@section('content')
<div class="row">
@include('admin/sidebar')
    <div class="col-8">
    <h1 style="text-align:center">Posts Report</h1>
        <table id="UserData" class="display">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Report Type</th>
                    <th>Post Name</th>
                    <th>Report Content</th>
                    <th>Report By</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    
                
                <tr>
                    <td></td>
                    <td>{{ $report->reportType }}</td>
                    <td>{{$report->caption }}</td>
                    <td>{!! str_limit($report->reportDescription,$words = 50, $end = '...') !!}</td>
                    <td>{{ $report->username }}</td>
                    <td>@if ( $report->reportStatus == 0)
                            <span style="color:red;font-weight:600">Pending</span>
                    @else
                    <span style="color:red;font-weight:600">Approved and Suspended</span>
                    @endif
                    </td>
                    <td>
                            <a href="{{ route('admin.showReportPost', [$report->post_id]) }}" class="btn btn-secondary" style="color:white" >View More</a>
                            @if ($report->reportStatus == 0)
                                <a href="{{route('admin.approvePostReport', [$report->post_id] )}}" class="btn btn-primary" onclick="return confirm('Are you sure you want to Approve and Suspend this Post ?')">Suspend Post</a>
                                <a href="#" class="btn btn-danger" onclick="return confirm('Are you sure you want to Disapprove this request ?')">Disapprove</a>
                            @else
                                <a href="#" class="btn btn-success" disable>Approved</a>  
                                <a href="{{route('admin.reactivePost', [$report->post_id] )}}" class="btn btn-primary" onclick="return confirm('Are you sure you want to Reactive this Post ?')">Reactived Document</a>  
                            @endif
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