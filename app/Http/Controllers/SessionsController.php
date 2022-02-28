<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use Illuminate\Http\Request;

use App\Models\Prosecution;
use App\Models\Courts;
use App\Models\Lawyers;
use App\Models\Judges;
use App\Models\Customers;
use App\Models\CustomerTo;

class SessionsController extends Controller
{

    public function index()
    {

        $months = Sessions::all('month');
         $days = Sessions::all('day');
        
        $sessions = Sessions::with('Prosecutions','Courts' ,'Lawyers' ,'Judge','User')->get();

        if (isset($sessions) && $sessions->count() > 0) {
            
            foreach ($sessions as  $value) {

                $lawyerTo = Lawyers::find($value->lawyerTo_name);
    
            }

        }elseif (isset($sessions) && $sessions->count() <= 0) {
            
             $lawyerTo = "لا يوجد";
        }



        return view ('dashboard.sessions.index',compact('sessions','lawyerTo','months','days'));
    }

 
    public function create()
    {
        $prosecutions = Prosecution::all();
        $courts = Courts::all();
        $lawyers = Lawyers::all();
        $judge = Judges::all();

        return view ('dashboard.sessions.create' ,compact('prosecutions','courts','lawyers','judge'));
    }


    public function store(Request $request)
    {
        $request_data = $request->except(['_token']);
        $request->validate([
            'session_date' => 'required',
            'session_time' => 'required',
            'prose_date'  => 'required',
            'court_name'=> 'required',
            'lawyer_name'=> 'required',
            'lawyerTo_name' => 'required',
            'judge_name'=> 'required',
          'end_decision'=> 'required',
        ]);

        Sessions::create([
            'session_time' => $request_data['session_time'],
            'session_date' => $request_data['session_date'],
            'prose_date' => $request_data['prose_date'],
            'court_name' =>$request_data['court_name'],
            'lawyer_name' => $request_data['lawyer_name'],
            'lawyerTo_name' => $request_data['lawyerTo_name'],
            'judge_name' => $request_data['judge_name'],
            'session_decision' => $request_data['session_decision'],
            
            'end_decision' => $request_data['end_decision'],
            'command' => $request_data['command'],
            'user_no' => auth()->user()->id,
            'month' => date('m'),
            'year' => date('Y'),
            'day' => date('d'),
        ]);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('sessions.index');  
    }


    public function show(Sessions $sessions)
    {
        //
    }


    public function edit( $id)
    {

        $sessions = Sessions::find($id);

        if (!$sessions) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('sessions.index');  
        }

        $prosecutions = Prosecution::all();
        $courts = Courts::all();
        $lawyers = Lawyers::all();
        $judge = Judges::all();

        return view ('dashboard.sessions.edit' ,compact('sessions','prosecutions','courts','lawyers','judge'));
    }


    public function update(Request $request,  $id)
    {
        $sessions = Sessions::find($id);
        
        $request_data = $request->except(['_token']);
        $request->validate([
            'session_date' => 'required',
            'session_time' => 'required',
            'prose_date'  => 'required',
            'court_name'=> 'required',
           'lawyer_name'=> 'required',
         'lawyerTo_name' => 'required',
            'judge_name'=> 'required',
          'end_decision'=> 'required',
        ]);

        $sessions->update([
            'session_time' => $request_data['session_time'],
            'session_date' => $request_data['session_date'],
            'prose_date' => $request_data['prose_date'],
            'court_name' =>$request_data['court_name'],
            'lawyer_name' => $request_data['lawyer_name'],
            'lawyerTo_name' => $request_data['lawyerTo_name'],
            'judge_name' => $request_data['judge_name'],
            'session_decision' => $request_data['session_decision'],
            
            'end_decision' => $request_data['end_decision'],
            'command' => $request_data['command'],
            
            'user_no' => auth()->user()->id,
        ]);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('sessions.index');  
    }


    public function destroy( $id)
    {
        Sessions::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('sessions.index');
    }

    public function byMonth(Request $request)
    {

        try {
            
            $request_data = $request->except(['_token','_method']);

            $months = Sessions::all('month');
            $days = Sessions::all('day');
               
            $query = Sessions::select('*');
            
    
            $query->whereBetween('month',[$request->month_from , $request->month_to])->get();
    
               
                $sessions = $query->with('Prosecutions','Courts' ,'Lawyers' ,'Judge','User')->paginate(PAGINATION_COUNT);

            
                if (isset($sessions) && $sessions->count() > 0) {
            
                    foreach ($sessions as  $value) {
        
                        $lawyerTo = Lawyers::find($value->lawyerTo_name);
            
                    }
        
                }elseif (isset($sessions) && $sessions->count() <= 0) {
                    
                     $lawyerTo = "لا يوجد";
                }

                return view ('dashboard.sessions.index' ,compact('sessions','months','days','lawyerTo'));

        } catch (\Throwable $th) {
            
            return $th;
        }
        
    }

    public function byDay(Request $request)
    {

        try {
            
            $request_data = $request->except(['_token','_method']);

            $months = Sessions::all('month');
            $days = Sessions::all('day');
               
            $query = Sessions::select('*');
            
    
            // $query->whereBetween('month',[$request->month_from , $request->month_to])->get();
    
               
            $sessions = $query->with('Prosecutions','Courts' ,'Lawyers' ,'Judge','User')->where('day' , $request->day)->paginate(PAGINATION_COUNT);

                if (isset($sessions) && $sessions->count() > 0) {
            
                    foreach ($sessions as  $value) {
        
                        $lawyerTo = Lawyers::find($value->lawyerTo_name);
            
                    }
        
                }elseif (isset($sessions) && $sessions->count() <= 0) {
                    
                     $lawyerTo = "لا يوجد";
                }

                return view ('dashboard.sessions.index' ,compact('sessions','months','days','lawyerTo'));

        } catch (\Throwable $th) {
            
            return $th;
        }
        
    }

    public function print($id)
    {
        $print_data = Sessions::with('Prosecutions','Courts' ,'Lawyers' ,'Judge','User')->find($id);

        if (isset($print_data) && $print_data->count() > 0) {
            
            $lawyerTo = Lawyers::find($print_data['lawyerTo_name']);
                
            $customer = Customers::find($print_data->Prosecutions->customer_name);
            $customerTo = CustomerTo::find($print_data->Prosecutions->customerTo_name);

        }elseif (isset($print_data) && $print_data->count() <= 0) {
            
             $lawyerTo = "لا يوجد";
        }

        if (!$print_data) {

            session()->flash('error','(: Not found ');

            return redirect()->route('home'); 
        }

        return view('dashboard.sessions.pintThis' ,compact('print_data','lawyerTo','customer','customerTo'));
    }
}
