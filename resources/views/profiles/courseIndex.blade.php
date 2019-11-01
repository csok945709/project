@extends('layouts.app')

@section('content')




<div class="container">
@include('profiles.profile')  

    
<div class="col-12">
    <h3 style="text-align:center;font-weight:700">Manage My Course</h3>
    <a href="{{ route('profile.indexForum',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Consultant</a>

    <a  href="{{ route('profile.indexCourse',[$user->id]) }}"  id="courseHover" class="btn btn-primary mb-3" style="width:19%">My Course</a>
        

    <a  href="{{ route('profile.index',[$user->id]) }}"  class="btn btn-primary mb-3" style="width:19%">Sharing Blog</a>
    <a href="{{ route('profile.indexDocument',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Knowledge Mine</a>
    <a href="{{ route('profile.indexForum',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Bounty Q&A</a>
    

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav" style="margin-left:30%">
                <a class="nav-item nav-link active" href="{{ route('profile.viewApply', [$user->id]) }}" style="font-weight:600;font-size:16px" >Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="#" style="font-weight:600;font-size:16px">Features</a>
                <a class="nav-item nav-link" href="#" style="font-weight:600;font-size:16px">Pricing</a>
              </div>
            </div>
          </nav>
{{-- @can('update', $user->profile)
<a href="{{route('document.create')}}" class="btn btn-primary mb-2 mt-3" style="margin-left: 85%;">Create New Course</a>
@endcan  --}}
</div>
<div class="row">  
    @foreach ($courses as $course)
        <div class="container card mb-3">
            <div class="card-body">  
            <img src="/storage/{{ $course->image }}" style="width:200px;height:125px;float: right;margin-top:20px;">
            <a href="{{ route('post.show', [$user->id,$course->id]) }}" style="font-size:18px;font-weight:700;line-height:1.5">{!! $course->caption !!}</a>    
                <div style="color:#999;margin:0 0 8px;font-size:13px;line-height:24px">{!! str_limit($course->description,$words = 100, $end = '...') !!}</div>
                <a href="{{route('post.edit',[$user->id, $course->id])}}" class="btn btn-success" style="color:white;margin-right:8px;">Edit Post</a>
                <a  href="{{ route('post.delete', [ $user->id, $course->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')" >Delete</a>
            </div>
        </div>
    @endforeach
</div>
</div>

@endsection
