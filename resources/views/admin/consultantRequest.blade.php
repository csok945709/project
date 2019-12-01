@extends('layouts.adminApp')

@section('content')
<div class="row">
@include('admin/sidebar')
    <div class="col-8">
        <h1 style="text-align:center">Consultant Request</h1>
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
                    <td>{{ $apply->experience }}</td>
                    <td>{{ $apply->workyears }}</td>
                    <td>@if ( $apply->status == 0)
                            Pending
                        @else
                            Approved
                        @endif</td>
                    <td>
                        <a href="{{ route('admin.showCon', [$apply->user_id]) }}" class="btn btn-secondary" style="color:white" >View More</a>
                        @if ($apply->status == 0)
                            <a href="{{route('admin.approveConsultant', [$apply->user_id] )}}" class="btn btn-primary" onclick="return confirm('Are you sure you want to Approve this request ?')">Approve</a>
                            <a href="#" class="btn btn-danger" onclick="return confirm('Are you sure you want to Disapprove this request ?')">Disapprove</a>
                        @else
                            <a href="{{route('admin.approveConsultant', [$apply->user_id] )}}" class="btn btn-success" disable>Approved</a>  
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