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
                        <a href="{{ route('profile.index', [$course->user_id]) }}" style="text-decoration:none"> <strong style="font-size:18px;"> {{ $course->user->username }} </strong></a>
                                {{-- <div class="d-flex">   
                                <div class="pr-4"><strong >2</h2> Posts</div>
                                <div class="pr-4"><strong >23K</strong> Followers</div>
                                <div class="pr-4"><strong >212</strong> Following</div>
                            </div>     --}}
                            <hr>
                            {{$course->user->profile->description}}
                    </div>
            </div>
            @if ($course->user->id !== Auth::user()->id)
            <div class="card">
                <div class="card-body">
                        <h4 style="text-align:center;font-weight:600;">Register Now</h4>
                        <hr>
                         
                    @if ($courseRegCheck !== 0)
                        @if ($courseRegCheck->course_id == $course->id && $courseRegCheck->user_id == Auth::user()->id && $courseRegCheck->status == true) 
                            <strong style="font-size:20px;color:green" class="ml-5">Register Success </strong><i class="fa fa-check" style="font-size:30px;color:green"></i>
                            <hr>
                            <a href="{{ route('course.cancelRegister', [$user, $course->id]) }}" class="btn btn-danger ml-5" style="width:65%" onclick="return confirm('Are you sure you want to cancel this course register ?')">Cancel Register</a>
                            @else
                        <div style="text-align:center;">  
                            @if ($course->price !== 0)
                                @if ($courseCount == 1)
                                    @if ($course->id === $courseIdCheck->course_id && Auth::user()->id === $payerId->buyer_id &&  $courseRegCheck->status == true)
                                        <strong>Register Success</strong>
                                        <hr>
                                        <a href="{{ route('course.cancelRegister', [$user, $course->id]) }}" class="btn btn-danger ml-5" style="width:65%" onclick="return confirm('Are you sure you want to cancel this course register ?')">Cancel Register</a>
                                    @endif
                                @else
                                    <strong style="font-size:28px;font-weight:900;">RM {{ $course->price }}</strong><br/>
                                    {{-- Need Pay --}}
                                    <a href="{{ route('coursePayment.payment',[$course->id]) }}" class="btn btn-success mb-2">Pay Paypal</a>
                                @endif
                                
                        @else
                                <a href="{{ route('course.register', [Auth::user()->id, $course->id]) }}" class="btn btn-success">Register Now</a>
                        @endif
                        </div>
                        @endif 
                    @else
                        <div style="text-align:center;">  
                            @if ($course->price !== 0)
                                @if ($courseCount == 1)
                                    @if ($course->id === $courseIdCheck->course_id && Auth::user()->id === $payerId->buyer_id && $courseRegCheck->status == true)
                                        <strong>Register Success</strong>
                                        <hr>
                                        <a href="{{ route('course.cancelRegister', [$user, $course->id]) }}" class="btn btn-danger ml-5" style="width:65%" onclick="return confirm('Are you sure you want to cancel this course register ?')">Cancel Register</a>
                                    @endif
                                @else
                                    <strong style="font-size:28px;font-weight:900;">RM {{ $course->price }}</strong><br/>
                                    {{-- Need Pay --}}
                                    <a href="{{ route('coursePayment.payment',[$course->id]) }}" class="btn btn-success mb-2">Pay Paypal</a>
                                @endif
                                
                        @else
                                <a href="{{ route('course.register', [Auth::user()->id, $course->id]) }}" class="btn btn-success">Register Now</a>
                        @endif
                        </div>
                    @endif
                    </div>
        </div>
            @endif
            <div class="card mt-3">
                    <div class="card-body">
                       <h2 style="text-align:center">Reviews</h2>
                       <hr>
                       @if ($ratingAve < 5.00)
                       @if($ratingAve == 0.00)  
                       <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       @elseif($ratingAve == 1.00)  {{-- Rating = 1 --}}
                       <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>  
                       @elseif ($ratingAve >= 1.01 && $ratingAve <= 1.99)  {{-- Rating = 1.5 --}}
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-half-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i> 
                       @elseif ($ratingAve == 2.00)  {{-- Rating = 2 --}}
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i> 
                       @elseif ($ratingAve >= 2.01 && $ratingAve <= 2.99)  {{-- Rating = 2.5 --}}
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-half-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i> 
                       @elseif ($ratingAve == 3.00)  {{-- Rating = 3 --}}
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i> 
                       @elseif ($ratingAve >= 3.01 && $ratingAve <= 3.99)  {{-- Rating = 3.5 --}}
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-half-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i> 
                       @elseif ($ratingAve == 4)  {{-- Rating = 4 --}}
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i> 
                       @elseif ($ratingAve >= 4.01 && $ratingAve <= 4.99)  {{-- Rating = 4.5 --}}
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                           <i class="fa fa-star-half-o" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i> 
                       @endif
                   @else
                       {{-- Rating = 5 --}}
                       <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                       <i class="fa fa-star" aria-hidden="true" style="color:#e74c3c;font-size:30px;padding:8px"></i>
                   @endif
           
                   
                   <strong style="font-size:20px">{{ $ave }}</strong>
                   <div class="ml-2" style="text-align:center"><i class="fa fa-users" aria-hidden="true" style="font-size:35px;"></i><strong style="font-size:15px">{{ $ratingCount}} Person</strong></div>
           </div>
            
                      <h2 style="text-align:center" class="mt-3">User Rating</h2>
                       <hr>       
                       <form class="form-horizontal" action="{{route('courseStar', $course->id)}}" id="addCourseStar" method="POST">
                        {{ csrf_field() }}
                              <div class="form-group required">
                                <div class="col-sm-12">
                                  <input class="star star-5" value="5" id="star-5" type="radio" name="star"/>
                                  <label class="star star-5" for="star-5"></label>
                                  <input class="star star-4" value="4" id="star-4" type="radio" name="star"/>
                                  <label class="star star-4" for="star-4"></label>
                                  <input class="star star-3" value="3" id="star-3" type="radio" name="star"/>
                                  <label class="star star-3" for="star-3"></label>
                                  <input class="star star-2" value="2" id="star-2" type="radio" name="star"/>
                                  <label class="star star-2" for="star-2"></label>
                                  <input class="star star-1" value="1" id="star-1" type="radio" name="star"/>
                                  <label class="star star-1" for="star-1"></label>
                                 </div>
                              </div>
                      </form>
                      
                      
                    </div>
            </div>
        </div>

    
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('/js/course.main.js') }}"></script>
@stop