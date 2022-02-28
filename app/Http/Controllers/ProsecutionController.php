<?php

namespace App\Http\Controllers;

use App\Models\Prosecution;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\CustomerTo;
use App\Models\ProseText;
use App\Models\CauseLawsuit;
use App\Models\Local;
use App\Models\States;
use App\Models\AdministrativUnit;

class ProsecutionController extends Controller
{

    public function index()
    {
        $months = Prosecution::all('month');

        $customers = Customers::all();
        $customerTo = CustomerTo::all();
        $proseText = ProseText::all();
        $causeLawsuit = CauseLawsuit::all();

        $prosecution = Prosecution::with('Customer','CustomerTo' ,'ProseText' ,'CauseLawsuit','User')->paginate(PAGINATION_COUNT);
        return view ('dashboard.prosecution.index' ,compact('prosecution','customers','customerTo','proseText','causeLawsuit','months'));
    }


    public function create()
    {
        $customers = Customers::all();
        $customerTo = CustomerTo::all();
        $proseText = ProseText::all();
        $causeLawsuit = CauseLawsuit::all();
        return view ('dashboard.prosecution.create' ,compact('customers',
        'customerTo','proseText','causeLawsuit'));
    }

 
    public function store(Request $request)
    {
        // return auth()->user()->id;

        $request_data = $request->except(['_token']);
        $request->validate([
            'prose_date' => 'required',
            'customer_name' => 'required',
            'customerTo_name' => 'required',
            'prose_text_name' => 'required',
            'prose_type' => 'required',
            'cause_lawsuit_name' => 'required',
        ]);

        Prosecution::create([
            'prose_date' => $request_data['prose_date'],
            'customer_name' => $request_data['customer_name'],
            'customerTo_name' => $request_data['customerTo_name'],
            'prose_text_name' =>$request_data['prose_text_name'],
            'prose_type' => $request_data['prose_type'],
            'cause_lawsuit_name' => $request_data['cause_lawsuit_name'],
            'user_no' => auth()->user()->id,
            'month' => date('m'),
            'year' => date('Y'),
        ]);



        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('prosecution.index');  
    }


    public function show(Prosecution $prosecution)
    {
        //
    }


    public function edit( $id)
    {
        $prosecution = Prosecution::find($id);

        if (!$prosecution) {
            
            session()->flash('error',__('Not found (:'));

            return redirect()->route('prosecution.index');  
        }

        $customers = Customers::all();
        $customerTo = CustomerTo::all();
        $proseText = ProseText::all();
        $causeLawsuit = CauseLawsuit::all();
        return view ('dashboard.prosecution.edit' ,compact('prosecution','customers','customerTo','proseText','causeLawsuit'));
    }


    public function update(Request $request,  $id)
    {
        $prosecution = Prosecution::find($id);

        $request_data = $request->except(['_token']);

        $request->validate([
            'prose_date' => 'required',
            'customer_name' => 'required',
            'customerTo_name' => 'required',
            'prose_text_name' => 'required',
            'prose_type' => 'required',
            'cause_lawsuit_name' => 'required',

        ]);

       $prosecution->update([
            'prose_date' => $request_data['prose_date'],
            'customer_name' => $request_data['customer_name'],
            'customerTo_name' => $request_data['customerTo_name'],
            'prose_text_name' =>$request_data['prose_text_name'],
            'prose_type' => $request_data['prose_type'],
            'cause_lawsuit_name' => $request_data['cause_lawsuit_name'],
            'user_no' => auth()->user()->id,
        ]);

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('prosecution.index'); 
    }


    public function destroy( $id)
    {
        Prosecution::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('prosecution.index');
    }

    public function byMonth(Request $request)
    {

        try {
            
            $request_data = $request->except(['_token','_method']);

            $months = Prosecution::all('month');
    
            $query = Prosecution::select('*');
            
    
             $query->whereBetween('month',[$request->month_from , $request->month_to])->get();
    
                $customers = Customers::all();
                $customerTo = CustomerTo::all();
                $proseText = ProseText::all();
                $causeLawsuit = CauseLawsuit::all();
               
                 $prosecution = $query->with('Customer','CustomerTo' ,'ProseText' ,'CauseLawsuit','User')->paginate(PAGINATION_COUNT);
                return view ('dashboard.prosecution.index' ,compact('prosecution','customers','customerTo','proseText','causeLawsuit' ,'months'));

        } catch (\Throwable $th) {
            
            return $th;
        }
        
    }


    public function byBroseType(Request $request)
    {

        $request_data = $request->except(['_token','_method']);

        $months = Prosecution::all('month');

        $query = Prosecution::select('*');

         $prosecution = $query->whereBetween('month',[$request->month_from ,
         $request->month_to])->where('prose_type' ,$request->prose_type)->get();

         $customers = Customers::all();
         $customerTo = CustomerTo::all();
         $proseText = ProseText::all();
         $causeLawsuit = CauseLawsuit::all();
        
          $prosecution = $query->with('Customer','CustomerTo' ,'ProseText' ,'CauseLawsuit','User')->paginate(PAGINATION_COUNT);
         return view ('dashboard.prosecution.index' ,compact('prosecution','customers','customerTo','proseText','causeLawsuit' ,'months'));

         
    }


    public function getByCustomer(Request $request)
    {
        // return $request;

        $request_data = $request->except(['_token','_method']);

        $months = Prosecution::all('month');

        $query = Prosecution::select('*');

        $print_data = Prosecution::with('Customer','CustomerTo' ,'ProseText' ,'CauseLawsuit','User')->paginate(PAGINATION_COUNT);

        $query->whereBetween('month',[$request->month_from ,
        $request->month_to])->where('customer_name' ,$request->customer_name)->get();

        $customers = Customers::all();
        $customerTo = CustomerTo::all();
        $proseText = ProseText::all();
        $causeLawsuit = CauseLawsuit::all();

        $prosecution = $query->with('Customer','CustomerTo' ,'ProseText' ,'CauseLawsuit','User')->paginate(PAGINATION_COUNT);
        return view ('dashboard.prosecution.getByCustomer' ,compact('prosecution','customers','customerTo','proseText','causeLawsuit' ,'months'));


    }



    public function print($id)
    {
        $print_data = Prosecution::with('Customer','CustomerTo' ,'ProseText' ,'CauseLawsuit','User')->find($id);

        $state = States::find($print_data->Customer->state_name);
        $local = Local::find($print_data->Customer->local_name);

        $stateTo = States::find($print_data->CustomerTo->state_name);
        $localTo = Local::find($print_data->CustomerTo->state_name);

        $administrativUnit = AdministrativUnit::find($print_data->Customer->administrative_unit_name );

        $administrativUnitTo = AdministrativUnit::find($print_data->CustomerTo->administrative_unit_name );

        if (!$print_data) {

            session()->flash('error','(: Not found ');

            return redirect()->route('home'); 
        }

        return view('dashboard.pintThis' ,compact('print_data' ,'state' ,'local','stateTo','localTo','administrativUnit','administrativUnitTo'));
    }

    public function printCustomer($id)
    {
        $print_data = Prosecution::with('Customer','CustomerTo' ,'ProseText' ,'CauseLawsuit','User')->find($id);

        $state = States::find($print_data->Customer->state_name);
        $local = Local::find($print_data->Customer->local_name);

        $stateTo = States::find($print_data->CustomerTo->state_name);
        $localTo = Local::find($print_data->CustomerTo->state_name);

        $administrativUnit = AdministrativUnit::find($print_data->Customer->administrative_unit_name );

        $administrativUnitTo = AdministrativUnit::find($print_data->CustomerTo->administrative_unit_name );
    
        if (!$print_data) {

            session()->flash('error','(: Not found ');

            return redirect()->route('home'); 
        }

        return view('dashboard.pintCustomer' ,compact('print_data' ,'state' ,'local','stateTo','localTo','administrativUnit','administrativUnitTo'));
    }

    public function getBySubject(Request $request)
    {

        $request_data = $request->except(['_token','_method']);

        $query = Prosecution::select('*');

        $all_prosecution = $query->whereBetween('month',[$request->month_from ,
         $request->month_to])->where('prose_text_name' ,$request->prose_text_name)->get();

        $count = Prosecution::where('prose_text_name',$request->prose_text_name)->count();


        $total = $all_prosecution->count() / $count * 100;

         return view ('dashboard.pintThis' ,compact('all_prosecution','total'));

         
    }

    public function byAllMonth(Request $request)
    {
        $request_data = $request->except(['_token','_method']);

        $query = Prosecution::select('*');

        $all_prosecutionBytotal = $query->whereBetween('month',[$request->month_from ,
        $request->month_to])->get();

        $count = Prosecution::where('month',$request->prose_text_name)->count();

        $total = $all_prosecutionBytotal->count() / $query->count() * 100;

        return view ('dashboard.pintThis' ,compact('all_prosecutionBytotal','total'));
    }

    public function getBySubjectByTotal(Request $request)
    {
        $request_data = $request->except(['_token','_method']);

        $query = Prosecution::select('*');

        $all_prosecutionSubject = $query->whereBetween('month',[$request->month_from ,
         $request->month_to])->where('prose_type' ,$request->prose_type)->get();

        $count = Prosecution::where('prose_type',$request->prose_type)->count();


        $total = $all_prosecutionSubject->count() / $count * 100;

         return view ('dashboard.pintThis' ,compact('all_prosecutionSubject','total'));
    }
}
