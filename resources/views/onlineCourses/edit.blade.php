@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
        <form action="/c/{{ $user->id }}/{{$course->id}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PATCH')
                <div class="row">
                    <h1>Edit Course Detail</h1>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Course Title</label>                 
                        <input id="title" 
                               type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title') ?? $course->title }}" 
                               name="title" 
                                autocomplete="title" autofocus>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Course Description</label>            
                        <textarea id="description" 
                               type="text" 
                               class="form-control @error('description') is-invalid @enderror" 
                               value="{!! old('description', $course->description) !!}" 
                               name="description" 
                                autocomplete="description" autofocus>{!!  old('description', $course->description) !!}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Course Image</label>                      
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row container">
                    <label style="margin-top:15px;margin-right:20px;font-size:16px;">Need to Purchase : </label>
                        <div class="form-check form-check-inline">
                                <label class="form-check-label" style="font-size: 16px;margin-right:5px;">Yes</label>
                                <input type="radio"  onclick="javascript:yesnoCheck();" name="pricecheck" id="yesCheck" <?php if($course->price !== 0){echo "checked";} ?>/>
                                
                        </div>
                        <div  class="form-check form-check-inline">
                                <label class="form-check-label" style="font-size: 16px;margin-right:5px;">No</label>
                                <input type="radio"  onclick="javascript:yesnoCheck();" name="pricecheck" id="noCheck" value="{{ $course->price }}" <?php if($course->price == 0){echo "checked";} ?>/>
        
                        </div>          
                </div>
                @if ($course->price !== 0)
                    <div  id="ifYes">
                        Enter the Price : <input type="text" class="form-control" name="price" value="{{ $course->price }}">
                    </div> 
                @else
                    <div  id="ifYes" style="display:none">
                        Enter the Price : <input type="text" class="form-control" name="price" value="{{ $course->price }}">
                    </div> 
                @endif
                <div class="form-group row">
                        <label for="courseCategory" class="col-md-4 col-form-label">Course Category</label>                 
                           
                                <select id="courseCategory" name="category_id" class="form-control">
                                    @foreach ($courseCategory as $courseCat)                              
                                    <option class="option"  value="{{ $courseCat->id }}"
                                        @if ($course->category_id == old('category_id', $courseCat->id))
                                            selected="selected"
                                        @endif
                                        >{{ $courseCat->name }}</option>    
                                    @endforeach
                                </select>
                           
                            @error('courseCategory')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                <div class="form-group row">
                        <label for="language" class="col-md-4 col-form-label">Course Language</label>                 
                            <input id="language" 
                                    type="text" 
                                    class="form-control @error('language') is-invalid @enderror" 
                                    value="{{ old('language') ?? $course->language }}" 
                                    name="language" 
                                    autocomplete="language" autofocus>
                            @error('language')
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

<script type="text/javascript">
    CKEDITOR.replace('description');

    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.display  = 'block';
        } else {
            document.getElementById('ifYes').style.display  = 'none';
        }
    }
</script>
@stop