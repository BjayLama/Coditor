<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Course::latest()->paginate(10);

        return view('admin.courses.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.courses.create');
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
            'image' => 'required',
            'coursename' => 'required',
            'coursedetail' => 'required',
            'semester' => 'required',
        ]);

        $course = new Course();
        $course->coursename = $request->coursename;
        $course->coursedetail = $request->coursedetail;
        $course->semester = $request->semester;

        if($request->featured){
            $course->featured = 1;
        }

        $slug = Course::createSlug($request->coursename, 'id', 0);
        // dd($slug);
        $course->slug = $slug;

        $path = public_path(). '/storage/course/'. $slug;
        $folderPath = 'public/course/' . $slug;

        // dd($request);
        if ($request->hasFile('image')) {
            $validateData = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:50000',
            ]);
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            Storage::putFileAs($folderPath, new File($file), $fileName);
            $course->image = $fileName;
        }

        $course->save();
        return redirect ()->route('admin.courses.index')
                    ->with('success', 'Course Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        // dd($course);
        return view('admin.courses.show',compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::where('id', $id)->first();
        // dd($course);
        return view('admin.courses.edit')->with('course', $course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($course);
        $request->validate([
            'image' => 'required',
            'coursename' => 'required',
            'coursedetail' => 'required',
            'semester' => 'required',
        ]);

        $course = Course::findOrFail($id);
        if($course->title != $request->title){
            $slug = Course::createSlug($request->title, 'id', 0);
        }
        $course->coursename = $request->coursename;
        $course->coursedetail = $request->coursedetail;
        $course->semester = $request->semester;

        if($request->featured) {
            $course->featured = 1;
        }
        else{
            $course->featured = 0;
        }

        $path = public_path() . '/storage/course/' . $course->slug;

        if(isset($slug)){
            if ($course->slug !=$slug) {
                $oldslug =$course->slug;
                $course->slug = $slug;
                if (file_exists($path)) {
                    Storage::move('public/course/' . $oldslug, 'public/course/' . $slug);
                }
            }
        }
        else{
            $slug = $course->slug;
        }

        $folderPath = 'public/course/' . $slug;
       

        if ($request->hasFile('image')) {
            $validateData = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:50000',
            ]);
            $oldImage = $course->image;
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            Storage::putFileAs($folderPath, new File($file), $fileName);
            $course->image = $fileName;
            Storage::delete('public/course/'. $slug . '/' .$oldImage);
        }
        $course->update();
        return redirect(route('admin.courses.index'))->with('success', 'Course upadte Successfully !');
    }

    
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $course = Course::findOrFail($id);
        Storage::deleteDirectory('public/courses/'. $course->slug);
        $course->assignments()->delete();
        $course->delete();
        return redirect()->back()->with('success', 'Course deleted Successfully !');
    }
}
