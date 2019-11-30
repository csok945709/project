@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/consultant/updateWorkingHour/update/{$user->id}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PATCH')
                <div class="row">
                <h1>Edit {{ $user->username }} Appointment Time Schedule</h1>
                </div>
            <input type="hidden" value="{{ $user->id }}" name="consultant_id">
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">User Name</label>                 
                        <input id="name" 
                               type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') ?? Auth::user()->username }}"  
                               name="name" 
                                autocomplete="name" autofocus readonly>
                        @error('name')
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
                               value="{{ old('date')  ?? $working_hours->date }}" 
                               name="date" 
                                autocomplete="date" autofocus>
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                        <label for="stime" class="col-md-4 col-form-label">Start Time</label>                 
                            <input id="stime" 
                                   type="time" 
                                   class="form-control @error('stime') is-invalid @enderror" 
                                   value="{{ old('stime') ?? $working_hours->start_time }}" 
                                   name="stime" 
                                    autocomplete="stime" autofocus>
                            @error('stime')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                
                <div class="form-group row">
                    <label for="ftime" class="col-md-4 col-form-label">Finish Time</label>                 
                        <input id="ftime" 
                               type="time" 
                               class="form-control @error('ftime') is-invalid @enderror" 
                               value="{{ old('ftime') ?? $working_hours->finish_time }}" 
                               name="ftime" 
                                autocomplete="ftime" autofocus>
                        @error('ftime')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row pt-3">
                    <button class="btn btn-primary mr-2" onclick="return confirm('Are you sure you want to update this appointment?')">Update Appointment</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection