@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-7 mr-3">
            <div class="card">
                <div class="card-body">
                    <strong style="font-size:28px;font-weight:900">{{ $questionData->question_caption }}</strong> 
                    {{-- @can('update', $questionData->user->profile)
                        <a href="{{route('question.delete',[$questionData->user_id , $questionData->user->id])}}" class="btn btn-danger" style="float: right;color:white;" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</a>
                        <a href="{{route('question.edit',[$questionData->user->id, $questionData->id])}}" class="btn btn-success" style="float: right;color:white;margin-right:8px;">Edit Post</a>
                    @endcan --}}
                    <div class="d-flex">   
                        <div class="pr-4"><strong >{{ $questionData->created_at }}</strong></div>
                        <div class="pr-4"><strong >989</strong> Like</div>
                        <div class="pr-4"><strong >{{ $questionData->visit_count }}</strong> Viewers</div>  
                    </div> 
                        <div class="mt-2">
                            {!! $questionData->question_content !!}
                        </div>
                </div>
            </div>         
                <div class="card mt-4">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <h3 style="text-align:center">Answer</h3>
                            <hr> 
                            <div class="comment-container">   
                                    @foreach($answers as $answer)
                                        <div class="well">
                                                <img src="{{ $answer->user->profile->profileImage() }}" class="rounded-circle" style="max-width:25px;">
                                                <i><b> {{ $answer->name }} </b></i>&nbsp;&nbsp;
                                                <span> {{ $answer->answer }} </span>
                                                <div style="margin-left:10px;">
                                                        <a style="cursor: pointer;" cid="{{ $answer->id }}" name_a="{{ Auth::user()->username }}" token="{{ csrf_token() }}" class="reply">Reply</a>&nbsp;
                                                        <a style="cursor: pointer;"  class="delete-comment" token="{{ csrf_token() }}" comment-did="{{ $answer->id }}">Delete</a>
                                                        <div class="reply-form">
                                                    <!-- Dynamic Reply form -->                                   
                                                </div>
                                                    @foreach($replies as $rep)
                                                        @if($answer->id === $rep->questionanswer_id)
                                                            <div class="well ml-3">
                                                                    <i><b> {{ $rep->name }} </b></i>&nbsp;&nbsp;
                                                                    <span> {{ $rep->reply }} </span>
                                                                <div style="margin-left:10px;">
                                                                <a rname="{{ Auth::user()->username }}" userId="{{ Auth::user()->id}}"  rid="{{ $answer->id }}" style="cursor: pointer;" class="reply-to-reply" token="{{ csrf_token() }}">Reply</a>&nbsp;
                                                                <a did="{{ $rep->id }}" class="delete-reply" token="{{ csrf_token() }}" style="cursor: pointer;" onclick="return confirm('Are you sure you want to delete this reply?')">Delete</a>
                                                                    </div>
                                                                <div class="reply-to-reply-form">
                                                        
                                                                    <!-- Dynamic Reply form -->
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                                        @endif 
                                                    @endforeach
                                                </div>
                                       
                                        <hr>
                                    </div>
                                    @endforeach
                                
                                    <form id="comment-form" method="post" action="{{ route('questionAnswer.store', [$questionData->id]) }}" >
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                                            <div style="padding: 10px;">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="answer" width="50%" placeholder="Leave Some Answer..."></textarea>
                                                </div>
                                            </div>
                                            <div style="padding: 0 10px 0 10px;">
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary" style="width: 100%" name="submit">
                                                </div>
                                            </div>
                                        </form>
                                </div>
                        
                    </div>
                </div>  
        </div> 
   
        <div class="col-4 card h-100">
            <div class="card-body">
                <h1 style="text-align:center;">About the Author</h1>
                <hr>
                <follow-button user-id="{{ $questionData->user->id }}" follows="{{ $follows }}"></follow-button>
                <img src="{{ $questionData->user->profile->profileImage() }}" class="rounded-circle" style="max-width:50px;">
                <a href="{{ route('profile.index', [$questionData->user_id, $questionData->user->id]) }} }}" style="text-decoration:none"> <strong style="font-size:18px;"> {{ $questionData->user->username }} </strong></a>
                        <div class="d-flex">   
                        <div class="pr-4"><strong >12</strong> Posts</div>
                        <div class="pr-4"><strong >23K</strong> Followers</div>
                        <div class="pr-4"><strong >212</strong> Following</div>
                    </div>    
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/Question.main.js') }}"></script>
@endsection
