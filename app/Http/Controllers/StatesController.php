<?php

namespace App\Http\Controllers;

use App\Models\States;
use Illuminate\Http\Request;

class StatesController extends Controller
{

    public function index()
    {
        $states = States::paginate(PAGINATION_COUNTBU);
        return view ('dashboard.states.index' ,compact('states'));
    }


    public function create()
    {
        return view ('dashboard.states.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            // 'state_no' => 'required',
            'state_name' => 'required|max:30',
        ]);

     $request_data = $request->except(['_token']);

        States::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('states.index');  
    }

  
    public function show(States $states)
    {
        //
    }


    public function edit(States $states ,$id)
    {
        $state = $states->find($id);

        if (!$state) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('states.index');  
        }
        return view('states.edit' ,compact('state'));
    }


    public function update(Request $request, States $states ,$id)
    {
        $state = $states->find($id);

        $request->validate([
            'state_name' => 'required|max:30',
        ]);

        $request_data = $request->except(['_token']);

        $state->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('states.index');  
    }


    public function destroy(States $states ,$id)
    {
        $state = $states->find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('dashboard.states.index'); 
    }
}
