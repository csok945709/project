@extends('layouts.app')

@section('content')

<div class="container">
@include('profiles.profile')  

    
<div class="col-12">
    <h3 style="text-align:center;font-weight:700">Manage Document</h3>
    <a href="{{ route('profile.indexForum',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Consultant</a>
    <a  href="{{ route('profile.viewApply', [$user->id]) }}"  class="btn btn-primary mb-3" style="width:19%">My Course</a>
    <a  href="{{ route('profile.index',[$user->id]) }}"  class="btn btn-primary mb-3" style="width:19%">Sharing Blog</a>
    <a href="{{ route('profile.indexDocument',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Knowledge Mine</a>
    <a href="{{ route('profile.indexForum',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Bounty Q&A</a>
    
@can('update', $user->profile)
<a href="{{route('document.create')}}" class="btn btn-primary mb-2" style="margin-left: 80%;">Upload New Document</a>
@endcan 
</div>
<div class="row">
        @foreach ($user->documents as $document)
            <div class="container card mb-3">
                <div class="card-body">  
                    <?php $path_parts = pathinfo($document->document );
                    if ($path_parts['extension'] == "doc") {
                        echo '<img src="/storage/document/docx.png" style="width:150px;height:120px;float: right;margin-top:5px;" />';
                        
                    } elseif ($path_parts['extension'] == "pdf") {
                        echo '<img src="/storage/document/pdf.png" style="width:150px;height:120px;float: right;margin-top:5px;" />';
                    } elseif ($path_parts['extension'] == "docx") {
                        echo '<img src="/storage/document/docx.png" style="width:150px;height:120px;float: right;margin-top:5px;" />';
                    }
                    ?>
                <a href="{{ route('document.show', [$user->id,$document->id]) }}" style="font-size:18px;font-weight:700;line-height:1.5">{!! $document->caption !!}</a>    
                    <div style="color:#999;margin:0 0 8px;font-size:13px;line-height:24px">{!! str_limit($document->description,$words = 100, $end = '...') !!}</div>
                    <a href="{{route('post.edit',[$user->id, $document->id])}}" class="btn btn-success" style="color:white;margin-right:8px;">Edit Post</a>
                    <a  href="{{ route('post.delete', [ $user->id, $document->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')" >Delete</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
