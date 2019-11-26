@extends('layouts.adminApp')

@section('content')
<h1 style="text-align:center">Organizer Request</h1>
<div class="row container col-12">
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
                    <td>1</td>
                    <td>{{ $apply->name }}</td>
                    <td>{{$apply->experience }}</td>
                    <td>{{ $apply->workyears }}</td>
                    <td>@if ( $apply->status == 0)
                        Pending
                    @else
                        Approved
                    @endif</td>
                    <td>
                    <a href="{{ route('admin.showOrg', [$apply->user_id]) }}" class="btn btn-primary">View More</a>
                            @if ($apply->status == 0)
                                <a href="{{route('admin.approve', [$apply->user_id] )}}" class="btn btn-primary">Approve</a>
                            @else
                                <a href="{{route('admin.approve', [$apply->user_id] )}}" class="btn btn-success" disable>Approved</a>  
                            @endif
                        <a href="#" class="btn btn-danger">Ban User</a>
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
        $('#UserData').DataTable();
    } );
    </script>
@stop