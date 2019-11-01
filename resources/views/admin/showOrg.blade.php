@extends('layouts.adminApp')

@section('content')


    <div class="container">
        <h1>ID SHow</h1>
        <h3>Name: {{ $orgApply->name }}</h3>
        <h3>Experience: {{$orgApply->experience }}</h3>
        <h3>Working Years: {{ $orgApply->workyears }}</h3>
                  
                 
        <a href="{{ route('admin.index') }}" class="btn btn-primary">Back to Index</a>
            @if ($orgApply->status == 0)
                <a href="{{route('admin.approve', [$orgApply->user_id] )}}" class="btn btn-primary">Approve</a>
            @else
                <a href="{{route('admin.approve', [$orgApply->user_id] )}}" class="btn btn-success" disabled>Approved</a>  
            @endif
        <a href="#" class="btn btn-danger">Ban User</a>
                   
    </div>
   
@endsection




