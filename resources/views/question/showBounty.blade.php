@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-7 mr-3">
            <div class="card">
                <div class="card-body">
                    @can('update', $questionData->user->profile)
                        <a href="{{route('question.delete',[$questionData->user_id , $questionData->user->id])}}" class="btn btn-danger" style="float: right;color:white;" onclick="return confirm('Are you sure you want to delete this post?')">Delete Question</a>
                        <a href="{{route('question.edit',[$questionData->user->id, $questionData->id])}}" class="btn btn-success" style="float: right;color:white;margin-right:8px;">Edit Question</a>
                    @endcan
                    <strong style="font-size:28px;font-weight:900">{{ $questionData->question_caption }}</strong> 
                    <div style="float: right;font-size:30px;color:red;margin-left: 28%">
                        <span style="font-weight:600">Reward </span><i class="fa fa-usd" aria-hidden="true"></i>
                        <strong class="pl-2">{{ $questionData->reward }}</strong>
                    </div>
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
                                               
                                                    <span class="mr-2 mb-3">
                                                        <img src="{{ $answer->user->profile->profileImage() }}" class="rounded-circle" style="max-width:25px;">
                                                        <i><b> {{ $answer->name }} </b></i>&nbsp;&nbsp;
                                                    </span>
                                                
                                                     {{ $answer->answer }} 
                                                
                                                    <div style="margin-left:10px;margin-top:10px;">
                                                        @foreach ($rewards as $reward)
                                                            @if (!empty($reward))
                                                                @if ($reward->reward_user == $answer->user_id)
                                                                    <strong  class="btn btn-success" style="float: right;" diasble>Best Answer</strong>
                                                                @endif
                                                            @else
                                                                <a href="{{ route('question.rewardAnswer', [$answer->user->id, $answer->id, $questionData->id]) }}" class="btn btn-primary" style="float: right;">Select as Best Answer</a>
                                                            @endif   
                                                        @endforeach
                                                         
                                                    
                                                            <a style="cursor: pointer;font-weight:600;" cid="{{ $answer->id }}" name_a="{{ Auth::user()->username }}" token="{{ csrf_token() }}" class="reply">Reply</a>&nbsp;
                                                            <a style="cursor: pointer;font-weight:600;"  class="delete-comment" token="{{ csrf_token() }}" comment-did="{{ $answer->id }}">Delete</a>
                                                            {{ $answer->updated_at }} 
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
                                       
                                        <hr style="margin-top:30px">
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
                                                    <input type="submit" class="btn btn-primary" style="width: 100%" name="submit" value="Post Your Answer">
                                                </div>
                                            </div>
                                        </form>
                                </div>
                        
                    </div>
                </div>  
        </div> 
   
        <div class="col-4 card h-100">
            <div class="card-body">
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
