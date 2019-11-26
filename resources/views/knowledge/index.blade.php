@extends('layouts.app')

@section('content')
<div class="container">   
        <div class="row">  
            <div class="col-7 offset-1 ">
            <h3 style="text-align:center;font-weight:700">Knowledge Mine</h3>
                    <div class="card mb-2">
                        <div class="card-body">
                            <input type="text" name="search" id="search" class="form-control mb-2" placeholder="Search document...">
                        </div>
                    </div> 
            @foreach ($documents as $document)              
                    <div class="card mb-3">
                        <div class="card-body row ">
                                <div class="col-md-2" style="float: left;">
                                        <?php $path_parts = pathinfo($document->document );
                                        if ($path_parts['extension'] == "doc") {
                                            echo '<img src="/picture/docx.png" style="width:80px;height:auto;float: right;margin-top:5px;" />';
                                        } elseif ($path_parts['extension'] == "pdf") {
                                            echo '<img src="/picture/pdf.png" style="width:80px;height:auto;" />';
                                        } elseif ($path_parts['extension'] == "docx") {
                                            echo '<img src="/picture/docx.png" style="width:80px;height:auto;margin-top: 20px;" />';
                                        }
                                    ?> 
                                    </div>
                                <div class="col-md-8">
                                    <a href="{{ route('document.show', [$document->user_id,$document->id]) }}" style="font-size:18px;font-weight:700;line-height:1.5">{!! $document->caption !!}</a>    
                                    <div style="color:#999;margin:0 0 8px;font-size:13px;line-height:24px">{!! str_limit($document->description,$words = 100, $end = '...') !!}</div>
                                    
                                    <div style="">
                                        <h5 style="font-size:16px;font-weight:700;padding-top:15px;display: inline-block;padding-right:5px;">Rm {{$document->price }}</h5>
                                        <img src="{{ $document->user->profile->profileImage() }}" class="rounded-circle" style="max-width:25px;">
                                        <a href="{{ route('profile.index', [$document->user->id]) }}" style="text-decoration:none"><strong style="font-size:12px;"> {{ $document->user->username }} </strong></a>
                                    </div>
                                </div>                         
                        </div>
                    </div>               
        @endforeach
        {{ $documents->links() }}
        </div>
        <div class="col-3" style="margin-top:38px;">  
                <div class="card">
                    <div class="card-body">
                        <div style="text-align:center;" class="mb-2">
                            <strong style="font-weight:600;font-size:22px;">My Profile</strong>
                        </div>
                        <hr>
                        <img src="{{ \Auth::user()->profile->profileImage() }}" class="rounded-circle mb-2" style="max-width:50px">
                        <a href="{{ route('profile.indexDocument', [\Auth::user()->id]) }}" style="text-decoration:none"><strong style="font-size:20px;"> {{ \Auth::user()->username }} </strong></a>
                        <a href="{{route('document.create')}}"><button class="btn btn-success mb-2" style="width:100%;border-radius:4px;">Upload Document</button></a><br />
                        <a href="{{route('profile.indexDocument', [\Auth::user()->id])}}"><button class="btn btn-primary"  style="width:100%;border-radius:4px;">View My Profile</button></a>
                    </div>
                </div>     
            </div> 
                
        </div>
    </div>
@endsection