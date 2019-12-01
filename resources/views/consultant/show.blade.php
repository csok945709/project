@extends('layouts.app')

@section('content')
<div class="container">
        <div style="text-align:center">
            <h1>Consultant  {{ $consultant->username }}</h1> 
        </div>
        <div class="row">
            <div class="col-7">       
                <div class="card">
                    <div class="card-body">
                            @if( $consultant->profile->user_id === Auth::user()->id)
                            <a href="{{route('profile.edit',[$consultant->id])}}" class="btn btn-success" style="float:right">Edit Profile</a>
                    @endif
                        <div style="float:right;margin-right:15%">
                            <h1> {{ $consultant->username }} </h1>      
                            <div class="pt-4 font-weight-bold">{{ $consultant->profile->title }} </div>
                            <div><a href="#">{{ $consultant->profile->url }} </a></div>
                        </div>
                        
                        <div style="margin-left:10%">
                            <img src="{{ $consultant->profile->profileImage() }}" class="rounded-circle" style="width:30%">  
                        </div>
                        <div class="card-body">
                            <h1 style="text-align:center">Description</h1><hr>
                                <div>{{ $consultant->profile->description }} </div>
                        </div>
                    </div>
                </div>
            </div>
           <div class="card col-3">
                <div class="card-body">
                <h3 style="font-weight:600;text-align:center">Online Chating</h3><hr>
                    <a href="{{ route('chat', [$consultant->profile->user_id ])}}" class="btn btn-primary mb-2 ml-2" style="width:90%;">Online Chating</a>
                    <a href="{{ route('consultant.viewAppointmentTime', [$consultant->id]) }}" class="btn btn-danger ml-2" style="width:90%;">View Appointment Time</a>
                </div>
           </div>
        
    </div>   
</div>
@endsection

@section('javascript')
<script src="{{ asset('/js/course.main.js') }}"></script>
@stop

