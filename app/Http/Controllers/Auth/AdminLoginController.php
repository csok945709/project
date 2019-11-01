<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        //Validate the form data
        $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:5'
        ]);
        //Attempt to log the user in
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            //If successful, then redirect to their intended location
            return redirect()->intended(route('admin.index'));
        }
        //If unsuccessful, then redirect back to the login form with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/admin/login');
      }
}
