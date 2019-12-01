@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/d" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="row">
                    <h1>Upload New Document</h1>
                </div>
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Document Caption</label>                 
                        <input id="caption" 
                               type="text" 
                               class="form-control @error('caption') is-invalid @enderror" 
                               value="{{ old('caption') }}" 
                               name="caption" 
                                autocomplete="caption" autofocus>
                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Document Content</label>    
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"></textarea>                
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <label for="document" class="col-md-4 col-form-label">Upload Document</label>                      
                    <input type="file" class="ml-2 form-control-file @error('document') is-invalid @enderror" id="document" name="document">
                    @error('document')
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
                <div class="row pt-3">
                    <button class="btn btn-primary" onclick="return confirm('Are you sure you want to Upload this Document ?')">Upload New Document</button>
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