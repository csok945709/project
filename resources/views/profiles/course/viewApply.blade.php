@extends('layouts.app')

@section('content')

<div class="container">
@include('profiles.profile')  

    
<div class="col-12">
    <h3 style="text-align:center;font-weight:700">Manage My Course</h3>
    <a href="{{ route('profile.indexForum',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Consultant</a>

    <a  href="{{ route('profile.viewApply', [$user->id]) }}"  id="courseHover" class="btn btn-primary mb-3" style="width:19%">My Course</a>
        

    <a  href="{{ route('profile.index',[$user->id]) }}"  class="btn btn-primary mb-3" style="width:19%">Sharing Blog</a>
    <a href="{{ route('profile.indexDocument',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Knowledge Mine</a>
    <a href="{{ route('profile.indexForum',[$user->id]) }}"  class="btn btn-success mb-3" style="width:19%">Bounty Q&A</a>
    

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav" style="margin-left:30%">
                <a class="nav-item nav-link active" href="{{ route('profile.viewApply', [$user->id]) }}" style="font-weight:600;font-size:16px" >View Register Course <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="{{ route('profile.viewOrgCourse', [$user->id]) }}" style="font-weight:600;font-size:16px;border-left: 1px solid rgb(51, 51, 51);">View Organized Course</a> 
              </div>
            </div>
          </nav>

</div>

<div class="container mt-3">
        
        <table id="UserData" class="display">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Venue</th>
                    <th>Language</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Price (RM)</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courseRegData as $courseData)
                    
                
                <tr>
                    <td>1</td>
                    <td>{{ $courseData->title }}</td>
                    <td>{!! $courseData->description !!}</td>
                    <td>{{ $courseData->venue }}</td>
                    <td>{{ $courseData->language }}</td>
                    <td>{{ $courseData->time }}</td>
                    <td>{{ $courseData->date }}</td>
                    <td>{{ $courseData->price }}</td>
                    <td>Paid</td>
                    <td>
                    <a href="{{ route('course.detail', [Auth::user()->id, $courseData->id]) }}" class="btn btn-primary">View More</a>               
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
            $('#UserData').DataTable();
        } );
        </script>
    @stop