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
                            @if (isset($print_data) && $print_data->count() > 0)
                            <table class="table table-bordered printThis">
                                <thead>
                                    <tr>
                                        <th>تاريخ الدعوى</th>
                                        <th colspan="5"> المدعى</th>
                                        {{--  <th colspan="5"> المدعى عليه</th>  --}}
                                        <th>سبب الدعوى</th>
                                        <th>موضوع الدعوى</th>
                                        <th>تصنيف الدعوه </th>
                                    </tr>
                                </thead>
                                <tbody>
                
                                        <tr>
                                            <td >{{ $print_data['prose_date'] }}</td>
                                            <td>{{ $print_data->Customer->customer_name }}</td>
                                            <td>{{ $print_data->Customer->personal_identity_no }}</td>
                                            <td>{{ $state->state_name }}</td>
                                            <td>{{ $local->local_name }}</td>
                                            <td>{{ $administrativUnit->administrative_unit_name }}</td>
            
                                            <td>{{ $print_data->CauseLawsuit->cause_law_name }}</td>
                                            <td>{{ $print_data->ProseText->prose_text_name }}</td>
                                            <td>{{ $print_data->proseType() }}</td>
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
