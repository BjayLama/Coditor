<?php

namespace App\Http\Controllers\Admin;

use App\Assignment;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignments = Assignment::all();
        return view('admin.assignments.index')->with('assignments', $assignments);
    }

    public function status(Request $request)
    {
        $id = $request->id;
        $featured = Assignment::findOrFail($id);
        if ($featured->featured === 1) {
            $featured->featured = 0;
        }
        else {
            $featured->featured = 1;
        }
        $featured->save();
        $response = array('success' => 'Status Updated Successfully !!');
        return json_encode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Course::all();
        return view('admin.assignments.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'desc' => 'required',
            'course' => 'required',
            'semester' => 'required',
            'deadline' => 'required',
        ]);
      
        $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->desc = $request->desc;
        $assignment->course = $request->course;
        $assignment->semester = $request->semester;
        $assignment->deadline = $request->deadline;

        if($request->featured){

            $assignment->featured = 1;
        }

        $slug = Assignment::createSlug($request->title, 'id', 0);
        // dd($slug);
        $assignment->slug = $slug;

        $path = public_path().'/storage/assignment/'.$slug;
        $folderPath = 'public/assignment/'.$slug;

        // dd(file_exists($path));


        if ($request->hasFile('file')) {
            $validatedData = $request->validate([
                'file' => 'file|mimes:doc,docx,xls,pdf,ppt,pptx,xlsx|max:50000',
            ]);
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
           
            Storage::putFileAs($folderPath, new File($file), $fileName);
            $assignment->file = $fileName;
        }
        // dd($assignment);
        $assignment->save();
        return redirect(route('admin.assignments.index'))->with('success', 'assignments created successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data = Course::all();
        $assignment = Assignment::all()->where('slug', '=', $slug)->first();
        return view ('admin.assignments.form', compact('data', 'assignment'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'desc' => '',
            'course' => 'required',
            'semester' => '',
            'deadline' => '',
        ]);
        // dd($request);
        $assignment = Assignment::findOrFail($id);
        // dd($id);
        $slug = Assignment::createSlug($request->title, $assignment->id);
        $path = public_path().'/storage/assignment/'.$assignment->slug;

        if ($assignment->slug != $slug) {
            
            if (file_exists($path)) {
                Storage::move('public/assignment/'. $assignment->slug , 'public/assignment/'.$slug);
            }

            $slug = Assignment::createSlug($slug, $assignment->id);
        }

        
        // $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->desc = $request->desc;
        $assignment->course = $request->course;
        $assignment->semester = $request->semester;
        $assignment->deadline = $request->deadline;

        if($request->featured){
            $assignment->featured = 1;
        }else{
            $assignment->featured = 0;
        }
        
        $path = public_path().'/storage/assignment/'.$slug;
        $folderPath = 'public/assignment/'.$slug;

        if (!file_exists($path)) {

            Storage::makeDirectory($folderPath,0777,true,true);

            if (!is_dir($path."/thumbs")) {
                Storage::makeDirectory($folderPath.'/thumbs',0777,true,true);
            }

        }

        if ($request->hasFile('file')) {
            $validatedData = $request->validate([
                'file' => 'file|mimes:doc,docx,xls,pdf,ppt,pptx,xlsx|max:50000',
            ]);
            $oldfile = $assignment->file;
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
           
            Storage::putFileAs($folderPath, new File($file), $fileName);
            $assignment->file = $fileName;
            Storage::delete('public/assignment/' . $slug . '/' . $oldfile);
        }
        $assignment->save();
        return redirect(route('admin.assignments.index'))->with('success', 'assignment updated successfully !');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        Storage::deleteDirectory('public/assignment/'. $assignment->slug);
        $assignment->delete();
        return redirect()->back()->with('success', 'assignment deleted successfully !');
    }
}
