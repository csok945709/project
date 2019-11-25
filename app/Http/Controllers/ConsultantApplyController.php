<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\ConsultantApply;

class ConsultantApplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function applyForm()
    {
        return view('consultant/apply');
    }

    public function store()
    {
        $data = request()->validate([
            'username' => 'required',
            'experience' => 'required',
            'workyears' => 'required',
        ]);
        if (Auth::check()) {
            ConsultantApply::create([
                'name' => $data['username'],
                'experience' => $data['experience'],
                'workyears' => $data['workyears'],
                'user_id' => Auth::user()->id
            ]);
        } 
        return redirect()->route('consultant.index');
    }
}
