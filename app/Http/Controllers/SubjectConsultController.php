<?php

namespace App\Http\Controllers;

use App\Models\SubjectConsult;
use Illuminate\Http\Request;


class SubjectConsultController extends Controller
{

    public function index()
    {
        $consultSubject = SubjectConsult::all();
        return view ('dashboard.consultSubject.index' ,compact('consultSubject'));
    }


    public function create()
    {

        return view ('dashboard.consultSubject.create',);
    }


    public function store(Request $request)
    {
        $request->validate([
            'consult_subject_text' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     SubjectConsult::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('consultSubject.index'); 
    }


    public function show(SubjectConsult $subjectConsult)
    {
        //
    }


    public function edit( $id)
    {
        $consultSubject = SubjectConsult::find($id);

        if (!$consultSubject) {
            
            session()->flash('error','Not found!');

            return redirect()->route('contractSubject.index');  
        }
        return view('dashboard.consultSubject.edit' ,compact('consultSubject'));
    }


    public function update(Request $request,  $id)
    {
        $consultSubject = SubjectConsult::find($id);

        $request->validate([
            'consult_subject_text' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $consultSubject->update($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('consultSubject.index');
    }


    public function destroy( $id)
    {
        SubjectConsult::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('consultSubject.index');
    }
}
