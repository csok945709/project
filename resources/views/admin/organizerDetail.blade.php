@extends('layouts.adminApp')

@section('content')
<div class="row container col-12">
@include('admin/sidebar')
    <div class="col-8">
        <h1 style="text-align:center">Organizer Details</h1>
        <table id="UserData" class="display">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    
                
                <tr>
                    <td>1</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                    <a href="#" class="btn btn-primary">View More</a>
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