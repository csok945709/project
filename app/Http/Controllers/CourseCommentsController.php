<?php

namespace App\Http\Controllers;


use App\Course;
use App\CourseComment;
use App\CourseReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseCommentsController extends Controller
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
    public function store(Request $request, Course $course)
    {
        if (Auth::check()) {
          
            CourseComment::create([
                'name' => Auth::user()->username,
                'comment' => $request->input('comment'),
                'course_id' => $course->id,
                'user_id' => Auth::user()->id
               
            ]);
            $course = $course->id;
            $user = auth()->user()->id;
            return redirect()->route('course.detail', compact('course','user'))->with('success','Comment Added successfully..!');
        }else{
            return back()->withInput()->with('error','Something wrong');
        }


        
    }

    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $commentRequestID = (int)$request->id;
            $commentUserQuery = CourseComment::where('id', '=', $commentRequestID)->first();
            $commentUser = $commentUserQuery->user_id;
            
            $commentID = $commentUserQuery->id;
            if ( $commentUser === Auth::user()->id) {
                if ($commentID === $commentRequestID) {
                    CourseComment::where('user_id', '=', Auth::user()->id)->where('id', '=', $commentRequestID)->delete();
                    return 1;
                }else{
                    return 2;
                }
            }else {
                return 3;
            }

        }    
    }
}

