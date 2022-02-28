@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الدعاوي</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">كل الدعاوي </li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary" style="background: #CAD1D2;">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">طبع التقرير<small
                            style="color: #f03">{{-- ' ' . $prosecution->total() --}}</small></h3>

                    @if (isset($all_prosecution))

                        @if (isset($all_prosecution) && $all_prosecution->count() > 0)
                            <table class="table table-bordered printThis">
                                <thead>
                                    <tr>
                                        <th>التصنيف</th>
                                        <th>العدد</th>
                                        <th>النسبه%</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($all_prosecution as $item)
                                        <tr>
                                            <td>{{ $item->proseType() }}</td>
                                            <td>{{ $all_prosecution->count() }}</td>
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

                    @elseif(isset($print_data) )

                        @if (isset($print_data) && $print_data->count() > 0)
                            <table class="table table-bordered printThis">
                                <thead>
                                    <tr>
                                        <th>تاريخ الدعوى</th>
                                        <th colspan="5"> المدعى</th>
                                        <th colspan="5"> المدعى عليه</th>
                                        <th>سبب الدعوى</th>
                                        <th>موضوع الدعوى</th>
                                        <th>تصنيف الدعوه </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>{{ $print_data['prose_date'] }}</td>
                                        <td>{{ $print_data->Customer->customer_name }}</td>
                                        <td>{{ $print_data->Customer->personal_identity_no }}</td>
                                        <td>{{ $state->state_name }}</td>
                                        <td>{{ $local->local_name }}</td>
                                        <td>{{ $administrativUnit->administrative_unit_name }}</td>

                                        <td>{{ $print_data->CustomerTo->customerTo_name }}</td>
                                        <td>{{ $print_data->CustomerTo->personal_identity_no }}</td>
                                        <td>{{ $stateTo->state_name }}</td>
                                        <td>{{ $localTo->local_name }}</td>
                                        <td>{{ $administrativUnitTo->administrative_unit_name }}</td>

                                        <td>{{ $print_data->CauseLawsuit->cause_law_name }}</td>
                                        <td>{{ $print_data->ProseText->prose_text_name }}</td>
                                        <td>{{ $print_data->proseType() }}</td>
                                    </tr>
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

                    @elseif(isset($all_prosecutionBytotal))

                        @if (isset($all_prosecutionBytotal) && $all_prosecutionBytotal->count() > 0)
                            <table class="table table-bordered printThis">
                                <thead>
                                    <tr>
                                        <th>التصنيف</th>
                                        <th>العدد</th>
                                        <th>النسبه%</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($all_prosecutionBytotal as $item)
                                        <tr>
                                            <td>{{ $item->proseType() }}</td>
                                            <td>{{ $all_prosecutionBytotal->count() }}</td>
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

                    @elseif(isset($all_prosecutionSubject))

                        @if (isset($all_prosecutionSubject) && $all_prosecutionSubject->count() > 0)
                            <table class="table table-bordered printThis">
                                <thead>
                                    <tr>
                                        <th>التصنيف</th>
                                        <th>العدد</th>
                                        <th>النسبه%</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($all_prosecutionSubject as $item)
                                        <tr>
                                            <td>{{ $item->proseType() }}</td>
                                            <td>{{ $all_prosecutionSubject->count() }}</td>
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
