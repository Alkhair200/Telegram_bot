<?php

namespace App\Http\Controllers;

use App\Models\AdministrativUnit;
use Illuminate\Http\Request;
use App\Models\States;
use App\Models\Local;

class AdministrativUnitController extends Controller
{

    public function index()
    {
        $locals = Local::all();
        $states = States::all();
        $administrative = AdministrativUnit::with('local' ,'state')->get();
        return view ('dashboard.administrativeUnit.index', compact('administrative','locals' ,'states'));

    }

    public function create()
    {
        $administrative = AdministrativUnit::all();
        $locals = Local::all();
        $states = States::all();

        return view('dashboard.administrativeUnit.create' ,compact('locals' ,'states'));
    }

    public function store(Request $request)
    {
        // return$request;
        $request->validate([

            'administrative_unit_name' => 'required|max:35',
        ]);

     $request_data = $request->except(['_token']);

     AdministrativUnit::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('adminUnit.index'); 
    }


    public function show(AdministrativUnit $administrativUnit)
    {
        //
    }


    public function edit( $id)
    {
        $locals = Local::all();
        $states = States::all();
        $adminUnit = AdministrativUnit::find($id);

        if (!$adminUnit) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('local.index');  
        }
        return view('dashboard.administrativeUnit.edit' ,compact('adminUnit','locals' ,'states'));
    }

    public function update(Request $request, $id)
    {
        $adminUnit = AdministrativUnit::find($id);

        $request->validate([

            'administrative_unit_name' => 'required|max:35',
        ]);

     $request_data = $request->except(['_token']);

     $adminUnit->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('adminUnit.index'); 
    }

    public function destroy( $id)
    {
        AdministrativUnit::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('adminUnit.index');
    }
}
