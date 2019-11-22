<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Question;
use App\QuestionAnswer;

class QuestionAnswerController extends Controller
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
    public function store(Request $request, Question $question)
    {
        if (Auth::check()) {
            QuestionAnswer::create([
                'name' => Auth::user()->username,
                'answer' => $request->input('answer'),
                'question_id' => $question->id,
                'user_id' => Auth::user()->id
               
            ]);
            $question = $question->id;
            $user = auth()->user()->id;
            return redirect()->route('question.showBounty', compact('question','user'))->with('success','Answer submit successfully..!');
        }else{
            return back()->withInput()->with('error','Something wrong');
        }


        
    }

    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $commentRequestID = (int)$request->id;
            $commentUserQuery = QuestionAnswer::where('id', '=', $commentRequestID)->first();
            $commentUser = $commentUserQuery->user_id;
            
            $commentID = $commentUserQuery->id;
            if ( $commentUser === Auth::user()->id) {
                if ($commentID === $commentRequestID) {
                    QuestionAnswer::where('user_id', '=', Auth::user()->id)->where('id', '=', $commentRequestID)->delete();
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

