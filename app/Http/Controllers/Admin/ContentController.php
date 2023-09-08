<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ContentController extends Controller
{
    //

    public function index() {
        $files = Content::All();
        return view('admin.contents.index')->with('contents', $files);
    }

    public function create(){
        $data = Course::all();
        return view('admin.contents.form', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'desc' => 'required',
            'course' => 'required',
        ]);

        $content = new Content();
        $content->title = $request->title;
        $content->desc = $request->desc;
        $content->course = $request->course;

        $slug = Content::createSlug($request->title, 'id', 0);
        $content->slug = $slug;

        $path = public_path() . '/storage/content/' . $slug;
        $folderPath = 'public/content/' . $slug;
        

        if ($request->hasFile('file')) {
            $validatedData = $request->validate([   
                'file' => 'file|mimes:doc,docx,xls,pdf,ppt,pptx|max:50000',
            ]);
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
           
            Storage::putFileAs($folderPath, new File($file), $fileName);
            $content->file = $fileName;
        }
        $content->save();
        return redirect(route('admin.contents.index'))->with('success', 'contents created successfully !');
    }


    public function edit($slug)
    {
        $data = Course::all();
        $content = Content::all()->where('slug', '=', $slug)->first();
        return view ('admin.contents.form', compact('data', 'content'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'desc' => '',
            'course' => 'required',
            // 'semester' => '',
            // 'deadline' => '',
        ]);
        // dd($request);
        $content = Content::findOrFail($id);
        // dd($id);
        $slug = COntent::createSlug($request->title, $content->id);
        $path = public_path().'/storage/content/'.$content->slug;

        if ($content->slug != $slug) {
            
            if (file_exists($path)) {
                Storage::move('public/content/'. $content->slug , 'public/content/'.$slug);
            }

            $slug = Content::createSlug($slug, $content->id);
        }

        
        // $assignment = new Assignment();
        $content->title = $request->title;
        $content->desc = $request->desc;
        $content->course = $request->course;
        // $content->semester = $request->semester;
        // $content->deadline = $request->deadline;

        // if($request->featured){
        //     $content->featured = 1;
        // }else{
        //     $content->featured = 0;
        // }
        
        $path = public_path().'/storage/content/'.$slug;

        if(isset($slug)){
            if ($content->slug !=$slug) {
                $oldslug =$content->slug;
                $content->slug = $slug;
                if (file_exists($path)) {
                    Storage::move('public/conte$content/' . $oldslug, 'public/conte$content/' . $slug);
                }
            }
        }
        else{
            $slug = $content->slug;
        }
        $folderPath = 'public/content/'.$slug;


        if ($request->hasFile('file')) {
            $validatedData = $request->validate([
                'file' => 'file|mimes:doc,docx,xls,pdf,ppt,pptx|max:50000',
            ]);
            $oldfile = $content->file;
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
           
            Storage::putFileAs($folderPath, new File($file), $fileName);
            $content->file = $fileName;
            Storage::delete('public/content/' . $slug . '/' . $oldfile);
        }
        $content->save();
        return redirect(route('admin.contents.index'))->with('success', 'content updated successfully !');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        Storage::deleteDirectory('public/content/'. $content->slug);
        $content->delete();
        return redirect()->back()->with('success', 'content deleted successfully !');
    }
}
