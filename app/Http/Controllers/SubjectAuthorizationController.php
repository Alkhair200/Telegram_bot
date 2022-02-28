<?php

namespace App\Http\Controllers;

use App\Models\Subject_authorization;
use Illuminate\Http\Request;

class SubjectAuthorizationController extends Controller
{

    public function index()
    {
        $subjectAuthorization = Subject_authorization::all();
        return view ('dashboard.subjectAuthorization.index' ,compact('subjectAuthorization'));
    }


    public function create()
    {
        return view ('dashboard.subjectAuthorization.create');
    }


    public function store(Request $request)
    {
        $request->validate([

            'subject_authorization_name' => 'required|max:35',
        ]);

     $request_data = $request->except(['_token']);

     Subject_authorization::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('subjectAuthorization.index');
    }


    public function show(Subject_authorization $subject_authorization)
    {
        //
    }


    public function edit( $id)
    {
        $subjectAuthorization = Subject_authorization::find($id);

        if (!$subjectAuthorization) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('subjectAuthorization.index');  
        }
        return view('dashboard.subjectAuthorization.edit' ,compact('subjectAuthorization'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([

            'subject_authorization_name' => 'required|max:35',
        ]);

        $subjectAuthorization = Subject_authorization::find($id);

        $request_data = $request->except(['_token']);

        $subjectAuthorization->update($request_data);
   
           session()->flash('success',__('site.updated_successfully'));
   
           return redirect()->route('subjectAuthorization.index');
    }

    public function destroy( $id)
    {
        Subject_authorization::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('subjectAuthorization.index');
    }
}
