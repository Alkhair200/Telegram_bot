@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الدعاوي</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">كل الإستشارات </li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary" style="background: #CAD1D2;">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">طبع الاستشارة<small
                            style="color: #f03">{{-- ' ' . $prosecution->total() --}}</small></h3>

                    @if (isset($print_data))

                        @if (isset($print_data) && $print_data->count() > 0)
                            <table class="table table-bordered printThis">
                                <thead>
                                    <tr>
                                        <th>تاريخ الاستشارة</th>
                                        <th>الموضوع</th>
                                        <th colspan="5">العميل</th>
                                        <th>تاريخ الرد</th>
                                        <th>زمن الرد</th>
                                        <th> نص الاستشارة </th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>{{ $print_data['consult_date'] }}</td>
                                        <td>{{ $subjectConsult['consult_subject_text'] }}</td>

                                        <td>{{ $customer['customer_name'] }}</td>
                                        <td>{{ $customer['phone_no'] }}</td>
                                        <td>{{ $state['state_name'] }}</td>
                                        <td>{{ $local['local_name'] }}</td>
                                        <td>{{ $administrativUnit['administrative_unit_name'] }}</td>

                                        <td>{{ $print_data['respondent_date'] }}</td>
                                        <td>{{ $print_data['respondent_time'] }}</td>
                                        <td>{{ $print_data['consult_text'] }}</td>
                                    </tr>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm print" style="width: 100%"><i
                                                class="fa fa-print"></i>طبع</button>
                                    </div>
                                </tbody>
                            </table>
                            <div class="content-center">
                                {{-- {{ $prosecution->appends(request()->query())->links() }} --}}
                            </div>
                        @else
                            <h2> @lang('site.no_data_found')</h2>
                        @endif

                    @elseif(isset($all_consults))

                        @if (isset($all_consults) && $all_consults->count() > 0)
                            <table class="table table-bordered printThis">
                                <thead>
                                    <tr>
                                        <th>موضوع الاستشارة</th>
                                        <th>العدد</th>
                                        <th>النسبه%</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($all_consults as $item)
                                        <tr>
                                            <td>{{ $item->SubjectConsult->consult_subject_text }}</td>
                                            <td>{{ $all_consults->count() }}</td>
                                            <td>{{ $total }}</td>
                                        </tr>
                                    @endforeach


                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm print"><i
                                                class="fa fa-print"></i>طبع</button>
                                    </div>
                                </tbody>
                            </table>
                            <div class="content-center">
                                {{-- {{ $prosecution->appends(request()->query())->links() }} --}}
                            </div>
                        @else
                            <h2> @lang('site.no_data_found')</h2>
                        @endif

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
