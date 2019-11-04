<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Course_Category;
use App\Profile;
use App\User;
use App\OrganizerApply;
use App\CourseInvoice;
use App\CourseReply;
use App\CourseComment;

class ConsultantController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $OrgForm = OrganizerApply::all();
        $courseCategory = Course_Category::all();
        $profiles = Profile::get();
        return view('consultant/index', compact('profiles', 'courseCategory','OrgForm'));
    }

    public function show(User $user)
    {
        $consultant = User::where('id', $user->id)->first();
        $profiles = Profile::get();
        return view('consultant/show', compact('consultant','profiles'));
    }
}
