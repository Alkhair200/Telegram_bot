<?php

namespace App\Http\Controllers;

use App\Models\sessionWitness;
use Illuminate\Http\Request;

use App\Models\Sessions;
use App\Models\Prosecution;
use App\Models\Witness;

class sessionsWitnessController extends Controller
{

    public function index()
    {

        $sessionWitness = sessionWitness::with('Prosecutions','Sessions' ,'Witness')->get();

        // foreach ($sessions as  $value) {

        //     $lawyerTo = Lawyers::find($value->lawyerTo_name);
        // }


        return view ('dashboard.sessionWitness.index',compact('sessionWitness'));
    }


    public function create()
    {
        $sessions = Sessions::all();
        $prosecution = Prosecution::all();
        $witness = Witness::all();
        return view ('dashboard.sessionWitness.create',compact('sessions','prosecution','witness'));
    }


    public function store(Request $request)
    {
        $request_data = $request->except(['_token']);

        $request->validate([
            'prose_date' => 'required',
            'witness_name' => 'required',
            'witch_witness' => 'required',
            
        ]);

        sessionWitness::create([
            'prose_date' => $request_data['prose_date'],
            'witness_name' => $request_data['witness_name'],
            'witch_witness' => $request_data['witch_witness'],
            'user_no' => auth()->user()->id,
        ]);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('sessionWitness.index'); 
    }


    public function show(sessionWitness $sessionWitness)
    {
        //
    }


    public function edit( $id)
    {
        $sessionWitness = sessionWitness::find($id);

        if (!$sessionWitness) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('sessionWitness.index');  
        }

        $sessions = Sessions::all();
        $prosecution = Prosecution::all();
        $witness = Witness::all();
        return view ('dashboard.sessionWitness.create',compact('sessionWitness','prosecution','witness','sessions'));
    }


    public function update(Request $request, sessionWitness $sessionWitness)
    {
        $sessionWitness = sessionWitness::find($id);

        $request->validate([
            'prose_date' => 'required',
            'witness_name' => 'required',
            'witch_witness' => 'required',
            
        ]);

        $sessionWitness->update([
            'prose_date' => $request_data['prose_date'],
            'witness_name' => $request_data['witness_name'],
            'witch_witness' => $request_data['witch_witness'],
            'user_no' => auth()->user()->id,
        ]);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('sessionWitness.index'); 
    }


    public function destroy( $id)
    {
        sessionWitness::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('sessionWitness.index');
    }
}
