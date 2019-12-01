@extends('layouts.adminApp')

@section('content')


    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1  style="text-align:center">Consultant Request Details</h1>
                <hr>
                <div class="col-3 pr-5" style="float: right;">
                    <img src="{{ $profile->profileImage() }}"  style="float: right;" class="rounded-circle w-100">
                </div>
                <h1>Name: {{ $conApply->name }}</h1>
                <h1>Working Years: {{ $conApply->workyears }}  Years</h1>
                <h1>Experience: </h1><textarea class="form-control" readonly>{{$conApply->experience }}</textarea>

                    
                    
                <div class="mt-3">
                    <a href="{{ route('admin.consultantRequest') }}" class="btn btn-secondary">Back to Index</a>
                    @if ($conApply->status == 0)
                        <a href="{{route('admin.approveConsultant', [$conApply->user_id] )}}" class="btn btn-primary"  onclick="return confirm('Are you sure you want to Approve this request ?')">Approve</a>
                        <a href="#" class="btn btn-danger" onclick="return confirm('Are you sure you want to Disapprove this request ?')">Disapprove</a>
                    @else
                        <a href="{{route('admin.approveConsultant', [$conApply->user_id] )}}" class="btn btn-success" disabled>Approved</a>  
                    @endif
                </div>
            </div>
        </div>
                   
    </div>
   
@endsection




