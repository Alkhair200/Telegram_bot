<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;

class MessagesController extends Controller
{

    public function index()
    {
        $messages = Messages::all();
        return view ('dashboard.messages.index' ,compact('messages'));
    }


    public function create()
    {
        return view ('dashboard.messages.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'messages_text' => 'required|max:120',
        ]);

     $request_data = $request->except(['_token']);

     Messages::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('messages.index');
    }

    public function show(Messages $messages)
    {
        //
    }


    public function edit( $id)
    {
        $messages = Messages::find($id);

        if (!$messages) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('messages.index');  
        }
        return view('dashboard.messages.edit' ,compact('messages'));
    }


    public function update(Request $request, $id)
    {
        $messages = Messages::find($id);

        $request->validate([

            'messages_text' => 'required|max:120',
        ]);

     $request_data = $request->except(['_token']);

     $messages->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('messages.index');
    }

    public function destroy( $id)
    {
        Messages::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('messages.index'); 
    }
}
