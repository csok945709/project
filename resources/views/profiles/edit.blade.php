@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PATCH')
                <div class="row">
                    <h1>Edit Profile</h1>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Title</label>                 
                        <input id="title" 
                               type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title') ?? $user->profile->title }}" 
                               name="title" 
                                autocomplete="title" autofocus>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Description</label>                 
                        <input id="description" 
                               type="text" 
                               class="form-control @error('description') is-invalid @enderror" 
                               value="{{ old('description') ?? $user->profile->description }}" 
                               name="description" 
                                autocomplete="description" autofocus>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Edit Profile Image</label>                      
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label">Url</label>                 
                        <input id="url" 
                               type="text" 
                               class="form-control @error('url') is-invalid @enderror" 
                               value="{{ old('url') ?? $user->profile->url }}" 
                               name="url" 
                                autocomplete="url" autofocus>
                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row pt-3">
                    <button class="btn btn-primary" onclick="return confirm('Are you sure you want to update the profile?')">Update Information</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}} "></script>
<script>
    CKEDITOR.replace( 'article-ckeditor' );
</script>
@endsection