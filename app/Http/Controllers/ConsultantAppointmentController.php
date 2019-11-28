<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\WorkingHour;
use Carbon\Carbon;

class ConsultantAppointmentController extends Controller
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
    public function manageAppointmentTime(User $user)
    {
        $working_hours = WorkingHour::where('consultant_id', $user->id)->get();
        return view('consultant/workingTime', compact('user','working_hours') );
    }
    
    public function addAppointmentTime(User $user)
    {
        $users = User::where('id', $user->id)->first();
        return view('consultant/createWorkingTime', compact('users'));
    }

    public function storeAppointmentTime()
    {
        $data = request()->validate([
            'date' => 'required',
            'stime' => 'required',
            'ftime' => 'required',
        ]);
        auth()->user()->workingHours()->create([
            'consultant_id' => Auth::user()->id,
            'date' =>$data['date'],
            'start_time' => $data['stime'],
            'finish_time' => $data['ftime'],
        ]);
        $user = Auth::user()->id;
        return view('consultant/workingTime', compact('user'));
    }
    
    public function viewAppointmentTime(User $user)
    {
        $working_hours = WorkingHour::where('consultant_id', $user->id)->get();
        return view('consultant/appointmentTime', compact('user','working_hours'));
    }

    public function bookingAppointment(User $user)
    {
        $consultant = User::where('id', $user->id)->first();
        $working_hours = WorkingHour::where('consultant_id', $user->id)->get();
        $Currentdate =  Carbon::now()->format('Y-m-d');
        return view('consultant/bookingAppointment', compact('consultant','working_hours','Currentdate'));
    }
}
