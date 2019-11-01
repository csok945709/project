@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        
        <div class="col-12">
               <div style="text-align:center">
                    <h1>Online Courses</h1> 
               </div>
                   
                    <div class="d-flex">
                            <select id="courseCat" class="form-control mr-3" style="width:50%;">
                                    <option selected disabled>Select a type</option>
                                        {{-- @foreach ($courseCategory as $courseCat)
                                            <option class="option" id="cat{{$courseCat->id}}" value="{{$courseCat->id}}">{{$courseCat->name}}</option>
                                        @endforeach --}}
                            </select>
                            @if (Auth::user()->organizer === 0)
                            {{-- @foreach ($OrgForm as $Orgdata) --}}
                                <a href="{{route('organizer.apply')}}" class="btn btn-danger mr-3" style="width:20%;">Apply Organizer</></a><br />  
                            @else
                                <a href="{{route('course.create')}}" class="btn btn-success mr-3" style="width:20%;">Create Course</></a><br />  
                            @endif
                            <a href="{{route('profile.indexDocument', [\Auth::user()->id])}}" class="btn btn-primary mr-3"  style="width:20%;">View My Profile</button></a>
                    </div>
                        <div id="coursesDiv">
                            @foreach ($courses as $course)
                            <div class="card col-3 mt-4 ml-5" style="display:inline-block;padding:0px !important;">
                                    <img src="/storage/{{ $course->image }}" style="width:100%;height:auto;">
                                    <div class="card-body">
                            <a href="{{ route('course.detail', [$course->user_id,$course->id]) }}" style="font-size:18px;font-weight:700;line-height:1.5">{!! $course->title !!}</a>
                            {!! str_limit($course->description,$words = 30, $end = '...') !!}<br/>
                            <i class="fas fa-dollar-sign"></i> <strong>{{$course->price}}</strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    
            </div>
</div>
@include('onlineCourses.courseCategory')
@endsection
