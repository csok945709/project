@extends('layouts.app')

@section('content')

<div class="container">


<div class="col-7 offset-1">
    <h3 style="text-align:center;font-weight:700">Question Forum</h3>
    <a  href="{{ route('question.index') }}"  class="btn btn-primary mb-3" style="width:50%">Question</a>
    <a href="{{ route('question.indexBounty') }}"  class="btn btn-success mb-3" style="width:49%">Bounty Question</a>
</div>

    <div class="row">  
        <div class="col-7 offset-1 ">
            @if (!empty($questionsBounty))
                @foreach ($questionsBounty as $question)
                <div class="container card mb-3">
                    <div class="card-body">
                       
                            @if ($rewards->isEmpty())
                                <div style="float: right;font-size:30px;color:red"><span style="font-weight:600">Reward </span><i class="fa fa-usd" aria-hidden="true"></i><strong class="pl-2">{{ $question->reward }}</strong></div>
                                @else
                                @foreach ($rewards as $reward)
                                    @if ($reward->question_id == $question->id && $question->solved == true)
                                        <div style="float: right;"><strong  class="btn btn-success" style="float: right;" diasble>Solved Question</strong></div>
                                    @else 
                                        <div style="float: right;font-size:30px;color:red"><span style="font-weight:600">Reward </span><i class="fa fa-usd" aria-hidden="true"></i><strong class="pl-2">{{ $question->reward }}</strong></div>
                                    @endif
                            @endforeach
                            @endif
                       
                        <div class="col-7" style="height:150px">
                            <a href="{{ route('question.show', [$question->user_id,$question->id]) }}" style="font-size:18px;font-weight:700;line-height:1.5">{!! $question->question_caption !!}</a>    
                            <div style="color:#999;margin:0 0 8px;font-size:13px;line-height:24px">{!! str_limit($question->question_content,$words = 100, $end = '...') !!}</div>
                    </div>
                    <div class="d-flex">   
                            <div class="pr-4"><strong >123</strong> Likes</div>
                    <div class="pr-4"><strong >{{ $question->visit_count }}</strong> Viewers</div>
                            {{-- <like-button post-id="{{ $question->id }}"  ></like-button> --}}
                            {{-- likes="{{ $likes }}" --}}
                            <div>
                                <img src="{{ $question->user->profile->profileImage() }}" class="rounded-circle" style="max-width:25px;">
                                <a href="{{ route('profile.index', [$question->user->id]) }}" style="text-decoration:none"><strong style="font-size:12px;"> {{ $question->user->username }} </strong></a>
                            </div>
                        </div>   
                    </div>
                </div>
            @endforeach  
            @else
            <strong>Now no Question yet...</strong>           
        @endif   
        </div>
            <div class="col-3">
                <div class="card  mb-2">
                        <div class="card-body">
                            Search Post
                            <input type="text" name="search" id="search" class="form-control mb-2" placeholder="Search Post...">
                        </div>
                </div>    
                <div class="card">
                    <div class="card-body">
                        <div style="text-align:center;" class="mb-2">
                            <strong style="font-weight:600;font-size:22px;">My Profile</strong>
                        </div>
                        <hr>
                        <img src="{{ \Auth::user()->profile->profileImage() }}" class="rounded-circle mb-2" style="max-width:50px">
                        <a href="{{ route('profile.index', [\Auth::user()->id]) }}" style="text-decoration:none"><strong style="font-size:20px;"> {{ \Auth::user()->username }} </strong></a>
                    <a href="{{ route('question.create')}}"><button class="btn btn-success mb-2" style="width:100%;border-radius:4px;">Ask Question</button></a><br />
                        <a href="{{route('profile.index', [\Auth::user()->id])}}"><button class="btn btn-primary"  style="width:100%;border-radius:4px;">View My Question</button></a>
                    </div>
                </div>     
            </div>
            
       
    </div>
</div>
@endsection