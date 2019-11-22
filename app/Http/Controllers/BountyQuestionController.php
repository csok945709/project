<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Question;
use App\User;
use App\QuestionAnswer;
use App\AnswerReply;

class BountyQuestionController extends Controller
{
    public function index()
    {
        $questions = Question::where('question_type', '0')->get();
        return view('question/index', compact('questions'));
    }

    public function indexFollow()
    {
        $questionsBounty = Question::where('question_type', '1')->where('paid', '1')->get();
        return view('question/indexBounty', compact('questionsBounty'));
    }

    public function create()
    {
        
        return view('question/create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'content' => 'required',
            'pricecheck' => 'required',
        ]);

        $reward = request('reward', 0);
        if ($reward !== 0) {
            $question_type = 1;
            $paid = false;
        }else{
            $question_type = 0;
            $paid = true;
        }
        auth()->user()->questions()->create([
            'question_caption' => $data['caption'],
            'question_content' =>$data['content'],
            'reward' => $reward,
            'paid' => $paid,
            'question_type' => $question_type
        ]);
        $user = Auth::user()->id;
        return redirect()->route('profile.indexQuestion', compact('user'));
    }
    public function show(User $user, Question $question)
    {
        $viewer = Question::where('id', $question->id)->increment('visit_count');
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $questionData = Question::where('id', $question->id)->first();
        $answers =  QuestionAnswer::where('question_id', $question->id)->latest('created_at')->get();
        $replies = AnswerReply::get();
        if ($questionData->question_type !== 0) {
            return view('question/showBounty', compact('questionData', 'follows','answers','replies'));
        } else {
            return view('question/show', compact('questionData', 'follows','answers','replies'));
        }
    }

    // public function showBounty(User $user, Question $question)
    // {
    //     $viewer = Question::where('id', $question->id)->increment('visit_count');
    //     $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
    //     $questionData = Question::where('id', $question->id)->first();
    //     $answers =  QuestionAnswer::where('question_id', $question->id)->latest('created_at')->get();
    //     $replies = AnswerReply::get();
    //     return view('question/showBounty', compact('questionData', 'follows','answers','replies'));
    // }
    
    public function payment(User $user, Question $question)
    {
        
        return view('question/payment', compact('questionData', 'follows','answers','replies'));
    }

    public function edit(User $user, Question $question)
    {
        return view('question/edit', compact('question', 'user'));
    }

    public function update(User $user, Question $question)
    {
    
        $data = request()->validate([
            'question_caption' => 'required',
            'question_content' => 'required',
            'pricecheck' => 'required',
        ]);

        $reward = request('reward', 0);
        if ($reward !== 0) {
            $question_type = 1;
            $paid = false;
        }else{
            $question_type = 0;
            $paid = true;
        }
        
        Auth::user()->questions->find($question)->update([
            'question_caption' => $data['question_caption'],
            'question_content' =>$data['question_content'],
            'reward' => $reward,
            'paid' => $paid,
            'question_type' => $question_type
        ]);

        return redirect()->route('profile.indexQuestion', [$user->id]);
    }

    public function delete(User $user, Question $question)
    {

        Question::where('user_id',$user->id)->where('id',$question->id)->delete();
        return redirect()->route('profile.indexQuestion', [$user->id]);
    }
}
