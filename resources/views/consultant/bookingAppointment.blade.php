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
            <input type="hidden" value="{{ $consultant->id }}" name="consultant_id">
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
                    <label for="bookdate" class="col-md-4 col-form-label">Date</label>                 
                        <input id="bookdate" 
                               type="date" 
                               class="form-control @error('bookdate') is-invalid @enderror" 
                               value="{{ old('bookdate') }}" 
                               name="bookdate" 
                                min="{{ $Currentdate }}"
                                autocomplete="bookdate" autofocus>
                        @error('bookdate')
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

                <div class="form-group row">
                    <label for="comments" class="col-md-4 col-form-label">Comments</label>                 
                        <textarea id="comments" 
                               type="text" 
                               class="form-control @error('comments') is-invalid @enderror" 
                               value="{{ old('comments') }}" 
                               name="comments" 
                               placeholder="Leave comments here..."
                               autocomplete="comments" autofocus></textarea>
                        @error('comments')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="row pt-3">
                    <button class="btn btn-primary"  onclick="return confirm('Are you sure you want to Book this Consultant ?')">Booking Appointment</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection