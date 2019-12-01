@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        
        <div class="col-12">
               <div style="text-align:center">
                    <h1>Online Consultant</h1> 
               </div>
              
                    <div class="d-flex">
                        <select id="courseCat" class="form-control mr-3" style="width:50%">
                            <option selected disabled>Select a type</option>
                            @foreach ($courseCategory as $courseCat)
                                <option class="option" id="cat{{$courseCat->id}}" value="{{$courseCat->id}}">{{$courseCat->name}}</option>
                            @endforeach
                        </select>
                        @if (Auth::user()->consultant == false)
                            @if ($consultant_applies->isEmpty())
                                <a href="{{route('consultant.apply')}}" class="btn btn-danger mr-3" style="width:20%;">Apply Consultant</a>
                            @else
                                @foreach ($consultant_applies as $consultant_applie)
                                    @if ($consultant_applie->user_id == Auth::user()->id)
                                        <a href="{{route('consultant.apply')}}" class="btn btn-danger mr-3" style="width:20%;">Edit Apply</a>
                                    @endif
                                @endforeach
                            @endif     
                        @else
                            <a href="{{ route('consultant.show', Auth::user()->id) }}" class="btn btn-success mr-3"  style="width:20%;">Manage Consultant Profile</a>   
                        @endif
                    <a href="{{ route('profile.bookAppointmentTime', Auth::user()->id )}}" class="btn btn-primary mr-3"  style="width:20%;">View My Profile</a>
                    </div>
                 
                    
                            <div class="ml-10">
                                
                                    @foreach ($consulantID as $consulantid)
                                        
                                            @foreach ($profiles as $profile)
                                            @if ($profile->user_id === $consulantid->id)
                                                <div class="card col-3 mt-4 ml-5" style="display:inline-block;padding:0px !important;">
                                                        <img src="{{ $profile->profileImage() }}" style="width:50%;margin-left:25%;">
                                                    <div class="card-body">
                                                        <a href="{{ route('consultant.show', [$profile->id]) }}" style="font-size:18px;font-weight:700;line-height:1.5;text-decoration:none;color:black;">{!! $profile->user->username !!}</a>
                                                        <span style="font-size:14px;font-weight:600;color:grey;margin-left:2px;">Johor</span>
                                                        <i class="fas fa-map-marker-alt" style="color:grey"></i> <br/>
                                                        {!! str_limit($profile->description,$words = 30, $end = '...') !!}
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                          
                                    
                                  
                                @endforeach
                                
                            </div>
                        
                    
            </div>
      
    </div>
</div>
@include('onlineCourses.courseCategory')
@endsection
