@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الدعاوي</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">كل الجلسات </li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary" style="background: #CAD1D2;">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">طبع الجلسة<small
                            style="color: #f03">{{-- ' ' . $prosecution->total() --}}</small></h3>
                            @if (isset($print_data) && $print_data->count() > 0)
                            <table class="table table-bordered printThis">
                                <thead>
                                    <tr>
                                        <th>تاريخ الجلسة</th>
                                        <th>زمن الجلسة</th>
                                        <th>تاريخ الدعوى</th>
                                        <th>المدعى</th>
                                        <th>المدعى علية</th>
                                        <th>محامي المدعى</th>
                                        <th>محامي المدعى علية</th>
                                        {{--  <th colspan="2">الشهود</th>  --}}
                                        <th>رقم القاضى</th>
                                        <th>إسم المحكمة</th>
                                        <th>قرار الجلسة</th>
                                    </tr>
                                </thead>
                                <tbody>
                
                                        <tr>
                                            <td >{{ $print_data['prose_date'] }}</td>
                                            <td>{{ $print_data['session_date'] }}</td>
                                            <td>{{ $print_data->Prosecutions->prose_date }}</td>

                                            <td>{{ $customer->customer_name }}</td>
                                            <td>{{ $customerTo->customerTo_name }}</td>
                                            
                                            <td>{{ $print_data->Lawyers->lawyer_name }}</td>
                                            <td>{{ $lawyerTo['lawyer_name'] }}</td>
                                            <td>{{ $print_data->Judge->name }}</td>
                                            <td>{{ $print_data->Courts->court_name }}</td>
                                            <td>{{ $print_data['session_decision'] }}</td>
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
