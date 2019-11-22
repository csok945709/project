@extends('layouts.app')

@section('content')

<div class="container">
        @include('profiles.profile')  
   

    
<div class="col-12">
    <h3 style="text-align:center;font-weight:700">Manage</h3>
    <a href="{{ route('profile.indexForum',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Consultant</a>
    <a  href="{{ route('profile.viewApply', [$user->id]) }}"  class="btn btn-primary mb-3" style="width:19%">My Course</a>
    <a  href="{{ route('profile.index',[$user->id]) }}"  class="btn btn-primary mb-3" style="width:19%">Sharing Blog</a>
    <a href="{{ route('profile.indexDocument',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Knowledge Mine</a>
    <a href="{{ route('profile.indexQuestion',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Bounty Q&A</a>
    
@can('update', $user->profile)
<a href="{{route('post.create')}}" class="btn btn-primary mb-2" style="margin-left: 88%;">Ask New Question</a>
@endcan 
</div>
<div class="row">  
        @foreach ($user->posts as $post)
            <div class="container card mb-3">
                <div class="card-body">  
                <img src="/storage/{{ $post->image }}" style="width:200px;height:125px;float: right;margin-top:20px;">
                <a href="{{ route('post.show', [$user->id,$post->id]) }}" style="font-size:18px;font-weight:700;line-height:1.5">{!! $post->caption !!}</a>    
                    <div style="color:#999;margin:0 0 8px;font-size:13px;line-height:24px">{!! str_limit($post->description,$words = 100, $end = '...') !!}</div>
                    <a href="{{route('post.edit',[$user->id, $post->id])}}" class="btn btn-success" style="color:white;margin-right:8px;">Edit Post</a>
                    <a  href="{{ route('post.delete', [ $user->id, $post->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')" >Delete</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
