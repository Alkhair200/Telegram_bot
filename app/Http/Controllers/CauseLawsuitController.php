<?php

namespace App\Http\Controllers;

use App\Models\CauseLawsuit;
use Illuminate\Http\Request;

class CauseLawsuitController extends Controller
{

    public function index()
    {
        $causeLaw = CauseLawsuit::all();
        return view ('dashboard.causeLaw.index' ,compact('causeLaw'));
    }

    public function create()
    {
        return view ('dashboard.causeLaw.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cause_law_name' => 'required|max:35',
        ]);

     $request_data = $request->except(['_token']);

     CauseLawsuit::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('causeLawsuit.index'); 
    }


    public function show(causeLawsuit $causeLawsuit)
    {
        //
    }

    public function edit( $id)
    {
        $causeLaw = causeLawsuit::find($id);

        if (!$causeLaw) {
            
            session()->flash('error','Not found!');

            return redirect()->route('causeLawsuit.index');  
        }
        return view('dashboard.causeLaw.edit' ,compact('causeLaw'));
    }


    public function update(Request $request ,$id)
    {
        $causeLaw = CauseLawsuit::find($id);

        $request->validate([
            'cause_law_name' => 'required|max:35',
        ]);

     $request_data = $request->except(['_token']);

     $causeLaw->create($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('causeLawsuit.index'); 
    }

    public function destroy( $id)
    {
        CauseLawsuit::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('causeLawsuit.index');
    }
}
