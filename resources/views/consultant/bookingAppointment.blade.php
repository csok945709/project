@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/consultant/bookingAppointment/store" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="row">
                    <h1>Booking Appointment</h1>
                </div>
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
                               value="{{ old('date') }}" 
                               name="date" 
                                min="{{ $Currentdate }}"
                                autocomplete="date" autofocus>
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                        
                <div class="form-group row">
                    <label for="stime" class="col-md-4 col-form-label">Starting Time</label>                 
                        <input id="stime" 
                               type="time" 
                               class="form-control @error('stime') is-invalid @enderror" 
                               value="{{ old('stime') }}" 
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
                               value="{{ old('ftime') }}" 
                               name="ftime" 
                                autocomplete="ftime" autofocus>
                        @error('ftime')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="row pt-3">
                    <button class="btn btn-primary">Booking Appointment</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection