<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function student_dashboard()
    {
        $user = Auth::user();
        return view('student.user-profile',compact('user'));
    }



    public function updateDetails(Request $request){
        $user = auth()->user();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->update();
        return redirect()->back()->with('status', 'User Details updated successfully');
    }

}
