<?php

namespace App\Http\Controllers;

use App\Models\Witness;
use Illuminate\Http\Request;


use App\Models\States;
use App\Models\Local;
use App\Models\AdministrativUnit;

class WitnessController extends Controller
{

    public function index()
    {
        $witness = Witness::with('state','local')->get();
        $locals = Local::all();
        $states = States::all();
        return view ('dashboard.witness.index' ,compact('witness','locals','states'));
    }


    public function create()
    {
        $locals = Local::all();
        $states = States::all();
        $administrativeUnit = AdministrativUnit::all();
        return view ('dashboard.witness.create',compact('locals','states','administrativeUnit'));
        
    }


    public function store(Request $request)
    {

        $request->validate([
            'witness_name' => 'required',
            'gender' => 'required',
            'personal_identity_type' => 'required',
            'personal_identity_no' => 'required',
            'phone_no' => 'required',
            'state_name' => 'required',
            'local_name' => 'required',
            'administrative_unit_name' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     Witness::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('witness.index'); 
    }


    public function show(Witness $witness)
    {
        //
    }


    public function edit( $id)
    {
        $locals = Local::all();
        $states = States::all();
        $administrativeUnit = AdministrativUnit::all();

        $witness = Witness::find($id);

        if (!$witness) {
            
            session()->flash('error','Not found!');

            return redirect()->route('witness.index');  
        }
        return view('dashboard.witness.edit' ,compact('witness','
        locals','states','administrativeUnit'));
    }


    public function update(Request $request, $id)
    {
        $witness = Witness::find($id);

        $request->validate([
            'witness_name' => 'required',
            'gender' => 'required',
            'personal_identity_type' => 'required',
            'personal_identity_no' => 'required',
            'phone_no' => 'required',
            'state_name' => 'required',
            'local_name' => 'required',
            'administrative_unit_name' => 'required',
        ]);

        $request_data = $request->except(['_token']);

        $witness->update($request_data);
   
           session()->flash('success',__('site.updated_successfully'));
   
           return redirect()->route('witness.index'); 

    }


    public function destroy( $id)
    {
        Witness::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('witness.index');
    }
}
