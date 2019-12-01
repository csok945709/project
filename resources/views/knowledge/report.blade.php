@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/reportStore/{{$document->id}}" enctype="multipart/form-data" method="POST">
            @csrf
            <h1 style="text-align:center;font-weight:600">Report Document <span style="color:red">{{ $document->caption }}</span></h1>
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label" style="font-size:18px">Report Type</label>                 
                        <select name="caption" class="form-control">
                            <option value="Others">Others</option>
                            <option value="Nudity">Nudity</option>
                            <option value="Violence">Violence</option>
                            <option value="Spam">Spam</option>
                            <option value="Terrorism">Terrorism</option>
                        </select>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label" style="font-size:18px">Report Content</label>    
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"></textarea>                
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row pt-3">
                    <button class="btn btn-primary" onclick="return confirm('Are you sure you want to submit this report ?')">Submit Report</button>
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