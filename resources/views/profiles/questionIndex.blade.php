@extends('layouts.app')

@section('content')

<div class="container">
@include('profiles.profile')  

    
<div class="col-12">
    <h3 style="text-align:center;font-weight:700">Manage Question</h3>
    <a href="{{ route('profile.consultantTime',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Consultant</a>
    <a  href="{{ route('profile.viewApply', [$user->id]) }}"  class="btn btn-primary mb-3" style="width:19%">My Course</a>
    <a  href="{{ route('profile.index',[$user->id]) }}"  class="btn btn-primary mb-3" style="width:19%">Sharing Blog</a>
    <a href="{{ route('profile.indexDocument',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Knowledge Mine</a>
    <a href="{{ route('profile.indexQuestion',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Bounty Q&A</a>
@can('update', $user->profile)
    <div>
        <strong style="color:red; font-size:20px">*Remark: Bounty Question should pay before post on the forum</strong>
        <a href="{{route('document.create')}}" class="btn btn-primary mb-2" style="margin-left:21%">Create New Question</a>
    </div>
    
@endcan 

</div>
<div class="row">
        @foreach ($user->questions as $question)
            <div class="container card mb-3" @if ($question->paid !== 1)
                style="background: #f2f2f2;"
            @else
                style="background: white;"
            @endif>
                <div class="card-body">  
                    @if ($question->question_type == 1)  
                        @if ($question->question_type == 1 && $question->paid == 1)
                            <strong style="float: right;color: green;font-size:25px">Paid</strong> 
                        @else
                            <div style="float: right;"> 
                                <strong style="color: red;font-size:25px">Pending to Pay</strong><br>
                                <a href="{{ route('questionPayment.payment',[$question->id]) }}"  class="btn btn-primary mt-2 ml-5" style="width:75%">PayPal Now</a><br>
                                <a href="{{ route('question.edit', [$user->id, $question->id]) }}" class="btn btn-danger mt-2 ml-5" style="width:75%">Remove Bounty</a>
                            </div>
                        @endif
                    @else
                        <strong style="float: right;color: green;font-size:25px">Free Question</strong>      
                          
                    @endif
                <a href="{{ route('question.show', [$user->id,$question->id]) }}" style="font-size:18px;font-weight:700;line-height:1.5">{!! $question->question_caption !!}</a>    
                    <div style="color:#999;margin:0 0 8px;font-size:13px;line-height:24px">{!! str_limit($question->question_content,$words = 100, $end = '...') !!}</div>
                    <a href="{{ route('question.edit', [$user->id, $question->id]) }}" class="btn btn-success" style="color:white;margin-right:8px;">Edit Post</a>
                    <a  href="{{ route('question.delete', [ $user->id, $question->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')" >Delete</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
