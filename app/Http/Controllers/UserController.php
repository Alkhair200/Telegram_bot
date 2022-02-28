<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct(){
    
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');
    }

    public function index()
    {
        $users = User::whereRoleIs('admin')->get();
        return view ('dashboard.users.index' ,compact('users'));
    }

    public function create()
    {
        return view ('dashboard.users.create' );
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',

        ]);

        $reques_data = $request->except(['password','password_confirmation','permissions']);
        $reques_data['password'] = bcrypt($request->password);

        $user = User::create($reques_data);

        $user->attachRole('admin');

        $user->syncPermissions($request->permissions);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }


    public function update(Request $request, $id)
    {
         $user = User::find($id);
        
        $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id),],
            'permissions' => 'required|min:1'
        ]);

         $request_data = $request->except(['permisssions','id','_token','_method']);
        
        $user->update($request_data);

        $user->syncPermissions($request->permissions);

        session()->flash('success',__('site.updated_successfully'));

       return redirect()->route('users.index');

    }

    public function destroy(User $user)
    {

        $user->delete();
        session()->flash('success',__('site.deleted_successfully'));

       return redirect()->route('users.index');
    }
}
