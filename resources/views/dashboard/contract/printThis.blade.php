@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الدعاوي</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">كل العقود </li>
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
                                        <th>تاريخ العقد</th>
                                        <th>موضوع العقد</th>
                                        <th colspan="5">الطرف الاول</th>
                                        <th colspan="5">الطرف الثاني</th>
                                        <th colspan="5">الشاهد الاول</th>
                                        <th colspan="5">الشاهد الثاني</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>{{ $print_data['contract_date'] }}</td>
                                        <td>{{ $print_data->ContractSubject->contract_subject_name }}</td>

                                        <td>{{ $customer['customer_name'] }}</td>
                                        <td>{{ $customer['personal_identity_no'] }}</td>
                                        <td>{{ $customer['state_name'] }}</td>
                                        <td>{{ $customer['local_name'] }}</td>
                                        <td>{{ $customer['administrative_unit_name'] }}</td>

                                        <td>{{ $customerTo['customer_name'] }}</td>
                                        <td>{{ $customerTo['personal_identity_no'] }}</td>
                                        <td>{{ $customerTo['state_name'] }}</td>
                                        <td>{{ $customerTo['local_name'] }}</td>
                                        <td>{{ $customerTo['administrative_unit_name'] }}</td>

                                        <td>{{ $witness['witness_name'] }}</td>
                                        <td>{{ $witness['personal_identity_no'] }}</td>
                                        <td>{{ $witness['local_name'] }}</td>
                                        <td>{{ $witness['state_name'] }}</td>
                                        <td>{{ $witness['administrative_unit_name'] }}</td>

                                        <td>{{ $witnessTo['witness_name'] }}</td>
                                        <td>{{ $witnessTo['personal_identity_no'] }}</td>
                                        <td>{{ $witnessTo['local_name'] }}</td>
                                        <td>{{ $witnessTo['state_name'] }}</td>
                                        <td>{{ $witnessTo['administrative_unit_name'] }}</td>

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

                    @elseif(isset($all_contract))

                    @if (isset($all_contract) && $all_contract->count() > 0)
                    <table class="table table-bordered printThis">
                        <thead>
                            <tr>
                                <th>موضوع العقد</th>
                                <th>العدد</th>
                                <th>النسبه%</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($all_contract as $item)
                                <tr>
                                    <td>{{ $item->ContractSubject->contract_subject_name }}</td>
                                    <td>{{ $all_contract->count() }}</td>
                                    <td>{{ $total }}</td>
                                </tr>
                            @endforeach


                            <div class="form-group">
                                <button class="btn btn-primary btn-sm print"><i
                                        class="fa fa-print"></i>طبع</button>
                            </div>
                        </tbody>
                    </table>
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
