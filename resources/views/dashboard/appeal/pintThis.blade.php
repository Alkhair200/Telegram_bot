@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الدعاوي</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">كل الإسئنافات </li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary" style="background: #CAD1D2;">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">طبع الإسئناف<small
                            style="color: #f03">{{-- ' ' . $prosecution->total() --}}</small></h3>
                            @if (isset($print_data) && $print_data->count() > 0)
                            <table class="table table-bordered printThis">
                                <thead>
                                    <tr>
                                        <th>تاريخ الإستئناف</th>
                                        <th>تاريخ الحكم</th>
                                        <th colspan="2">الدعوى</th>
                                        <th>المدعى </th>
                                        <th>المدعى علية</th>
                                        <th>حكم القاضى السابق</th>
                                        <th> حكم القاضى الإستئناف </th>

                                    </tr>
                                </thead>
                                <tbody>
                
                                        <tr>
                                            <td >{{ $print_data['appeal_date'] }}</td>
                                            <td>{{ $print_data['judge_meant_date'] }}</td>

                                            <td>{{ $print_data->Prosecution->prose_date }}</td>
                                            <td>{{ $proseText['prose_text_name'] }}</td>

                                            <td>{{ $customer->customer_name }}</td>
                                            <td>{{ $customerTo->customerTo_name }}</td>

                                            <td>{{ $print_data['provirus_judge']}}</td>
                                            <td>{{ $print_data['appeal_judge'] }}</td>
                                        </tr>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm print" style="width: 100%"><i
                                                    class="fa fa-print"></i>طبع</button>
                                        </div>
                                </tbody>
                            </table>
                            <div class="content-center">
                                {{--  {{ $prosecution->appends(request()->query())->links() }}  --}}
                            </div>
                        @else
                            <h2> @lang('site.no_data_found')</h2>
                        @endif
                </div>
                </form>
            </div>
            <div class="box-body">

            </div>
    </div>
    </section>
    </div>
@endsection
