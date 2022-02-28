<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\States;
use App\Models\Local;
use App\Models\AdministrativUnit;

use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $locals = Local::all();
        $states = States::all();
        $customers = Customers::with('local','state','administrative')->get();
        return view ('dashboard.customers.index' ,compact('customers','locals' ,'states'));
    }

 
    public function create()
    {
        $locals = Local::all();
        $states = States::all();
        $administrativeUnit = AdministrativUnit::all();
        return view ('dashboard.customers.create' ,compact('administrativeUnit','locals' ,'states'));
    }


    public function store(Request $request)
    {
        // return$request;
        $request->validate([
            'customer_name' => 'required|max:35',
            'gender' => 'required',
            'personal_identity_type' => 'required',
            'personal_identity_no' => 'required',
            'phone_no' => 'required',
            'state_name' => 'required',
            'local_name' => 'required',
            'administrative_unit_name' => 'required',

        ]);

     $request_data = $request->except(['_token']);

     Customers::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('customers.index'); 
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

        $customer = Customers::find($id);

        if (!$customer) {
            
            session()->flash('error','Not found!');

            return redirect()->route('customers.index');  
        }
        return view('dashboard.customers.edit' ,compact('customer','locals','states','administrativeUnit'));
    }


    public function update(Request $request, $id)
    {
        $customer = Customers::find($id);

        $request->validate([
            'customer_name' => 'required|max:35',
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

        return redirect()->route('customers.index'); 
    }


    public function destroy( $id)
    {
        Customers::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('customers.index');
    }
}
