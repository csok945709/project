@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/c" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="row">
                    <h1>Create New Course</h1>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Course Caption</label>                 
                        <input id="title" 
                               type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title') }}" 
                               name="title" 
                                autocomplete="title" autofocus>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Course Content</label>    
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"></textarea>                
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="venue" class="col-md-4 col-form-label">Organize Venue</label>                 
                        <input id="venue" 
                                type="text" 
                                class="form-control @error('venue') is-invalid @enderror" 
                                value="{{ old('venue') }}" 
                                name="venue" 
                                autocomplete="venue" autofocus>
                        @error('venue')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="duration" class="col-md-4 col-form-label">Course Duration (Hours)</label>                 
                        <input id="duration" 
                                type="text" 
                                class="form-control @error('duration') is-invalid @enderror" 
                                value="{{ old('duration') }}" 
                                name="duration" 
                                autocomplete="duration" autofocus>
                        @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                        <label for="time" class="col-md-4 col-form-label">Time</label>                 
                            <input id="time" 
                                   type="time" 
                                   class="form-control @error('time') is-invalid @enderror" 
                                   value="{{ old('time') }}" 
                                   name="time" 
                                    autocomplete="time" autofocus>
                            @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label">Date</label>                 
                                <input id="date" 
                                       type="date" 
                                       class="form-control @error('date') is-invalid @enderror" 
                                       value="{{ old('date') }}" 
                                       name="date" 
                                        autocomplete="date" autofocus>
                                @error('date')
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
                                <input type="radio"  onclick="javascript:yesnoCheck();" name="pricecheck" id="yesCheck"/>
                                
                        </div>
                        <div  class="form-check form-check-inline">
                                <label class="form-check-label" style="font-size: 16px;margin-right:5px;">No</label>
                                <input type="radio"  onclick="javascript:yesnoCheck();" name="pricecheck" id="noCheck"/>
        
                        </div>          
                </div>
                <div  id="ifYes" style="display:none">
                    Enter the Price : <input type="text" class="form-control" name="price">
                </div> 
                <div class="form-group row">
                        <label for="courseCategory" class="col-md-4 col-form-label">Course Category</label>                 
                        <select id="courseCategory" name="courseCategory" class="form-control">
                                <option selected disabled>Select a type</option>
                                @foreach ($courseCategory as $courseCat)
                                    <option class="option" id="cat{{$courseCat->id}}" value="{{$courseCat->id}}">{{$courseCat->name}}</option>
                                @endforeach
                                </select>
                            @error('courseCategory')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                <div class="form-group row">
                        <label for="courseLanguage" class="col-md-4 col-form-label">Course Language</label>                 
                            <input id="courseLanguage" 
                                    type="text" 
                                    class="form-control @error('courseLanguage') is-invalid @enderror" 
                                    value="{{ old('courseLanguage') }}" 
                                    name="courseLanguage" 
                                    autocomplete="courseLanguage" autofocus>
                            @error('courseLanguage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div> 
                <div class="row pt-3">
                    <button class="btn btn-primary" onclick="return confirm('Are you sure you want to Create this Course ?')">Create New Course</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection

@section('javascript')
<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>

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