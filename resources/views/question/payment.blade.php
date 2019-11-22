@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-7 mr-3">
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
                
                                    {{-- Need Pay --}}
                                    <h5 style="font-size:16px;font-weight:700;padding-top:15px;">Price: Rm {{$document->price }}</h5>
                                    <img src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-200px.png" border="0" alt="PayPal Logo"></a>
                                    <a href="{{ route('payment',[$document->id]) }}" class="btn btn-success">Pay Paypal</a>
            </div>
  
    </div>
    </div>
</div>

<script src="{{ asset('/js/Knowledge.main.js') }}"></script>
@endsection
