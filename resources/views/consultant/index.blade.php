@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        
        <div class="col-12">
               <div style="text-align:center">
                    <h1>Online Consultant</h1> 
               </div>
                    <select id="courseCat" class="form-control">
                    <option selected disabled>Select a type</option>
                        @foreach ($courseCategory as $courseCat)
                            <option class="option" id="cat{{$courseCat->id}}" value="{{$courseCat->id}}">{{$courseCat->name}}</option>
                        @endforeach
                    </select>
                       
                            <div class="ml-10">
                                @foreach ($courses as $course)
                                    <div class="card col-3 mt-4 ml-5" style="display:inline-block;padding:0px !important;">
                                            <img src="/storage/{{ $course->image }}" style="width:100%;height:auto;">
                                        <div class="card-body">
                                            <a href="{{ route('consultant.show', [Auth::user()->id]) }}" style="font-size:18px;font-weight:700;line-height:1.5;text-decoration:none;color:black;">{!! $course->user->name !!}</a>
                                            <span style="font-size:14px;font-weight:600;color:grey;margin-left:2px;">Johor</span>
                                            <i class="fas fa-map-marker-alt" style="color:grey"></i> <br/>
                                            {!! str_limit($course->description,$words = 30, $end = '...') !!}
                                            <div class="d-flex">
                                                <strong>225</strong>Chat &nbsp; 
                                                <strong>9.2</strong>Rating
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        
                    
            </div>
      
    </div>
</div>
@include('onlineCourses.courseCategory')
@endsection
