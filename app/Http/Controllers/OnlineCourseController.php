<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Course_Category;
use App\Course;
use App\User;
use App\OrganizerApply;
use App\CourseInvoice;
use App\CourseReply;
use App\CourseComment;

class OnlineCourseController extends Controller
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
        $courses = Course::get();
        return view('onlineCourses/index', compact('courses', 'courseCategory','OrgForm'));
    }
    
    
    public function create()
    {
        $courseCategory = Course_Category::all();
        return view('onlineCourses/create', compact('courseCategory'));
    }

    public function apply()
    {
        return view('onlineCourses/apply');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => ['required', 'image'],
            'courseCategory' => 'required',
            'courseLanguage' => 'required',
            'venue' => 'required',
            'time' => 'required',
            'date' => 'required',
            'duration' => 'required',
        ]);
        $price = request('price', 0);
        $imagePath = request('image')->store('course','public');

        auth()->user()->Course()->create([
            'title' => $data['title'],
            'description' =>$data['description'],
            'category_id' => $data['courseCategory'],
            'language' => $data['courseLanguage'],
            'price' =>$price,
            'image' =>$imagePath,
            'venue' => $data['venue'],
            'time' => $data['time'],
            'date' => $data['date'],
            'course_duration' => $data['duration'],
        ]);
        
        return  view('onlineCourses/index');
    }

    public function courseCat(Request $request)
    {
        $input = $request->all();
        $cat_id = (int)$input['catId'];
        return $coursesData = Course::join('course_category','course_category.id','courses.category_id')->where('courses.category_id', $cat_id)->get();
        // return view('onlineCourses/index', compact('coursesData'));
    }

    public function show(User $user, Course $course)
    {
        $user = $user->id;
        $comments =  CourseComment::latest('created_at')->get();
        $replies =  CourseReply::get();
        $courseCount = CourseInvoice::where('course_id', $course->id)->where('buyer_id', $user)->count();
        $payerId = CourseInvoice::where('course_id', $course->id)->first('buyer_id');
        $courseIdCheck =  CourseInvoice::where('course_id', $course->id)->first('course_id',);
        // $comments = Comment::latest('created_at')->get();
        $follows = (auth()->user()) ? auth()->user()->following->contains($user) : false;
        $course = Course::where('id', $course->id)->first();
        
       
        
        
        return view('onlineCourses/show',compact('user','course', 'follows','courseCount','payerId','courseIdCheck','comments','replies'));
    }

    public function detail(User $user, Course $course)
    {
        $user = $user->id;
        $courseCount = CourseInvoice::where('course_id', $course->id)->where('buyer_id', $user)->count();
        $payerId = CourseInvoice::where('course_id', $course->id)->first('buyer_id');
        $courseIdCheck =  CourseInvoice::where('course_id', $course->id)->first('course_id',);
        $follows = (auth()->user()) ? auth()->user()->following->contains($user) : false;
        $course = Course::where('id', $course->id)->first();
        $comments =  CourseComment::latest('created_at')->get();
        $replies =  CourseReply::get();
        
        return view('onlineCourses/courseDetail',compact('user','course', 'follows','courseCount','payerId','courseIdCheck','comments','replies'));
    }

    public function edit(User $user, Course $course)
    {
        $courseId = $course->id;
        $courseCategory = Course::where('id', $courseId)->first();
        $catId = $courseCategory->category_id;
        $courseCatSelected = Course_Category::join('courses','courses.category_id','course_category.id')->where('course_category.id', $catId)->first();
        $courseCategory = Course_Category::all();
        return view('onlineCourses/edit',compact('user','course','courseCategory','courseCatSelected'));
    }

    public function delete(User $user, Post $post)
    {

        Post::where('user_id',$user->id)->where('id',$post->id)->delete();
        return redirect()->route('profile.index', compact('user'));
    }

    public function update(User $user, Course $course)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => '',
            'price' => '',
            'category_id' => 'required',
            'language' => 'required',
        ]);
        
        if (request('image')) {
            $imagePath = request('image')->store('course', 'public');
            $image = Image::make(public_path("/storage/{$imagePath}"));
            $image->save();

            $imageArray = ['image' => $imagePath];
            
        }

        Auth::user()->course->find($course)->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        return redirect()->route('course.show', [$user,$course]);
    }
}
