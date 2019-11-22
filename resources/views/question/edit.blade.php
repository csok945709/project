@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
        <form action="/q/{{ $user->id }}/{{$question->id}}"enctype="multipart/form-data" method="POST">
            @csrf
            @method('PATCH')
                <div class="row">
                    <h1>Edit Question</h1>
                </div>
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Question Caption</label>                 
                        <input id="caption" 
                               type="text" 
                               class="form-control @error('caption') is-invalid @enderror" 
                               value="{{ old('caption') ?? $question->question_caption }}" 
                               name="question_caption" 
                                autocomplete="caption" autofocus>
                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="question_content" class="col-md-4 col-form-label">Question Content</label>            
                        <textarea id="question_content" 
                               type="text" 
                               class="form-control @error('question_content') is-invalid @enderror" 
                               value="{!! old('question_content', $question->question_content) !!}" 
                               name="question_content" 
                                autocomplete="question_content" autofocus>{!!  old('question_content', $question->question_content) !!}</textarea>
                        @error('question_content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row container">
                    <label style="margin-top:15px;margin-right:20px;font-size:16px;">Set as Bounty : </label>
                        <div class="form-check form-check-inline">
                                <label class="form-check-label" style="font-size: 16px;margin-right:5px;">Yes</label>
                                <input type="radio"  onclick="javascript:yesnoCheck();" name="pricecheck" id="yesCheck" <?php if($question->reward !== 0){echo "checked";} ?>/>
                                
                        </div>
                        <div  class="form-check form-check-inline">
                                <label class="form-check-label" style="font-size: 16px;margin-right:5px;">No</label>
                                <input type="radio"  onclick="javascript:yesnoCheck();" name="pricecheck" id="noCheck" value="{{ $question->reward }}" <?php if($question->reward == 0){echo "checked";} ?>/>
        
                        </div>          
                </div>
                @if ($question->reward !== 0)
                    <div  id="ifYes">
                        Enter the Reward Amount : <input type="text" class="form-control" name="reward" id="reward" value="{{ $question->reward }}">
                    </div> 
                @else
                    <div  id="ifYes" style="display:none">
                        Enter the Reward Amount : <input type="text" class="form-control" name="reward" id="reward" value="{{ $question->reward }}">
                    </div> 
                @endif
                <div class="row pt-3">
                    <button onclick="return confirm('Are you sure you want to update this question ?')" class="btn btn-primary"  >Update Question</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>

<script type="text/javascript">
    CKEDITOR.replace('question_content', {
        filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}'
    });
    
</script>

<script type="text/javascript">
    CKEDITOR.replace('description');

    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.display  = 'block';
        } else {
            document.getElementById("reward").value = "";
            document.getElementById('ifYes').style.display  = 'none';
            
        }
    }
</script>
@stop