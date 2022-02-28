<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use App\Models\Prosecution;
use Illuminate\Http\Request;

use App\Models\Customers;
use App\Models\CustomerTo;
use App\Models\ProseText;

class AppealController extends Controller
{

    public function index()
    {

        $months = Appeal::all('month');
        $appeal = Appeal::with('Prosecution')->get();
        return view ('dashboard.appeal.index' ,compact('appeal','months'));
    }


    public function create()
    {
        $prosecution = Prosecution::all();
        return view ('dashboard.appeal.create' ,compact('prosecution'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'appeal_date' => 'required',
            'prosecution_date' => 'required',
            'provirus_judge' => 'required',
            'appeal_judge' => 'required',
            'judge_meant_date' => 'required',

        ]);

     $request_data = $request->except(['_token']);

     Appeal::create([
         'appeal_date' => $request_data['appeal_date'],
         'prosecution_date' => $request_data['prosecution_date'],
         'provirus_judge' => $request_data['provirus_judge'],
         'appeal_judge' => $request_data['appeal_judge'],
         'judge_meant_date' => $request_data['judge_meant_date'],
         'command' => $request_data['command'],
         'month' => date('m'),
         'user_no' => auth()->user()->id,
     ]);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('appeal.index');  
    }


    public function show(Appeal $appeal)
    {
        //
    }


    public function edit( $id)
    {
        $appeal = Appeal::find($id);
        $prosecution = Prosecution::all();

        if (!$appeal) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('appeal.index');  
        }
        return view('dashboard.appeal.edit' ,compact('appeal','prosecution'));
    }


    public function update(Request $request, $id)
    {
        $appeal = Appeal::find($id);

        $request->validate([
            'appeal_date' => 'required',
            'prosecution_date' => 'required',
            'provirus_judge' => 'required',
            'appeal_judge' => 'required',
            'judge_meant_date' => 'required',

        ]);

     $request_data = $request->except(['_token']);

     $appeal->update([
         'appeal_date' => $request_data['appeal_date'],
         'prosecution_date' => $request_data['prosecution_date'],
         'provirus_judge' => $request_data['provirus_judge'],
         'appeal_judge' => $request_data['appeal_judge'],
         'judge_meant_date' => $request_data['judge_meant_date'],
         'command' => $request_data['command'],
         'user_no' => auth()->user()->id,
     ]);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('appeal.index'); 
    }


    public function destroy( $id)
    {
        Appeal::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('appeal.index');
    }

    public function byMonth(Request $request)
    {

        try {
            
            $request_data = $request->except(['_token','_method']);

            $months = Appeal::all('month');
               
            $query = Appeal::select('*');
            
    
            $query->whereBetween('month',[$request->month_from , $request->month_to])->get();
    
               
                $appeal = $query->with('Prosecution')->paginate(PAGINATION_COUNT);


                return view ('dashboard.appeal.index' ,compact('appeal','months'));

        } catch (\Throwable $th) {
            
            return $th;
        }
        
    }

    public function print($id)
    {
        $print_data = Appeal::with('Prosecution')->find($id);

        if (!$print_data) {

            session()->flash('error','(: Not found ');

            return redirect()->route('home'); 
        }

        if (isset($print_data) && $print_data->count() > 0) {
            
                
            $customer = Customers::find($print_data->Prosecution->customer_name);
            $customerTo = CustomerTo::find($print_data->Prosecution->customerTo_name);
            $proseText = ProseText::find($print_data->Prosecution->prose_text_name);

        }

        return view('dashboard.appeal.pintThis' ,compact('print_data','customer','customerTo','proseText'));
    }
}
