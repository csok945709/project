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
        return view('admin.index');
    }
    
    public function userDetail()
    {
        $users = User::get();
        return view('admin.userDetail', compact('users'));
    }
    
    public function organizerDetail()
    {
        $users = User::where('organizer', true)->get();
        return view('admin.organizerDetail', compact('users'));
    }

    public function consultantDetail()
    {
        $users = User::where('consultant', true)->get();
        return view('admin.consultantDetail', compact('users'));
    }
    
    public function approveOrganizer(User $orgApply)
    {
        dd('approve');
        return view('admin.organizerRequest', compact('applyData'));
    }

    public function organizerRequest()
    {
        $applyData = OrganizerApply::get();
        return view('admin.organizerRequest', compact('applyData'));
    }

    public function showOrg(User $orgApply)
    {
        $orgApplyId = $orgApply->id;
        $orgApply = OrganizerApply::where('user_id', $orgApplyId)->first();
        return view('admin.showOrg', compact('orgApply'));
    }
    
}
