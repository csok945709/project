@extends('layouts.adminApp')

@section('content')


    <div class="container">
        <div class="card">
            <div class="card-body">
                    <div style="float:right;">
                            <span style="font-size:18px;font-weight:600;">Published By: </span>
                            <img src="{{ $profile->profileImage() }}" class="rounded-circle" style="width:50px;">
                            <span  style="font-size:18px;font-weight:600;">{{ $profile->title}} </span>
                    </div>
                    <h1  style="text-align:center">Post "<span style="color:red">{{$repPost->caption}}</span>"  Details</h1>
                    <hr>
                    <div class="row" style="margin-left:20%">
                            <img src="/storage/{{ $repPost->image }}" style="width:600px;height:400px">


                    </div>
                            <div style="text-align:center">
                                    <h1 style="font-weight:600">Description</h1>
                                    <hr>
                                    {!! $repPost->description !!}
                            </div>
                      
                   
            
    
                    
                    
                <div class="mt-3">
                    <a href="{{ route('admin.reportPost') }}" class="btn btn-secondary">Back to Index</a>
                    @if ($repPost->postStatus == 1)
                                <a href="{{route('admin.approvePostReport', [$post->id] )}}" class="btn btn-primary" onclick="return confirm('Are you sure you want to Approve and Suspend this Post ?')">Suspend Post</a>
                                <a href="#" class="btn btn-danger" onclick="return confirm('Are you sure you want to Disapprove this request ?')">Disapprove</a>
                                @else
                                <a href="#" class="btn btn-success" disable>Approved</a>  
                                <a href="{{route('admin.reactivePost', [$post->id] )}}" class="btn btn-primary" onclick="return confirm('Are you sure you want to Reactive this Post ?')">Reactived Post</a>  
                    @endif
                </div>
            </div>
        </div>
                   
    </div>
   
@endsection




