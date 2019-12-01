<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\CourseInvoice;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Document;
use DB;
use App\Course;
use App\Question;
use App\ConsulantAppointment;
use App\WorkingHour;
use App\DocumentReport;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $personalID = Auth::user()->id;
        return view('profiles.blogIndex',compact('user', 'follows', 'personalID'));
    }

    public function consultantTime(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $appointentDetails = ConsulantAppointment::where('consultant_id', $user->id)->get();
        return view('profiles.consultantTime',compact('user', 'follows', 'appointentDetails'));
    }

    public function bookAppointmentTime(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $appointentDetails = ConsulantAppointment::where('user_id', Auth::user()->id)->get();
        return view('profiles.bookingAppointmentTime',compact('user', 'follows', 'appointentDetails'));
    }

    public function indexDocument(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $documents = Document::where('user_id', $user)->latest()->paginate(5);
        $personalID = Auth::user()->id;
        return view('profiles.documentIndex',compact('user','documents','follows'));
    }

    public function indexQuestion(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $questions = Question::where('user_id', $user)->latest()->paginate(5);
        return view('profiles.questionIndex',compact('user','questions','follows'));
    }

    public function indexCourse(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $courses = Document::where('user_id', $user)->latest()->paginate(5);
        return view('profiles.courseIndex',compact('user','courses','follows'));
    }

    public function manageCourseApply(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $applyData = CourseInvoice::all();
        $courseRegId = DB::table('courseregister')->where('user_id', $user->id)->pluck('course_id')->toArray();
        $courseRegData = Course::whereIn('id', $courseRegId)->get();
        return view('profiles.course.viewApply',compact('user','follows','applyData','courseRegData'));
    }

    public function viewApplicant(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $applicantDetails = DB::table('courses')
        ->join('courseregister', 'courseregister.course_id', '=', 'courses.id')
        ->join('users', 'users.id', '=', 'courseregister.user_id')
        ->where('courses.user_id', '=', $user->id)
        ->get();
        return view('profiles.course.viewApplicant',compact('user','follows','applicantDetails'));
    }
    
    public function manageCourseOraganized(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $courses = Course::where('user_id', $user->id)->latest()->paginate(5);
        return view('profiles.course.viewOrgCourse',compact('user','courses','follows'));
    }

    public function edit(User $user)
    {
        $this->authorize('update',$user->profile);
        return view('profiles.edit',compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update',$user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        // return view('profiles.profile',compact('user'));
        return redirect("/profile/{$user->id}");
    }
    

    public function reportDocDetails(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $reports = DB::table('document_reports')
        ->join('documents', 'documents.id', '=', 'document_reports.document_id')
        ->join('users', 'users.id', '=', 'document_reports.report_by')
        ->where('document_reports.report_by', '=', $user->id)
        ->get();
        return view('profiles.reportDocIndex',compact('user','reports','follows'));
    }
    
    public function reportPostDetails(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $reports = DB::table('post_reports')
        ->join('posts', 'posts.id', '=', 'post_reports.post_id')
        ->join('users', 'users.id', '=', 'post_reports.report_by')
        ->where('post_reports.report_by', '=', $user->id)
        ->get();
        return view('profiles.reportPostIndex',compact('user','reports','follows'));
    }
}
