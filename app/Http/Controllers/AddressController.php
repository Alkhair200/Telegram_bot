<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function index()
    {
        $address = Address::all();
        return view ('dashboard.address.index' ,compact('address'));
    }


    public function create()
    {
        return view ('dashboard.address.create');
    }


    public function store(Request $request)
    {
        $request->validate([

            'address_text' => 'required|max:120',
        ]);

     $request_data = $request->except(['_token']);

     Address::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('address.index');
    }


    public function show(Address $address)
    {
        //
    }


    public function edit( $id)
    {
        $address = Address::find($id);

        if (!$address) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('address.index');  
        }
        return view('dashboard.address.edit' ,compact('address'));
    }


    public function update(Request $request,  $id)
    {
        $address = Address::find($id);
        
        $request->validate([

            'address_text' => 'required|max:120',
        ]);

     $request_data = $request->except(['_token']);

     $address->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('address.index');
    }

    public function destroy( $id)
    {
        Address::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('address.index'); 
    }
}
