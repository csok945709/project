@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
        <form action="/p/{{ $user->id }}/{{$post->id}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PATCH')
                <div class="row">
                    <h1>Edit Posts</h1>
                </div>
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Post Caption</label>                 
                        <input id="caption" 
                               type="text" 
                               class="form-control @error('caption') is-invalid @enderror" 
                               value="{{ old('caption') ?? $post->caption }}" 
                               name="caption" 
                                autocomplete="caption" autofocus>
                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Post Description</label>            
                        <textarea id="description" 
                               type="text" 
                               class="form-control @error('description') is-invalid @enderror" 
                               value="{!! old('description', $post->description) !!}" 
                               name="description" 
                                autocomplete="description" autofocus>{!!  old('description', $post->description) !!}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Post Image</label>                      
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row pt-3">
                    <button onclick="return confirm('Are you sure you want to update this post?')" class="btn btn-primary"  >Update Information</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>

<script type="text/javascript">
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}'
    });
    
</script>
@stop