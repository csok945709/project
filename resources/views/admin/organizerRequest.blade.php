@extends('layouts.adminApp')

@section('content')
<h1 style="text-align:center">Organizer Request</h1>
<div class="row">
@include('admin/sidebar')
    <div class="col-8">
        <table id="UserData" class="display">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Experience</th>
                    <th>Work Years</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applyData as $apply)
                    
                
                <tr>
                    <td></td>
                    <td>{{ $apply->name }}</td>
                    <td>{{$apply->experience }}</td>
                    <td>{{ $apply->workyears }}</td>
                    <td>@if ( $apply->status == 0)
                        Pending
                    @else
                        Approved
                    @endif</td>
                    <td>
                    <a href="{{ route('admin.organizerDetail', [$apply->user_id]) }}" class="btn btn-info" style="color:white">View More</a>
                            @if ($apply->status == 0)
                                <a href="{{route('admin.approveOrganizer', [$apply->user_id] )}}" class="btn btn-success" onclick="return confirm('Are you sure you want to Approve this request ?')">Approve</a>
                            @else
                                <a href="{{route('admin.approveOrganizer', [$apply->user_id] )}}" class="btn btn-success" disable>Approved</a>  
                            @endif
                        <a href="#" class="btn btn-danger" onclick="return confirm('Are you sure you want to Ban this user ?')">Ban User</a>
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