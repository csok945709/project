@extends('layouts.app')

@section('content')
<div class="container">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

    <div class="row">
        
        <div class="col-12">
               <div style="text-align:center">
                    <h1>{{ $user->username }} Appointment Time</h1> 
               </div>
               <div class="d-flex" style="float: right;">
                    <a href="{{ route('consultant.bookingAppointment', [$user->id]) }}" class="btn btn-primary mr-2">Book Appointment</a>
               </div>
               <div id='calendar' class="mt-5"></div>
                
                    
            </div>
      
    </div>
</div>
@endsection
@section('javascript')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                defaultView: 'agendaWeek',
                events : [
                    @foreach($working_hours as $hour)
                    {
                        
                        title : '{{ $user->name}}' + ' Appointment Hour',
                        start : '{{ $hour->date . ' ' . $hour->start_time }}',
                        end : '{{ $hour->date . ' ' . $hour->finish_time }}',
                        url : '{{ route('consultant.editAppointmentTime', $user->id) }}'

                    },@endforeach 
                    @foreach($appointmentDetails as $hour)
                    {
                        title : '{{  DB::table('users')->where('id', $hour->user_id)->get('username')->pluck('username')->first() }}' + '  Make a appointment',
                        start : '{{ $hour->date . ' ' . $hour->start_time }}',
                        end : '{{ $hour->date . ' ' . $hour->finish_time }}',
                        url : '{{ route('consultant.editAppointmentTime', $user->id) }}',
                        color: '#444444',

                    },
                    @endforeach 
                  
                ]
            })
        });
    </script>
@endsection
