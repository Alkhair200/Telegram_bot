<?php

namespace App\Http\Controllers;

use App\Models\ProseText;
use Illuminate\Http\Request;

class ProseTextController extends Controller
{

    public function index()
    {
        $proseText = ProseText::all();
        return view ('dashboard.proseText.index' ,compact('proseText'));
    }

 
    public function create()
    {
        return view ('dashboard.proseText.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'prose_text_name' => 'required|max:30',
        ]);

     $request_data = $request->except(['_token']);

     ProseText::create($request_data);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('proseText.index'); 
    }

  
    public function show(ProseText $proseText)
    {
        //
    }


    public function edit( $id)
    {
        $proseText = ProseText::find($id);

        if (!$proseText) {
            
            session()->flash('error','Not found!');

            return redirect()->route('proseText.index');  
        }
        return view('dashboard.proseText.edit' ,compact('proseText'));
    }


    public function update(Request $request, $id)
    {
        $proseText = ProseText::find($id);
        $request->validate([
            'prose_text_name' => 'required|max:30',
        ]);

     $request_data = $request->except(['_token']);

     $proseText->update($request_data);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('proseText.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProseText  $proseText
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        ProseText::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('proseText.index');
    }
}
