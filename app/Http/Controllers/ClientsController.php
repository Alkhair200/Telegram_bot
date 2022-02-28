<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Work;
use App\Models\Local;
use App\Models\States;
use App\Models\AdministrativUnit;
use Illuminate\Http\Request;

class ClientsController extends Controller
{

    public function index()
    {
        $clients = Clients::with('state','local','administrative','work')->get();
        $locals = Local::all();
        $states = States::all();
        return view ('dashboard.clients.index' ,compact('clients','locals','states'));
    }


    public function create()
    {
        $work = Work::all();
        $locals = Local::all();
        $states = States::all();
        $administrativeUnit = AdministrativUnit::all();
        return view ('dashboard.clients.create' ,compact('work','locals','states','administrativeUnit'));
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

     Clients::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('clients.index'); 
    }

    public function show(Clients $clients)
    {
        //
    }


    public function edit( $id)
    {
        $clients = Clients::find($id);

        $locals = Local::all();
        $states = States::all();
        $work = Work::all();
        $administrativeUnit = AdministrativUnit::all();

        if (!$clients) {
            
            session()->flash('error','Not found!');

            return redirect()->route('clients.index');  
        }
        return view('dashboard.clients.edit' ,compact('clients','locals','states','administrativeUnit','work'));
    }


    public function update(Request $request, $id)
    {
        $clients = Clients::find($id);

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
   
           return redirect()->route('clients.index'); 
    }


    public function destroy( $id)
    {
        Clients::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('clients.index');
    }
}
