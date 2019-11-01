<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\OrganizerApply;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $applyData = OrganizerApply::all();
        return view('admin.index', compact('applyData'));
    }

    public function approve(User $orgApply)
    {
        $orgApplyId = $orgApply->id;
        $orgApply = OrganizerApply::where('user_id', $orgApplyId)->first();
        $orgApply->status = 1;
        $orgApply->save();  

        $userOrg = User::where('id', $orgApplyId)->first();
        $userOrg->organizer = 1;
        $userOrg->save();  
        $applyData = OrganizerApply::all();
        return view('admin.index', compact('orgApplyId', 'applyData'));
    }

    public function show(User $orgApply)
    {
        $orgApplyId = $orgApply->id;
        $orgApply = OrganizerApply::where('user_id', $orgApplyId)->first();
        return view('admin.showOrg', compact('orgApply'));
    }
    
}
