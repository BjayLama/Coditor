<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Submission;


class TeacherController extends Controller
{
    public function teacher_dashboard()
    {
        $user = Auth::user();
        return view('teacher.teacher-dashboard',compact('user'));
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

    public function submitted_assignments()
    {
        $submission = Submission::all();
        return view('teacher.submitted-details', compact('submission'));
    }
}
