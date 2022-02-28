<?php

namespace App\Http\Controllers;

use App\Models\Courts;
use Illuminate\Http\Request;

use App\Models\States;
use App\Models\Local;
use App\Models\AdministrativUnit;

class CourtsController extends Controller
{

    public function index()
    {
        $locals = Local::all();
        $states = States::all();
        $courts = Courts::with('local','state','administrative')->get();
        return view ('dashboard.courts.index' ,compact('courts','locals' ,'states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locals = Local::all();
        $states = States::all();
        $administrativeUnit = AdministrativUnit::all();
        return view ('dashboard.courts.create',compact('locals','states','administrativeUnit'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'court_name' => 'required|max:35',
            'state_name' => 'required',
            'local_name' => 'required',
            'administrative_unit_name' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     Courts::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('courts.index'); 
    }


    public function show(Courts $courts)
    {
        //
    }


    public function edit( $id)
    {
        $locals = Local::all();
        $states = States::all();
        $administrativeUnit = AdministrativUnit::all();

        $courts = Courts::find($id);

        if (!$courts) {
            
            session()->flash('error','Not found!');

            return redirect()->route('witness.index');  
        }
        return view('dashboard.courts.edit' ,compact('courts',
        'locals','states','administrativeUnit'));
    }


    public function update(Request $request,  $id)
    {
        $courts = Courts::find($id);
        $request->validate([
            'court_name' => 'required|max:35',
            'state_name' => 'required',
            'local_name' => 'required',
            'administrative_unit_name' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $courts->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('courts.index'); 
    }


    public function destroy( $id)
    {
        Courts::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('courts.index');
    }
}
