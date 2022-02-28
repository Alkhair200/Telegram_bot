<?php

namespace App\Http\Controllers;

use App\Models\CustomerTo;
use Illuminate\Http\Request;

use App\Models\States;
use App\Models\Local;
use App\Models\AdministrativUnit;

class CustomerToController extends Controller
{
  
    public function index()
    {
        $locals = Local::all();
        $states = States::all();
        $customersTo = CustomerTo::with('local','state','administrative')->get();
        return view ('dashboard.customersTo.index' ,compact('customersTo','locals' ,'states'));
    }

 
    public function create()
    {
        $locals = Local::all();
        $states = States::all();
        $administrativeUnit = AdministrativUnit::all();
        return view ('dashboard.customersTo.create' ,compact('administrativeUnit','locals' ,'states'));
    }


    public function store(Request $request)
    {
        // return$request;
        $request->validate([
            'customerTo_name' => 'required|max:35',
            'gender' => 'required',
            'personal_identity_type' => 'required',
            'personal_identity_no' => 'required',
            'phone_no' => 'required',
            'state_name' => 'required',
            'local_name' => 'required',
            'administrative_unit_name' => 'required',

        ]);

     $request_data = $request->except(['_token']);

     CustomerTo::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('customersTo.index'); 
    }


    public function show(Customers $customers)
    {
        //
    }


    public function edit( $id)
    {
        $locals = Local::all();
        $states = States::all();
        $administrativeUnit = AdministrativUnit::all();

        $customer = CustomerTo::find($id);

        if (!$customer) {
            
            session()->flash('error','Not found!');

            return redirect()->route('customers.index');  
        }
        return view('dashboard.customersTo.edit' ,compact('customer','locals','states','administrativeUnit'));
    }


    public function update(Request $request, $id)
    {
        $customer = CustomerTo::find($id);

        $request->validate([
            'customerTo_name' => 'required|max:35',
            'gender' => 'required',
            'personal_identity_type' => 'required',
            'personal_identity_no' => 'required',
            'phone_no' => 'required',
            'state_name' => 'required',
            'local_name' => 'required',
            'administrative_unit_name' => 'required',

        ]);

     $request_data = $request->except(['_token']);

     $customer->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('customersTo.index'); 
    }


    public function destroy( $id)
    {
        CustomerTo::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('customersTo.index');
    }
}
