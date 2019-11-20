@extends('layouts.app')

@section('content')

<div class="container">


<div class="col-7 offset-1">
        <h3 style="text-align:center;font-weight:700">Question Forum</h3>
    <a  href=""  class="btn btn-primary mb-3" style="width:50%">Question</a>
    <a href=""  class="btn btn-success mb-3" style="width:49%">Bounty Question</a>
</div>

    <div class="row">  
        <div class="col-7 offset-1 ">
                
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