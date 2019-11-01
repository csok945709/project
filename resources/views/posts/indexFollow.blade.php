@extends('layouts.app')

@section('content')

<div class="container">


<div class="col-7 offset-1">
        <h3 style="text-align:center;font-weight:700">Sharing Blog</h3>
        <a href="{{ route('post.index') }}" class="btn btn-primary mb-3" style="width:50%">Home</a>
        <a href="{{ route('post.indexFollow') }}" class="btn btn-success mb-3" style="width:49%">Following</a>
</div>

    <div class="row">  
        <div class="col-7 offset-1 ">
                @foreach ($postsFollow as $post)

                <div class="container card mb-3">
                    <div class="card-body">
                        <div class="col-7" style="height:150px">
                            <a href="{{ route('post.show', [$post->user_id,$post->id]) }}" style="font-size:18px;font-weight:700;line-height:1.5">{!! $post->caption !!}</a>    
                            <div style="color:#999;margin:0 0 8px;font-size:13px;line-height:24px">{!! str_limit($post->description,$words = 100, $end = '...') !!}</div>
                       </div>
                       <div class="col-1">
                            <img src="/storage/{{ $post->image }}" style="position:absolute;top:50%;margin-top:-140px;left:380px;width:200px;height:150px;">
                       </div>
                       <div class="d-flex">   
                            <div class="pr-4"><strong >23</strong> Likes</div>
                            <div class="pr-4"><strong >23K</strong> Viewers</div>
                            {{-- <like-button post-id="{{ $post->id }}"  ></like-button> --}}
                            {{-- likes="{{ $likes }}" --}}
                            <div>
                                <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle" style="max-width:25px;">
                                <a href="{{ route('profile.index', [$post->user->id]) }}" style="text-decoration:none"><strong style="font-size:12px;"> {{ $post->user->username }} </strong></a>
                            </div>
                        </div>    
                    </div>
                </div>
                @endforeach
        </div>
            <div class="col-3">
                <div class="card  mb-2">
                        <div class="card-body">
                            Search Post
                            <input type="text" class="form-control mb-2">
                        </div>
                </div>    
                <div class="card">
                <div class="card-body">
                    <div style="border-bottom: 1px solid #999;text-align:center;" class="mb-2">
                        <strong style="font-weight:600;font-size:25px;">My Profile</strong>
                    </div>
                    <img src="{{ \Auth::user()->profile->profileImage() }}" class="rounded-circle mb-2" style="max-width:50px">
                    <a href="{{ route('profile.index', [\Auth::user()->id]) }}" style="text-decoration:none"><strong style="font-size:20px;"> {{ \Auth::user()->username }} </strong></a>
                    <a href="{{route('post.create')}}"><button class="btn btn-success mb-2" style="width:100%;border-radius:4px;">Write Blog</button></a><br />
                    <a href="{{route('profile.index', [\Auth::user()->id])}}"><button class="btn btn-primary"  style="width:100%;border-radius:4px;">View My Profile</button></a>
                    </div>
                </div>     
            </div>
            
       
        {{ $postsFollow->links() }}
    </div>
</div>
@endsection