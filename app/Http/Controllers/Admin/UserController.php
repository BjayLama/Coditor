<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::latest()->paginate(10);

        return view('admin.users.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        // dd($roles);
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'role' => 'required',
        ]);
        $insertArray = [
            'username' => $request->username,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'role' => $request->role,
            'semester_id' => $request->semester_id
        ];
        $insertArray['password'] = bcrypt($request->password);
        // dd($insertArray);
        $user = User::create($insertArray);
        $user->assignRole([$request->role]);
        return redirect ()->route('admin.users.list')
                            ->with('success','User Created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'role' => 'required',
        ]);
        // dd($student);
        // $user->update($request->all());
        $user = User::findOrFail($id);
        $user->username=$request->username;
        $user->password=$request->password;
        $user->firstname=$request->firstname;
        $user->lastname=$request->lastname;
        $user->email=$request->email;
        $user->phone=$request->phone;  
        $user->country=$request->country;
        $user->city=$request->city;  
        $user->role=$request->role;    
        $user->semester_id = $request->semester_id;
        $user->update();

        return redirect ()->route('admin.users.list')
                            ->with('success','Students Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        // dd($id);
        return redirect ()->route('admin.users.list')
                        ->with('success', 'delete Successfully');
    }
}
