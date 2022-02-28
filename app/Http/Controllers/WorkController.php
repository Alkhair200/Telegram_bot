<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{

    public function index()
    {
        $works = Work::all();
        return view ('dashboard.work.index' ,compact('works'));
    }

    public function create()
    {
        return view ('dashboard.work.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'work_name' => 'required|max:35',
        ]);

     $request_data = $request->except(['_token']);

     Work::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('work.index'); 
    }

 
    public function show(work $work)
    {
        //
    }

    public function edit( $id)
    {

        $work = Work::find($id);

        if (!$work) {
            
            session()->flash('error','Not found!');

            return redirect()->route('work.index');  
        }
        return view('dashboard.work.edit' ,compact('work'));
    }


    public function update(Request $request,  $id)
    {
        $work = Work::find($id);
        $request->validate([
            'work_name' => 'required|max:35',
        ]);

     $request_data = $request->except(['_token']);

     $work->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('work.index'); 
    }


    public function destroy( $id)
    {
        Work::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('work.index');
    }
}
