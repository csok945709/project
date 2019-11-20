<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BountyQuestionController extends Controller
{
    public function index()
    {
        
        return view('question/index');
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
        }else{
            $question_type = 0;
        }
        auth()->user()->questions()->create([
            'question_caption' => $data['caption'],
            'question_content' =>$data['content'],
            'reward' => $reward,
            'question_type' => $question_type
        ]);
        
        return redirect()->route('question.index');
    }
    
}
