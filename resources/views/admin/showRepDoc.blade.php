@extends('layouts.adminApp')

@section('content')


    <div class="container">
        <div class="card">
            <div class="card-body">
                    <div style="float:right;">
                            <span style="font-size:18px;font-weight:600;">Published By: </span>
                            <img src="{{ $profile->profileImage() }}" class="rounded-circle" style="width:50px;">
                            <span  style="font-size:18px;font-weight:600;">{{ $profile->title}} </span>
                    </div>
                    <h1  style="text-align:center">Document "<span style="color:red">{{$repDoc->caption}}</span>"  Details</h1>
                   
                    <hr>
                    <div class="row" style="margin-left:20%">
                            <?php $path_parts = pathinfo($repDoc->document );
                            if ($path_parts['extension'] == "doc") {
                                echo '<img src="/storage/document/docx.png" />';
                                
                            } elseif ($path_parts['extension'] == "pdf") {
                                echo '<img src="/storage/document/pdf.png" />';
                            } elseif ($path_parts['extension'] == "docx") {
                                echo '<img src="/storage/document/docx.png" style="width:150px" />';
                            }
                            ?>  
                            <h1 class="ml-5 mt-5"><span style="font-weight:600">Caption:</span> {{$repDoc->caption}}</h1>

                    </div>
                            <div style="text-align:center">
                              
                                        
                                          
                               
                                   
                                    <h1 style="font-weight:600">Description</h1>
                                    <hr>
                                    {!! $repDoc->description !!}
                            </div>
                      
                   
            
    
                    
                    
                <div class="mt-3">
                    <a href="{{ route('admin.reportDocument') }}" class="btn btn-secondary">Back to Index</a>
                    <a href="{{ route('admin.adminDocDownload', [$repDoc->id]) }}" class="btn btn-success" style="color:white;text-decoration:none;cursor:pointer;width:130px;">Download Now</a>
                    
                </div>
            </div>
        </div>
                   
    </div>
   
@endsection




