<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Assignment;
use App\Content;
use App\Submission;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class HomeController extends Controller
{
    //
    public function index()
    {
        // dd(Auth::user());
        $data = Course::all();
        $featured_courses = Course::where([['semester', Auth::user()->semester_id],['featured', 1]])->get();
        // dd($featured_courses);
        return view('welcome', compact('data', 'featured_courses'));
    }

    // public function courses($slug)
    // {
    //     $data = Course::all()->where('slug','=', $slug)->first();
    //     return view('courses')->with('courses', $data);
    // }
    public function course_details($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $chapters = Chapter::where('course_id', $course->id)->get();
        $assignments = Assignment::where('course_id', $course->id)->get();
    }

    public function courses($slug){
        $course = Course::where('slug', $slug)->firstOrFail();
        $assignments = Assignment::where('course', $course->id)->get();
        $contents = Content::where('course', $course->id)->get();
        return view('course-single', compact('assignments','contents', 'course'));
    }

    public function assignment_details($slug){
        $assignment = Assignment::where('slug',$slug)->firstOrFail();
        $submission = $assignment->submission()->where('student_id',Auth::user()->id)->first();
        $submissions = Submission::where('assignment_id', $assignment->id)->get();

        return view('assignment-single',compact('assignment', 'submission', 'submissions'));
    }
    public function submission_single($slug){
        $assignment = Assignment::where('slug',$slug)->firstOrFail();
        // $submission_exists = $assignment->submission()->where('student_id',Auth::user()->id)->exists();
        // if($submission_exists){
        //     return redirect()->back()->with('error','Already Submitted');
        // }
        return view('submission', compact('assignment'));
    }
    public function content_detail(){
        $file = Content::where('slug',$slug)->firstOrFail();
        return view('contents')->with('contents', $file);
    }
    public function search(Request $request){
        // dd($request);
        $q = $request->search;
        $search = Course::where('coursename', 'LIKE', '%' . $q . '%')->get();
        $searchassignment = Assignment::where('title', 'LIKE', '%' . $q . '%')->get();
        return view('search', compact('search', 'searchassignment'));
    }


    public function user_login()
    {
        
        if(Auth::check()){
            return redirect()->back()->with('error', 'Already Logged In');
        }
        return view('user-login');
    }

    public function submit_assignment($slug, Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'file' => 'file|mimes:doc,docx,xls,pdf,ppt,pptx|max:50000',
        ]);

        $path = public_path().'/storage/submission/';
        $folderPath = 'public/submission/';

        // dd(file_exists($path));

        if (!file_exists($path)) {

            Storage::makeDirectory($folderPath,0777,true,true);

        }

        $assignment = Assignment::where('slug',$slug)->firstOrFail();

        $submission_exists = $assignment->submission()->where('student_id',Auth::user()->id)->exists();
        if($submission_exists){
            $submission = Submission::where([['student_id',Auth::user()->id],['assignment_id',$assignment->id]])->first();
        }else{
            $submission = new Submission();
            $submission->assignment_id = $assignment->id;
            $submission->submission_status = 1;
            $submission->student_id = Auth::user()->id;
        }

        if ($request->hasFile('file')) {

            $validatedData = $request->validate([
                'file' => 'file|mimes:doc,docx,xls,pdf,ppt,pptx|max:50000',
            ]);

            if($submission_exists){
                $oldSubmittedFile = $submission->file;
                Storage::delete('public/submission/' . $oldSubmittedFile);
            }
            
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            
            Storage::putFileAs($folderPath, new File($file), $fileName);
            $submission->file = $fileName;

            
        }
        // dd($assignment);
        $submission->save();

        return redirect()->route('assignment-details', ['slug' => $slug])->with('status', 'Your Assignment has been submitted!');
        // dd($request);
    }
}
