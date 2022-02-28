<?php

namespace App\Http\Controllers;

use App\Models\ClientsTo;
use App\Models\Work;
use App\Models\Local;
use App\Models\States;
use App\Models\AdministrativUnit;
use Illuminate\Http\Request;

class ClientsToController extends Controller
{

    public function index()
    {
        $clientsTo = ClientsTo::with('state','local','administrative','work')->get();
        $locals = Local::all();
        $states = States::all();
        return view ('dashboard.clientsTo.index' ,compact('clientsTo','locals','states'));
    }


    public function create()
    {
        $work = Work::all();
        $locals = Local::all();
        $states = States::all();
        $administrativeUnit = AdministrativUnit::all();
        return view ('dashboard.clientsTo.create' ,compact('work','locals','states','administrativeUnit'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:35',
            'gender' => 'required',
            'personal_identity_type' => 'required',
            'personal_identity_no' => 'required',
            'phone_no' => 'required',
            'state_name' => 'required',
            'local_name' => 'required',
            'administrative_unit_name' => 'required',
            'work_name' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     ClientsTo::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('clientsTo.index'); 
    }

    public function show(ClientsTo $clients)
    {
        //
    }


    public function edit( $id)
    {
        $clientsTo = ClientsTo::find($id);

        $locals = Local::all();
        $states = States::all();
        $work = Work::all();
        $administrativeUnit = AdministrativUnit::all();

        if (!$clientsTo) {
            
            session()->flash('error','Not found!');

            return redirect()->route('clientsTo.index');  
        }
        return view('dashboard.clientsTo.edit' ,compact('clientsTo','locals','states','administrativeUnit','work'));
    }


    public function update(Request $request, $id)
    {
        $clients = ClientsTo::find($id);

        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'personal_identity_type' => 'required',
            'personal_identity_no' => 'required',
            'phone_no' => 'required',
            'state_name' => 'required',
            'local_name' => 'required',
            'work_name' => 'required',
            'administrative_unit_name' => 'required',
        ]);

        $request_data = $request->except(['_token']);

        $clients->update($request_data);
   
           session()->flash('success',__('site.updated_successfully'));
   
           return redirect()->route('clientsTo.index'); 
    }


    public function destroy( $id)
    {
        ClientsTo::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('clientsTo.index');
    }
}
