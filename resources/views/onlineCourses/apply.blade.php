@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/c/apply/store" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="row">
                    <h1>Apply Organizer Form</h1>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label">Name Applicant</label>                 
                        <input id="username" 
                               type="text" 
                               class="form-control @error('username') is-invalid @enderror" 
                               value="{{ Auth::user()->name }}" 
                               name="username" 
                                autocomplete="username" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="experience" class="col-md-4 col-form-label">Applicant Experience</label>    
                    <textarea class="form-control @error('experience') is-invalid @enderror" name="experience" id="experience"></textarea>                
                    @error('experience')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="workyears" class="col-md-4 col-form-label">Time of Working Eperience</label>    
                    <select name="workyears" id="workyears">
                        <option value="1">< 1 Year</option>
                        <option value="5">< 5 Years</option>
                        <option value="9">< 10 Years</option>  
                        <option value="10">> 10 Years</option>    
                    </select>               
                    @error('workyears')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row pt-3">
                    <button class="btn btn-primary">Submit Apply Form</button>
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