<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Models\States;
use Illuminate\Http\Request;

class LocalController extends Controller
{

    public function index()
    {
        
        $locals = Local::with('state')->get();
        return view ('dashboard.local.index' ,compact('locals'));
    }


    public function create()
    { 
        $states = States::all();
        return view ('dashboard.local.create' ,compact('states'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'state_no' => 'required',
            'local_name' => 'required|max:30',
        ]);

     $request_data = $request->except(['_token']);

        Local::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('local.index');  
    }


    public function show(Local $local)
    {
        //
    }


    public function edit( $id)
    {
        $states = States::all();
        $local = Local::find($id);

        if (!$local) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('local.index');  
        }
        return view('dashboard.local.edit' ,compact('local' ,'states'));
    }


    public function update(Request $request,$id)
    {
        $local_data = Local::find($id);

        $request->validate([
            'local_name' => 'required|max:30',
        ]);

        $request_data = $request->except(['_token']);

        $local_data->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('local.index');  
    }


    public function destroy($id)
    {
        Local::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('local.index');
    }
}
