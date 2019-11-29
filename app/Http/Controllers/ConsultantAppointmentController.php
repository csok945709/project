<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use App\WorkingHour;
use Carbon\Carbon;
use App\ConsulantAppointment;

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
        $appointmentDetails = ConsulantAppointment::where('consultant_id', $user->id)->get();
        $working_hours = WorkingHour::where('consultant_id', $user->id)->get();
        return view('consultant/workingTime', compact('user','working_hours', 'appointmentDetails') );
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
            'date' => $data['date'],
            'start_time' => $data['stime'],
            'finish_time' => $data['ftime'],
        ]);
        $user = Auth::user()->id;
        return redirect()->route('consultant.manageAppointmentTime', [$user]);

    }
    
    public function viewAppointmentTime(User $user)
    {
        $appointmentDetails = ConsulantAppointment::where('consultant_id', $user->id)->get();
        $working_hours = WorkingHour::where('consultant_id', $user->id)->get();
        return view('consultant/appointmentTime', compact('user','working_hours','appointmentDetails'));
    }

    public function editAppointmentTime(User $user)
    {
        $appointmentDetails = ConsulantAppointment::where('consultant_id', $user->id)->where('user_id', Auth::user()->id)->first();
        $working_hours = WorkingHour::where('consultant_id', $user->id)->first();
        $Currentdate =  Carbon::now()->format('Y-m-d');
        return view('consultant/editAppointment', compact('user','working_hours','appointmentDetails','Currentdate'));
    }

    public function bookingAppointment(User $user)
    {
        $consultant = User::where('id', $user->id)->first();
        $working_hours = WorkingHour::where('consultant_id', $user->id)->get();
        $Currentdate =  Carbon::now()->format('Y-m-d');
        return view('consultant/bookingAppointment', compact('consultant','working_hours','Currentdate'));
    }
    
    public function storeBookingAppointment()
    {
        $data = request()->validate([
            'consultant_id' => 'required',
            'bookdate' => 'required',
            'stime' => 'required',
            'ftime' => 'required',
        ]);
        auth()->user()->bookAppointment()->create([
            'consultant_id' => $data['consultant_id'],
            'user_id' => Auth::user()->id,
            'date' => Input::get('bookdate'),
            'start_time' => date("H:i:s", strtotime($data['stime'])),
            'finish_time' => date("H:i:s", strtotime($data['ftime'])),
            'comments' => Input::get('comments'),
            'status' => true,
        ]);
        $consultant_id = $data['consultant_id'];
        return redirect()->route('consultant.viewAppointmentTime', [$consultant_id]);
    }

    public function updateAppointmentTime()
    {
        $data = request()->validate([
            'consultant_id' => 'required',
            'date' => 'required',
            'stime' => 'required',
            'ftime' => 'required',
        ]);
        auth()->user()->bookAppointment()->update([
            'consultant_id' => $data['consultant_id'],
            'user_id' => Auth::user()->id,
            'date' => $data['date'],
            'start_time' => date("H:i:s", strtotime($data['stime'])),
            'finish_time' => date("H:i:s", strtotime($data['ftime'])),
            'comments' => Input::get('comments')
        ]);
        $user = Auth::user()->id;
        return redirect()->route('consultant.viewAppointmentTime', [$user]);
    }
    public function cancelAppointmentTime(User $user)
    {
        auth()->user()->bookAppointment()->delete();
        return redirect()->route('consultant.viewAppointmentTime', [$user]);
    }
}
