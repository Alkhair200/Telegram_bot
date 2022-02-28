<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

use App\Models\ContractSubject;
use App\Models\CustomerTo;
use App\Models\Customers;
use App\Models\Witness;

use App\Models\States;
use App\Models\Local;
use App\Models\AdministrativUnit;

class ContractController extends Controller
{

    public function index()
    {
        $months = Contract::all('month');

        $contract = Contract::with('Customers','CustomerTo','Witness','ContractSubject','User')->get();

        if (isset($contract) && $contract->count() > 0) {
            
            foreach ($contract as $key => $value) {
            
                $witness = Witness::find($value->first_witness_no);
    
                $witnessTo = Witness::find($value->second_witness_no);

            }

        } else {
            
            $witness = "لا يوجد" ;
            $witnessTo = "لا يوجد" ;

        }
        
        return view ('dashboard.contract.index' ,compact('contract','witnessTo','witness','months'));
    }


    public function create()
    {

        $contractSubject = ContractSubject::all();
        $customerTo = CustomerTo::all();
        $customers = Customers::all();
        $witness = Witness::all();

        return view ('dashboard.contract.create', compact('contractSubject','customerTo','customers','witness'));
    }

 
    public function store(Request $request)
    {
        $request->validate([
            'contract_date' => 'required',
            'contract_subject' => 'required',
            'first_side_no' => 'required',
            'second_side_no' => 'required',
            'first_witness_no' => 'required',
            'second_witness_no' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $request_data['user_no'] = auth()->user()->id;

     Contract::create([
        'contract_date' => $request_data['contract_date'],
        'contract_subject' => $request_data['contract_subject'],
        'first_side_no' =>$request_data['first_side_no'],
        'second_side_no' => $request_data['second_side_no'],
        'first_witness_no' => $request_data['first_witness_no'],
        'second_witness_no' => $request_data['second_witness_no'],
        'command' => $request_data['command'],
        'user_no' => $request_data['user_no'],
        'month' => date('m'),
     ]);

        session()->flash('success',__('site.created_successfully'));

        return redirect()->route('contract.index');
         
    }


    public function show(Contract $contract)
    {
        //
    }


    public function edit( $id)
    {
        $contract = Contract::find($id);

        $contractSubject = ContractSubject::all();
        $customerTo = CustomerTo::all();
        $customers = Customers::all();
        $witness = Witness::all();

            
        $witnessTo = Witness::find($contract['second_witness_no']);


        if (!$contract) {
            
            session()->flash('error','Not found!');

            return redirect()->route('contract.index');  
        }
        return view('dashboard.contract.edit' ,compact('customers','customerTo','contract','contractSubject','witness','witnessTo'));
    }


    public function update(Request $request,  $id)
    {
        $contract = Contract::find($id);

        $request->validate([
            'contract_date' => 'required',
            'contract_subject' => 'required',
            'first_side_no' => 'required',
            'second_side_no' => 'required',
            'first_witness_no' => 'required',
            'second_witness_no' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $request_data['user_no'] = auth()->user()->id;

     $contract->update([
        'contract_date' => $request_data['contract_date'],
        'contract_subject' => $request_data['contract_subject'],
        'first_side_no' =>$request_data['first_side_no'],
        'second_side_no' => $request_data['second_side_no'],
        'first_witness_no' => $request_data['first_witness_no'],
        'second_witness_no' => $request_data['second_witness_no'],
        'command' => $request_data['command'],
        'user_no' => $request_data['user_no'],
     ]);

     

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('contract.index');

    }


    public function destroy( $id)
    {
        Contract::find($id)->delete();

        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('contract.index');
    }

    public function byMonth(Request $request)
    {

        try {

            if ($request->month_from != "" && $request->month_to != "") {
                
                $request_data = $request->except(['_token','_method']);

                $months = Contract::all('month');

                $contractSubject = Contract::all('contract_subject');
                   
                $query = Contract::select('*');
                
        
                $query->whereBetween('month',[$request->month_from , $request->month_to])->get();
        
                   
                    $contract = $query->with('Customers','CustomerTo','Witness','ContractSubject')->paginate(PAGINATION_COUNT);
    
                    foreach ($contract as $value) {
                        
                        $witness = Witness::find($value->first_witness_no);
                        $witnessTo = Witness::find($value->second_witness_no);

                    }
    
                    return view ('dashboard.contract.index' ,compact('contract','months','witness','witnessTo'));

            }else {

                session()->flash('error','لا يوجد بيانات');
                return redirect()->route('contract.index');
            }
            

        } catch (\Throwable $th) {
            
            return $th;
        }
        
    }

    public function contractType(Request $request)
    {
        try {

            if ($request->month_from != "" && $request->month_to != "") {
                
                $request_data = $request->except(['_token','_method']);

                $months = Contract::all('month');

                $contractSubject = Contract::all('contract_subject');
                   
                $query = Contract::select('*');
                
        
                $query->whereBetween('month',[$request->month_from , $request->month_to])->get();
        
                   
                $contract = $query->with('Customers','CustomerTo','Witness','ContractSubject')->where('contract_subject' , $request->contract_subject)->paginate(PAGINATION_COUNT);
    
                    foreach ($contract as $value) {
                        
                        $witness = Witness::find($value->first_witness_no);
                        $witnessTo = Witness::find($value->second_witness_no);

                    }
    
                    return view ('dashboard.contract.index' ,compact('contract','months','witness','witnessTo'));

            }else {

                session()->flash('error','لا يوجد بيانات');
                return redirect()->route('contract.index');
            }
            

        } catch (\Throwable $th) {
            
            return $th;
        }
    }

    public function contractByType(Request $request)
    {

        $request_data = $request->except(['_token','_method']);

        $query = Contract::select('*');

        $all_contract = $query->whereBetween('month',[$request->month_from ,
         $request->month_to])->with('ContractSubject')->where('contract_subject' ,$request->contract_subject)->get();

        $count = Contract::where('contract_subject',$request->contract_subject)->count();


        $total = $all_contract->count() / $count * 100;

         return view ('dashboard.contract.printThis' ,compact('all_contract','total'));
    }

    public function print($id)
    {
        $print_data = Contract::with('Customers','CustomerTo','Witness','ContractSubject')->find($id);

        if (!$print_data) {

            session()->flash('error','(: Not found ');

            return redirect()->route('home'); 
        }
            
            $witness_data = Witness::find($print_data->first_witness_no);

            $local = Local::find($witness_data['local_name']);
            $state = States::find($witness_data['state_name']);
            $administrativUnit = AdministrativUnit::find($witness_data['administrative_unit_name']);

            $witness['witness_name'] = $witness_data['witness_name'];
            $witness['personal_identity_no'] = $witness_data['personal_identity_no'];
            $witness['state_name'] = $state['state_name'];
            $witness['local_name'] = $local['local_name'];
            $witness['administrative_unit_name'] = $administrativUnit['administrative_unit_name'];
    
            
            $witnesTo = Witness::find($print_data->second_witness_no);

            $local = Local::find($witnesTo['local_name']);
            $state = States::find($witnesTo['state_name']);
            $administrativUnit = AdministrativUnit::find($witnesTo['administrative_unit_name']);

            $witnessTo['witness_name'] = $witness_data['witness_name'];
            $witnessTo['personal_identity_no'] = $witness_data['personal_identity_no'];
            $witnessTo['state_name'] = $state['state_name'];
            $witnessTo['local_name'] = $local['local_name'];
            $witnessTo['administrative_unit_name'] = $administrativUnit['administrative_unit_name'];
            

            $customer_data = Customers::find($print_data->first_side_no);

            $local = Local::find($customer_data['local_name']);
            $state = States::find($customer_data['state_name']);
            $administrativUnit = AdministrativUnit::find($customer_data['administrative_unit_name']);
            
            $customer['customer_name'] = $customer_data['customer_name'];
            $customer['personal_identity_no'] = $customer_data['personal_identity_no'];
            $customer['state_name'] = $state['state_name'];
            $customer['local_name'] = $local['local_name'];
            $customer['administrative_unit_name'] = $administrativUnit['administrative_unit_name'];

            $customer_dataTo = Customers::find($print_data->second_side_no);

            $local = Local::find($customer_dataTo['local_name']);
            $state = States::find($customer_dataTo['state_name']);
            $administrativUnit = AdministrativUnit::find($customer_dataTo['administrative_unit_name']);
            
            $customerTo['customer_name'] = $customer_dataTo['customer_name'];
            $customerTo['personal_identity_no'] = $customer_dataTo['personal_identity_no'];
            $customerTo['state_name'] = $state['state_name'];
            $customerTo['local_name'] = $local['local_name'];
            $customerTo['administrative_unit_name'] = $administrativUnit['administrative_unit_name'];

            return view ('dashboard.contract.printThis' ,compact('print_data','customer','customerTo','witness','witnessTo'));    }
}
