<?php

namespace App\Http\Controllers;

use App\Models\Lawyers;
use Illuminate\Http\Request;

class LawyersController extends Controller
{

    public function index()
    {
        $lawyers = Lawyers::all();
        return view ('dashboard.lawyers.index' ,compact('lawyers'));
    }

    public function create()
    {
        return view ('dashboard.lawyers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'phone_no' => 'required',
            'lawyer_name' => 'required|max:35',
        ]);

     $request_data = $request->except(['_token']);

     Lawyers::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('lawyers.index');  
    }


    public function show(Lawyers $lawyers)
    {
        //
    }


    public function edit( $id)
    {
        $lawyers = Lawyers::find($id);

        if (!$lawyers) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('lawyers.index');  
        }
        return view('dashboard.lawyers.edit' ,compact('lawyers'));
    }


    public function update(Request $request,  $id)
    {
        $lawyer_data = Lawyers::find($id);

        $request->validate([
            'lawyer_name' => 'required|max:35',
        ]);

        $request_data = $request->except(['_token']);

        $lawyer_data->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('lawyers.index'); 
    }

    public function destroy( $id)
    {
        Lawyers::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('lawyers.index');
    }
}
