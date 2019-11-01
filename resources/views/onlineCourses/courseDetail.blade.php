@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-7 mr-3">
            <div class="card">
                <div class="card-body">
                    <h2 style="text-align:center;font-weight:600">Course Detail</h2>
                    <div class="mb-4" style="text-align:center">
                        <img src="/storage/{{ $course->image }}" class=" pt-3" style="width:600px;height:400px">
                    </div>
                    <strong style="font-size:23px;">Course Name: <span style="font-size:21px;font-weight:600">{{ $course->title }}</span></strong>  <br/>
                    <strong style="font-size:23px;">Venue:  <span style="font-size:21px;font-weight:600">{{ $course->venue }}</span></strong> <br/>
                    <strong style="font-size:23px;">Staring Time: <span style="font-size:21px;font-weight:600">{{ $course->time }}</span></strong>  <br/>
                    <strong style="font-size:23px;">Date: <span style="font-size:21px;font-weight:600">{{ $course->date }}</span></strong>  <br/>
                    
                    @can('update', $course->user->profile)
                        <a href="{{route('course.delete',[$course->user_id, $course->id])}}" class="btn btn-danger" style="float: right;color:white;" onclick="return confirm('Are you sure you want to delete this post?')">Terminate Course</a>
                        <a href="{{route('course.edit',[$course->user_id, $course->id])}}" class="btn btn-success" style="float: right;color:white;margin-right:8px;">Edit Course</a>
                    @endcan

                    <h2 style="text-align:center;font-weight:600">Description</h2>
                    <hr>
                        {!! $course->description !!}
                </div>
            </div>         
                <div class="card mt-4">
                    <div class="card-body">
                            <h3 style="text-align:center">Reviews</h3>
                            <hr>          
                            <div class="comment-container">   
                                @foreach($comments as $comment)
                                    <div class="well">
                                            <i><b> {{ $comment->name }} </b></i>&nbsp;&nbsp;
                                            <span> {{ $comment->comment }} </span>
                                            <div style="margin-left:10px;">
                                                    <a style="cursor: pointer;" cid="{{ $comment->id }}" name_a="{{ Auth::user()->username }}" token="{{ csrf_token() }}" class="reply">Reply</a>&nbsp;
                                                    <a style="cursor: pointer;"  class="delete-comment" token="{{ csrf_token() }}" comment-did="{{ $comment->id }}">Delete</a>
                                                    <div class="reply-form">
                                                <!-- Dynamic Reply form -->                                   
                                            </div>
                                                @foreach($replies as $rep)
                                                    @if($comment->id === $rep->coursecomment_id)
                                                        <div class="well ml-3">
                                                                <i><b> {{ $rep->name }} </b></i>&nbsp;&nbsp;
                                                                <span> {{ $rep->reply }} </span>
                                                            <div style="margin-left:10px;">
                                                            <a rname="{{ Auth::user()->username }}" userId="{{ Auth::user()->id}}"  rid="{{ $comment->id }}" style="cursor: pointer;" class="reply-to-reply" token="{{ csrf_token() }}">Reply</a>&nbsp;<a did="{{ $rep->id }}" class="delete-reply" token="{{ csrf_token() }}" style="cursor: pointer;">Delete</a>
                                                            {{ $comment->id }}  </div>
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
                                    <form id="comment-form" method="post" action="{{ route('coursecomments.store', [$course->id]) }}" >
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                                            <div style="padding: 10px;">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="comment" width="50%" placeholder="Leave Some Comment..."></textarea>
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
        <div class="col-4 h-100">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 style="text-align:center;font-weight:600;">Organizer</h4>
                    <hr>
                        <follow-button user-id="{{ $course->user_id }}" follows="{{ $follows }}"></follow-button>
                        <img src="{{ $course->user->profile->profileImage() }}" class="rounded-circle" style="max-width:50px;">
                        <a href="{{ route('profile.index', [$course->user_id]) }} }}" style="text-decoration:none"> <strong style="font-size:18px;"> {{ $course->user->username }} </strong></a>
                                {{-- <div class="d-flex">   
                                <div class="pr-4"><strong >2</h2> Posts</div>
                                <div class="pr-4"><strong >23K</strong> Followers</div>
                                <div class="pr-4"><strong >212</strong> Following</div>
                            </div>     --}}
                            <hr>
                            {{$course->user->profile->description}}
                    </div>
            </div>
            <div class="card">
                    <div class="card-body">
                            <h4 style="text-align:center;font-weight:600;">Register Now</h4>
                            <hr>
                            @if($course->user_id !== Auth::user()->id)
                            <div style="text-align:center;">  
                            @if ($course->price !== 0)
                                @if ($courseCount == 1)
                                    @if ($course->id === $courseIdCheck->course_id && Auth::user()->id === $payerId->buyer_id)
                                        <strong>Register Success</strong>
                                    @endif
                                @else
                                    <strong style="font-size:28px;font-weight:900;">RM {{ $course->price }}</strong><br/>
                                    {{-- Need Pay --}}
                                    <a href="{{ route('coursePayment.payment',[$course->id]) }}" class="btn btn-success mb-2">Pay Paypal</a>
                                @endif
                                
                            @else
                                <strong>Register Now</strong>
                            @endif
                            </div>
                        @endif  
                        </div>
            </div>
        </div>

    
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('/js/course.main.js') }}"></script>
@stop