<?php

namespace App\Http\Controllers;

use App\Models\ContractSubject;
use Illuminate\Http\Request;

class ContractSubjectController extends Controller
{

    public function index()
    {
        $contractSub = ContractSubject::all();
        return view ('dashboard.contractSubject.index' ,compact('contractSub'));
    }

    public function create()
    {
        return view ('dashboard.contractSubject.create' );
    }


    public function store(Request $request)
    {
        $request->validate([
            'contract_subject_name' => 'required|max:30',
        ]);

     $request_data = $request->except(['_token']);

     ContractSubject::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('contractSubject.index'); 
    }


    public function show(ContractSubject $contractSubject)
    {
        //
    }

    public function edit( $id)
    {
        $contractSub = ContractSubject::find($id);

        if (!$contractSub) {
            
            session()->flash('error','Not found!');

            return redirect()->route('contractSubject.index');  
        }
        return view('dashboard.contractSubject.edit' ,compact('contractSub'));
    }


    public function update(Request $request, $id)
    {
        $contractSub = ContractSubject::find($id);

        $request->validate([
            'contract_subject_name' => 'required|max:30',
        ]);

     $request_data = $request->except(['_token']);

     $contractSub->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('contractSubject.index'); 
    }

    public function destroy( $id)
    {
        ContractSubject::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('contractSubject.index');
    }
}
