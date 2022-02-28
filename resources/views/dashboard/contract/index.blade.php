@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>العقد</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">كل العقود</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">العقد<small
                            style="color: #f03">{{-- ' ' .$locals->total() --}}</small></h3>

                    <form action="{{ route('contract.index') }}" method="GET">
                        <div class="row">
                            {{-- <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" value="{{ request()->search }}"
                                        placeholder="@lang('site.search')">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">@lang('site.search')</button>
                                    </span>
                                </div> --}}
                        </div>
                        <div class="col-md-4">
                            @if (auth()->user()->hasPermission('contract_read'))

                            <a href="{{ route('contract.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i>@lang('site.add')</a>

                            @else
                                <a href="#" class="btn btn-primary disabled"><i
                                        class="fa fa-plus"></i>@lang('site.add')</a>
                            @endif
                        </div>
                </div>
                </form>
            </div>
            <div class="box-body">
                @if (isset($contract) && $contract->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاريخ العقد</th>
                                <th>موضوع العقد</th>
                                <th>إسم الطرف الاول</th>
                                <th>إسم الطرف الثاني</th>
                                <th>رقم الشاهد الاول</th>
                                <th>رقم الشاهد الثاني</th>
                                <th>إسم مدخل البيانات</th>
                                <th>تاريخ الادخال</th>
                                <th>@lang('site.command')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contract as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->contract_date }}</td>
                                    <td>{{ $item->ContractSubject->contract_subject_name }}</td>
                                    <td>{{ $item->Customers->customer_name }}</td>
                                    <td>{{ $item->CustomerTo->customerTo_name }}</td>
                                    <td> {{ $witness['witness_name'] }}</td>
                                    <td>{{ $witnessTo['witness_name'] }}</td>
                                    <td>{{ $item->User->name }}</td>
                                    <td>{{ $item->created_at }}</td>

                                    <td>{{ $item->command }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('contract_edit'))

                                        <a href="{{ route('contract.edit', $item->id) }}" class="btn btn-info btn-sm"><i
                                            class="fa fa-edit"></i>@lang('site.edit')</a>

                                    <a href="{{ route('printContract', $item->id) }}"
                                        class="btn btn-warning btn-sm"><i class="fa fa-print"></i>طبع
                                    </a>
            
                                        @else
                                            <a href="#" class="btn btn-primary disabled"><i
                                                    class="fa fa-plus"></i>@lang('site.edit')</a>
                                        @endif

                                        @if (auth()->user()->hasPermission('contract_delete'))

                                        <form method="post" action="{{ route('contract.destroy', $item->id) }}"
                                            style="display: inline-block">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                        class="fa fa-trash"></i>@lang('site.delete')</button>
                                            </div>
                                        </form>
            
                                        @else
                                            <a href="#" class="btn btn-primary disabled"><i
                                                    class="fa fa-plus"></i>@lang('site.delete')</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="content-center">
                        {{-- $locals->appends(request()->query())->links() --}}
                    </div>
                @else
                    <h2> @lang('site.no_data_found')</h2>
                @endif

                <div class="row">
                    <form action="{{ route('contractByMonth') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}

                        <div class="row">
                            <div class="form-group" style="margin-right: 16px; margin-top: 20px">
                                <p>كل العقود</p>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput2"> في الفترة من</label>
                                    <select name="month_from" class="form-control" style="height: 40px">
                                        @foreach ($months as $key => $value)
                                            <option value="{{ $value->month }}">{{ ' شهر ' . $value->month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput2">الي</label>
                                    <select name="month_to" class="form-control" style="height: 40px">
                                        @foreach ($months as $key => $value)
                                            <option value="{{ $value->month }}">{{ ' شهر ' . $value->month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 16px; width: 100%">
                                <button type="submit" class="btn btn-primary" style=" width: 100%"><i
                                        class=" fa fa-search">بحث</i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <form action="{{ route('contractType') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}

                        <div class="row">
                            <div class="form-group" style="margin-right: 16px; margin-top: 20px">
                                <p>كل العقود لموضوع محدد</p>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2"> في الفترة من</label>
                                    <select name="month_from" class="form-control" style="height: 40px">
                                        @foreach ($months as $key => $value)
                                            <option value="{{ $value->month }}">{{ ' شهر ' . $value->month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">الي</label>
                                    <select name="month_to" class="form-control" style="height: 40px">
                                        @foreach ($months as $key => $value)
                                            <option value="{{ $value->month }}">{{ ' شهر ' . $value->month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">إسم الموضوع</label>
                                    <select name="contract_subject" class="form-control" style="height: 40px">
                                        @foreach ($contract as $value)
                                            <option value="{{ $value->contract_subject }}">
                                                {{ $value->ContractSubject->contract_subject_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 16px; width: 100%">
                                <button type="submit" class="btn btn-primary" style=" width: 100%"><i
                                        class=" fa fa-search">بحث</i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <form action="{{ route('contractByType') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}

                        <div class="row">
                            <div class="form-group" style="margin-right: 16px; margin-top: 20px">
                                <p>كل العقود بالنسبه</p>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2"> في الفترة من</label>
                                    <select name="month_from" class="form-control" style="height: 40px">
                                        @foreach ($months as $key => $value)
                                            <option value="{{ $value->month }}">{{ ' شهر ' . $value->month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">الي</label>
                                    <select name="month_to" class="form-control" style="height: 40px">
                                        @foreach ($months as $key => $value)
                                            <option value="{{ $value->month }}">{{ ' شهر ' . $value->month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">موضوع العقد</label>
                                    <select name="contract_subject" class="form-control" style="height: 40px">
                                        @foreach ($contract as $value)
                                            <option value="{{ $value->contract_subject }}">
                                                {{ $value->ContractSubject->contract_subject_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 16px; width: 100%">
                                <button type="submit" class="btn btn-primary" style=" width: 100%"><i
                                        class=" fa fa-search">بحث</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
