@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-7 mr-3">
            <div class="card">
                <div class="card-body">
                    <div style="float: right;margin-right:5px;">
                        <strong style="font-size:28px;font-weight:900">{{ $document->caption }}</strong> 
                        @can('update', $document->user->profile)
                            <a href="{{route('document.delete',[$user->id, $document->id])}}" class="btn btn-danger" style="float: right;color:white;" onclick="return confirm('Are you sure you want to delete this post?')">Delete Document</a>
                            <a href="{{route('document.edit',[$user->id, $document->id])}}" class="btn btn-success ml-3" style="float: right;color:white;margin-right:8px;">Edit Document</a>
                        @endcan
                        <div class="d-flex ">   
                            <div class="pr-4"><strong >{{ $document->created_at }}</strong> </div>
                            <div class="pr-4"><strong >0</strong> Reviews</div>
                            <div class="pr-4"><strong >1</strong> Purchased</div>          
                        </div> 
                        <hr>
                        {!! $document->description !!}

                    </div>   
                </div>
                
            </div>         

               

              
<div class="form-group required">
        <div class="col-sm-12">

           
                        
                          
                          
                         
                          
                          
                         </div>
                      </div>
             
                <div class="card mt-4">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <h3 style="text-align:center">Comment</h3>
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
                                            @if($comment->id === $rep->knowledgecomment_id)
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
                        
                        
                        @if ($document->price !== 0)
                                @if ($docCount == 1)
                                    <form id="comment-form" method="post" action="{{ route('Knowledegecomments.store', [$document->id]) }}" >
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
                                @else
                                    <form id="comment-form" method="post" action="{{ route('Knowledegecomments.store', [$document->id]) }}" >
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                                            <div style="padding: 10px;">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="comment" width="50%" placeholder="You can leave the comment after purchased..." readonly></textarea>
                                                </div>
                                            </div>
                                    </form>
                                @endif
                        @else
                            <form id="comment-form" method="post" action="{{ route('Knowledegecomments.store', [$document->id]) }}" >
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
                        @endif

                        
                    </div>
                </div> 
        </div> 
    </div>
        <div class="col-4">
            <div class="card mb-3">
                    <div class="card-body">
                            <follow-button user-id="{{ $document->user->id }}" follows="{{ $follows }}"></follow-button>
                            <img src="{{ $document->user->profile->profileImage() }}" class="rounded-circle" style="max-width:50px;">
                            <a href="{{ route('profile.indexDocument', [$document->user->id]) }}" style="text-decoration:none"> <strong style="font-size:18px;"> {{ $document->user->username }} </strong></a>
                                    <div class="d-flex">   
                                    {{-- <div class="pr-4"><strong >{{ $user->document->count() }}</strong> Posts</div> --}}
                                    <div class="pr-4"><strong >23K</strong> Followers</div>
                                    <div class="pr-4"><strong >212</strong> Following</div>
                                </div>    
                        </div>
            </div>
            
   
        <div class="card">
            <div class="card-body">
                <?php $path_parts = pathinfo($document->document );
                if ($path_parts['extension'] == "doc") {
                    echo '<img src="/storage/document/docx.png" style="width:100px;height:auto;float: right;margin-top:5px;" />';
                    
                } elseif ($path_parts['extension'] == "pdf") {
                    echo '<img src="/storage/document/pdf.png" style="width:100px;height:auto;" />';
                } elseif ($path_parts['extension'] == "docx") {
                    echo '<img src="/storage/document/docx.png" style="width:100px;height:auto;margin-top: 20px;" />';
                }
                ?> 
                @if ($document->price !== 0)
                    @if ($docCount == 1)
                            @if ($document->id === $docIdCheck->document_id && Auth::user()->id === $payerId->buyer_id)
                                    {{-- Payed Can download --}}
                                    <a href="{{ route('document.download', [Auth::user()->id,$document->id]) }}" class="btn btn-success" style="color:white;text-decoration:none;cursor:pointer;width:130px;">Download Now</a>
                                @else
                                    {{-- Need Pay --}}
                                    <h5 style="font-size:16px;font-weight:700;padding-top:15px;">Price: Rm {{$document->price }}</h5>
                                    <img src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-200px.png" border="0" alt="PayPal Logo"></a>
                                    <a href="{{ route('payment',[$document->id]) }}" class="btn btn-success">Pay Paypal</a>
                                @endif
                    @else
                        {{-- Need Pay --}}
                        <h5 style="font-size:16px;font-weight:700;padding-top:15px;">Price: Rm {{$document->price }}</h5>
                        <img src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-200px.png" border="0" alt="PayPal Logo"></a>
                        <a href="{{ route('payment',[$document->id]) }}" class="btn btn-success">Pay Paypal</a>
                    @endif
                @else
                    {{-- No price --}}
                    <a href="{{ route('document.download', [Auth::user()->id,$document->id]) }}" class="btn btn-success" style="color:white;text-decoration:none;cursor:pointer;width:130px;">Download Now</a>
                @endif
            </div>
  
    </div>
    <div class="card mt-3">
        <div class="card-body">
           <h2 style="text-align:center">Reviews</h2>
           <hr>
           <div>
                
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
        
                
                <strong style="font-size:20px">{{ $ratingAve}}</strong>
                <div class="ml-2" style="text-align:center"><i class="fa fa-users" aria-hidden="true" style="font-size:35px;"></i><strong style="font-size:15px">{{ $ratingCount}} Person</strong></div>
        </div>

          <h2 style="text-align:center" class="mt-3">User Rating</h2>
           <hr>       
           <form class="form-horizontal" action="{{route('documentStar', $document->id)}}" id="addStar" method="POST">
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

<script src="{{ asset('/js/Knowledge.main.js') }}"></script>
@endsection
