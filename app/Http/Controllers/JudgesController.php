<?php

namespace App\Http\Controllers;

use App\Models\Judges;
use Illuminate\Http\Request;

class JudgesController extends Controller
{

    public function index()
    {
        $judges = Judges::all();
        return view ('dashboard.judges.index' ,compact('judges'));
    }

    public function create()
    {
        return view ('dashboard.judges.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:35',
            'phone' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     Judges::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('judges.index');  
    }

 
    public function show(Judges $judges)
    {
        //
    }


    public function edit( $id)
    {
        $judges = Judges::find($id);

        if (!$judges) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('judges.index');  
        }
        return view('dashboard.judges.edit' ,compact('judges'));
    }


    public function update(Request $request, $id)
    {
        $judges = Judges::find($id);

        $request->validate([
            'name' => 'required|max:35',
            'phone' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $judges->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('judges.index'); 
    }


    public function destroy( $id)
    {
        $judges = Judges::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('dashboard.judges.index'); 
    }
}
