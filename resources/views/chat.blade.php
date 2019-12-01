@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card ">
                <div class="card-body"><span style="font-size:20px;font-weight:600">{{ Auth::user()->username }} Chats Room</span></div>

                <div class="card-body">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="card-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"></chat-form>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h3 style="font-weight:600;text-align:center">Online Chating</h3><hr>
                    <a href="{{ route('chat', [$user->profile->user_id ])}}" class="btn btn-primary mb-2 ml-2" style="width:90%;">Online Chating</a>
                    <a href="{{ route('consultant.viewAppointmentTime', [$user->id]) }}" class="btn btn-danger ml-2 mb-2" style="width:90%;">View Appointment Time</a>
                    <a href="{{ route('consultant.show', [$user->profile->user_id ])}}" class="btn btn-secondary mb-2 ml-2" style="width:90%;">Back to Consultant Page</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection