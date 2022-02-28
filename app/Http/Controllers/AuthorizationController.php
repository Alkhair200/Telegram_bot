<?php

namespace App\Http\Controllers;

use App\Models\Authorization;
use Illuminate\Http\Request;

use App\Models\Witness;
use App\Models\Clients;
use App\Models\ClientsTo;
use App\Models\States;
use App\Models\Local;
use App\Models\AdministrativUnit;

class AuthorizationController extends Controller
{
    // كلاس التوكيلات 

    public function index()
    {
        // دالة عرض كل التوكيلات من الداتا بيز 
        $months = Authorization::all('month');

        $authorizationType = Authorization::all('authorization_type');

         $authorization = Authorization::with('Witness','Clients','ClientTo','User')->paginate(PAGINATION_COUNT);

        if (isset($authorization) && $authorization->count() > 0 ) {
            
            foreach ($authorization as $key => $value) {
            
                $witness = Witness::find($value->first_witness_no);
    
                $witnessTo = Witness::find($value->second_witness_no);
    
            }

        }else {

            $witness = "لا يوجد"; $witnessTo ="لا يوجد";
            
        }

        // رابط التوجيهه الي شاشة عرض كل التوكيلات اي الشاشه الرئيسيه للتوكيلات
        return view ('dashboard.authorization.index' ,compact('authorization','witness','witnessTo','months','authorizationType'));
    }


    // دالة عرض شاشة انشاء توكيل بعد ادخال بيانات التوكيل يتم توجيهنا الي داله حفظ البيانات 
    public function create()
    {
        $witness = Witness::all();
        $clients = Clients::all();
        $clientTo = ClientsTo::all();
        return view ('dashboard.authorization.create' ,compact('clients','clientTo','witness')); // هذا السطر يوجهك الي شاشة انشاء التوكيل
    }


    // دالة حفظ البيانات في الداتا بيز المدخله بواسطه شاشة ادخال البيانات يعني شاشة ادخال بيانات التوكيل
    public function store(Request $request)
    {
        //اي محل لقيت فيهو كلام زي دا دي عملية التحق من البيانات قبل تخزينها الجايه من شاشة ادخال البيانات دي 
        // مثلا شاشة ادخال البيانات للتوكيل سواء ادخال بيانات جديده اول تعديل علي بيانات موجوده يتم التحقق منها قبل تخزينها
        // الكلام دا موجود في اي كلاس اسي دا كلاس التوكيلات من رقم 1 لحدي اخر رقم
        $request->validate([
            'authorization_date' => 'required',
            'authorization_type' => 'required',
            'client_name' => 'required',
            'clientTo_name' => 'required',
            'authorization_subject_no' => 'required',
            'first_witness_no' => 'required',
            'second_witness_no' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $request_data['user_no'] = auth()->user()->id;

    //بعد عملية انشاء توكيل جديد من شاشة اضافة توكيل يتم توجيهنا الي هنا ويتم تخزين كل المعلومات في الداتا بيز 
     Authorization::create([
        'authorization_date' => $request_data['authorization_date'],
        'authorization_type' => $request_data['authorization_type'],
        'client_name' =>$request_data['client_name'],
        'clientTo_name' => $request_data['clientTo_name'],
        'authorization_subject_no' => $request_data['authorization_subject_no'],
        'first_witness_no' => $request_data['first_witness_no'],
        'second_witness_no' => $request_data['second_witness_no'],
        'command' => $request_data['command'],
        'month' => date('m'),
        'user_no' => $request_data['user_no'],
     ]);

    //  كود رسالة تم حفظ البانات بنجاح
        session()->flash('success',__('site.created_successfully'));

        // رابط التوجيهه الي الصفحه الرئيسيه مع رسالة النجاح 
        return redirect()->route('authorization.index');
    }


    // public function show(Authorization $authorization)
    // {
    //     //
    // }


    // دالة يتم من خلالها توجيهنا الي شاشة تعديل بيانات التوكيل وبعد التعديل يتم توجيهنا الي دالة حفظ التعديلات
    public function edit( $id)
    {
        $authorization = Authorization::find($id);

        $witness = Witness::all();
        $clients = Clients::all();
        $clientTo = ClientsTo::all();

            
        $witnessTo = Witness::find($authorization['second_witness_no']);


        if (!$authorization) {
            
            session()->flash('error','Not found!');

            return redirect()->route('authorization.index');  
        }
        // رابط التوجه الي شاشة تعديل التوكيل المختار
        return view('dashboard.authorization.edit' ,compact('authorization','witness','clients','clientTo','witness'));
    }


     // عندما يتم تعديل بيانات التوكيل في شاشة تعديل التوكيل يتم توجيهنا الي هذه الداله
    public function update(Request $request, $id)
    {
        $authorization = Authorization::find($id);

        // دي عمليه التحقق من البيانات قبل التخزين كما زكرت فوق
        $request->validate([
            'authorization_date' => 'required',
            'authorization_type' => 'required',
            'client_name' => 'required',
            'clientTo_name' => 'required',
            'authorization_subject_no' => 'required',
            'first_witness_no' => 'required',
            'second_witness_no' => 'required',
        ]);

     $request_data = $request->except(['_token']);

     $request_data['user_no'] = auth()->user()->id;

     // هنا يتم جلب البانات من شاشة التعديل ويتم استبدالها بالبيانات القديمه اي المخزنه مسبقا
     // هذا العمليه في كل كلاس اسي دا كلاس التوكيل كلو كما زكرت فوق
     $authorization->update([
        'authorization_date' => $request_data['authorization_date'],
        'authorization_type' => $request_data['authorization_type'],
        'client_name' =>$request_data['client_name'],
        'clientTo_name' => $request_data['clientTo_name'],
        'authorization_subject_no' => $request_data['authorization_subject_no'],
        'first_witness_no' => $request_data['first_witness_no'],
        'second_witness_no' => $request_data['second_witness_no'],
        'command' => $request_data['command'],
        'user_no' => $request_data['user_no'],
     ]);

        // هذه العميله بعد تعديل البيانات بيتم توجيهنا الي شاشة التوكيلات مع رسالة تم التعديل بنجاح
        session()->flash('success',__('site.updated_successfully'));

        // دا رابط التوجيه الي شاشة التوكيلات
        return redirect()->route('authorization.index');
    }


    // بعد الضغط علي زر الحذف في شاشة عرض البيانات يتم توجيهنا الي هذه الداله لحذف بيانات التوكيل المختارة من الجدول
    public function destroy( $id)
    {
        Authorization::find($id)->delete();

        // هذه العميله بعد حذف البيانات بيتم توجيهنا الي شاشة التوكيلات مع رسالة تم الحذف بنجاح
        session()->flash('success',__('site.deleted_successfully'));

        // دا رابط التوجيه الي شاشة التوكيلات
        return redirect()->route('authorization.index');
    }

    // عرض كل التوكيلات بالشهر المختار من شاشة التوكيلات مثلا من شهر كذا الي كذا 
    public function byMonth(Request $request)
    {

        try {

            if ($request->month_from != "" && $request->month_to != "") {
                
                $request_data = $request->except(['_token','_method']);

                $months = Authorization::all('month');

                $authorizationType = Authorization::all('authorization_type');
                   
                $query = Authorization::select('*');
                
        
                $query->whereBetween('month',[$request->month_from , $request->month_to])->get();
        
                   
                    $authorization = $query->with('Witness','Clients','ClientTo')->paginate(PAGINATION_COUNT);
    
                    foreach ($authorization as $value) {
                        
                        $witness = Witness::find($value->first_witness_no);
                        $witnessTo = Witness::find($value->second_witness_no);
                    }
    
                    return view ('dashboard.authorization.index' ,compact('authorization','months','witness','witnessTo','authorizationType'));

            }else {

                session()->flash('error','لا يوجد بيانات');
                return redirect()->route('authorization.index');
            }
            

        } catch (\Throwable $th) {
            
            return $th;
        }
        
    }

    // دالة طبع البيانات المختارة
    public function print($id)
    {
        $print_data = Authorization::with('Witness','Clients','ClientTo')->find($id);

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
    
            $witnessTo = Witness::find($print_data->second_witness_no);

            $local = Local::find($witnessTo['local_name']);
            $state = States::find($witnessTo['state_name']);
            $administrativUnit = AdministrativUnit::find($witnessTo['administrative_unit_name']);

            $witnessTo['witness_name'] = $witness_data['witness_name'];
            $witnessTo['personal_identity_no'] = $witness_data['personal_identity_no'];
            $witnessTo['state_name'] = $state['state_name'];
            $witnessTo['local_name'] = $local['local_name'];
            $witnessTo['administrative_unit_name'] = $administrativUnit['administrative_unit_name'];

            $local = Local::find($print_data->Clients->local_name);
            $state = States::find($print_data->Clients->state_name);
            $administrativUnit = AdministrativUnit::find($print_data->Clients->administrative_unit_name);

            $localTo = Local::find($print_data->ClientTo->local_name);
            $stateTo = States::find($print_data->ClientTo->state_name);
            $administrativUnitTo = AdministrativUnit::find($print_data->ClientTo->administrative_unit_name);

            $clients['state_name'] = $state['state_name'];
            $clients['local_name'] = $local['local_name'];
            $clients['administrativUnit'] = $administrativUnit['administrative_unit_name'];

            $clients['stateTo_name'] = $stateTo['state_name'];
            $clients['localTo_name'] = $localTo['local_name'];
            $clients['administrativUnitTo'] = $administrativUnitTo['administrative_unit_name'];

            // رابط التوجيهه الي شاشة طبع التوكيل المختار
        return view('dashboard.authorization.pintThis' ,compact('print_data','witness','witnessTo','clients'));
    }

    // دالة عرض البيانات بنوع التوكيل المحدد مثلا من شهر كذا الي كذا النوع كذا
    public function byType(Request $request)
    {
        // return $request;

        $request_data = $request->except(['_token','_method']);

        $months = Authorization::all('month');
        $authorizationType = Authorization::all('authorization_type');
           
        $query = Authorization::select('*');
        

        $query->whereBetween('month',[$request->month_from , $request->month_to])->get()[0];

           
        $authorization = $query->with('Witness','Clients','ClientTo')->
        where('authorization_type' ,$request->authorization_type)->paginate(PAGINATION_COUNT);

        if (isset($authorization) && $authorization->count() > 0) {
            
            foreach ($authorization as $value) {
                
                $witness = Witness::find($value->first_witness_no);
                $witnessTo = Witness::find($value->second_witness_no);
            }

        }else {
            
            $witness = "لا يوجد";
            $witnessTo = "لا يوجد";
        }

        // رابط التوجيهه الي شاشة التوكيلات بعد اختيار التوكيل المطلوب مثلا من شهر كذا الي كذا
            return view ('dashboard.authorization.index' ,compact('authorization','months','witness','witnessTo','authorizationType'));
    }

     // دالة عرض البيانات بموضوع التوكيل المحدد مثلا من شهر كذا الي كذا موضوع التوكيل كذا
    public function authorizationByType(Request $request)
    {
        // return$request;
        $request_data = $request->except(['_token','_method']);

        $query = Authorization::select('*');

        $all_authorization = $query->whereBetween('month',[$request->month_from ,
         $request->month_to])->where('authorization_subject_no' ,$request->authorization_subject_no)->get();

        $count = Authorization::where('authorization_subject_no',$request->authorization_subject_no)->count();


        $total = $all_authorization->count() / $count * 100;

        // رابط التوجيه الي شاشة طبع التوكيل المختار
         return view ('dashboard.authorization.pintThis' ,compact('all_authorization','total'));
    }
}
