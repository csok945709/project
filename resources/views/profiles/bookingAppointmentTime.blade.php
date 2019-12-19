@extends('layouts.app')

@section('content')




<div class="container">
@include('profiles.profile')  

    
<div class="col-12">
    <h3 style="text-align:center;font-weight:700">Booking Appointment Schedule</h3>
    <a href="{{ route('profile.consultantTime',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Consultant</a>

    <a  href="{{ route('profile.viewApply', [$user->id]) }}"  id="courseHover" class="btn btn-primary mb-3" style="width:19%">My Course</a>
        

    <a  href="{{ route('profile.index',[$user->id]) }}"  class="btn btn-primary mb-3" style="width:19%">Sharing Blog</a>
    <a href="{{ route('profile.indexDocument',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Knowledge Mine</a>
    <a href="{{ route('profile.indexQuestion',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Bounty Q&A</a>
    

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav" style="margin-left:20%">
                <a class="nav-item nav-link" href="{{ route('consultant.manageAppointmentTime', [Auth::user()->id]) }}" style="font-weight:600;font-size:16px" >Manage Appointment Time</a>
                <a class="nav-item nav-link" href="{{route('profile.consultantTime', $user->id)}}" style="font-weight:600;font-size:16px;">Appointment Schedule</a>    
                <a class="nav-item nav-link active" href="{{ route('profile.bookAppointmentTime', Auth::user()->id )}}" style="font-weight:600;font-size:16px;border-left: 1px solid rgb(51, 51, 51);">Booked Appointment</a>              
              </div>
            </div>
          </nav>
        </div>
{{-- @can('update', $user->profile)
<a href="{{route('document.create')}}" class="btn btn-primary mb-2 mt-3" style="margin-left: 85%;">Create New Course</a>
@endcan  --}}
  <div class="mt-5 col-12">  
    <table id="UserData" class="display">
      <thead>
          <tr>
              <th>No.</th>
              <th>Consultant</th>
              <th>Date</th>
              <th>Start From</th>
              <th>Finish At</th>
              <th>Comment</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody> 
          @foreach ($appointentDetails as $appointentDetail)
          <tr>
              <td></td>
              <td>{{ DB::table('users')->where('id', $appointentDetail->consultant_id)->get('username')->pluck('username')->first() }}</td>
              <td>{{ $appointentDetail->date }}</td>
              <td>{{ $appointentDetail->start_time }}</td>
              <td>{{ $appointentDetail->finish_time }}</td>
              <td>{{ $appointentDetail->comments }}</td>
              <td>@if ($appointentDetail->status == 1)
                <span style="color:green;font-weight:600">Confirm</span>
              @else
                  <span style="color:red;font-weight:600">Cancel</span>
              @endif</td>
              <td>
                @if ($appointentDetail->status == 1)
                    <a href="" class="btn btn-primary">Edit Appointment</a>  
                    <a href="{{route('consultant.cancelAppointmentTime', [Auth::user()->id, $appointentDetail->id, $appointentDetail->consultant_id])}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to Cancel this Appointment ?')">Cancel Appointment</a>  
                  @else
                    <a href="" class="btn btn-primary">View More</a> 
                  @endif             
              </td>
          </tr>
          @endforeach
          
      </tbody>
  </table>
    
  </div>

</div>

@endsection
@section('javascript')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    var t = $('#UserData').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
    </script>
@stop