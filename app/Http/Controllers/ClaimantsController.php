<?php

namespace App\Http\Controllers;

use App\Models\Claimants;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Work;

class ClaimantsController extends Controller
{

    public function index()
    {
        $claimants = Claimants::all();
        $customers = Customers::all();
        $works = Work::all();
        return view ('dashboard.claimants.index' ,compact('claimants' ,'customers' ,'works'));
    }


    public function create()
    {
        $customers = Customers::all();
        $works = Work::all();
        return view ('dashboard.claimants.create' ,compact('customers','works'));
    }


    public function store(Request $request)
    {
        // return auth()->user()->id;

        $request->validate([
            'work_date' => 'required',
            'customer_no' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     Claimants::create([
         'customer_no' => $request_data,
         'work_date' => $request_data,
         'work_no' => $request_data,
         'user_date' => auth()->user()->id,
     ]);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('claimants.index');  
    }


    public function show(Claimants $claimants)
    {
        //
    }


    public function edit( $id)
    {
        $claimant = Claimants::find($id);

        if (!$claimant) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('claimants.index');  
        }
        return view('dashboard.claimants.edit' ,compact('claimant'));
    }


    public function update(Request $request, $id)
    {
        $claimant = Claimants::find($id);

        $request->validate([
            'work_date' => 'required',
            'customer_no' => 'required',
            'user_date' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $claimant->create($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('claimants.index'); 
    }


    public function destroy( $id)
    {
        Claimants::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('claimants.index');
    }
}
