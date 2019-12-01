@extends('layouts.adminApp')

@section('content')
<div class="row">
@include('admin/sidebar')
    <div class="col-8">
        <h1 style="text-align:center">User Details</h1>
        <table id="UserData" class="display">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    
                
                <tr>
                    <td></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>@if ( $user->status == 1)
                            Actived
                        @else
                            Suspend
                        @endif</td>
                    <td>
                    <a href="#" class="btn btn-secondary">View More</a>
                    @if ($user->status == 1)
                        <a href="{{route('admin.banUser', [$user->id] )}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to Ban this User ?')">Ban User</a>
                    @else
                        <a href="{{route('admin.reactiveUser', [$user->id] )}}" class="btn btn-success" onclick="return confirm('Are you sure you want to Reactive this User ?')">Reactive User</a>
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