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
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">الدعاوي<small
                            style="color: #f03">{{ ' ' . $prosecution->total() }}</small></h3>

                    <form action="{{ route('prosecution.index') }}" method="GET">
                        <div class="row">

                        </div>
                        <div class="col-md-4">
                            @if (auth()->user()->hasPermission('prosecution_read'))

                                <a href="{{ route('prosecution.create') }}" class="btn btn-primary"><i
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
                @if (isset($prosecution) && $prosecution->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاريخ الدعوه</th>
                                <th> المدعى</th>
                                <th> المدعى عليه</th>
                                <th>موضوع الدعوى</th>
                                <th>تصنيف الدعوه </th>
                                <th>سبب الدعوى</th>
                                <th>مدخل البيانات</th>
                                <th>تاريخ ادخال البيانات</th>
                                <th>@lang('site.command')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prosecution as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->prose_date }}</td>
                                    <td>{{ $item->Customer->customer_name }}</td>
                                    <td>{{ $item->CustomerTo->customerTo_name }}</td>
                                    <td>{{ $item->ProseText->prose_text_name }}</td>
                                    <td>{{ $item->proseType() }}</td>
                                    <td>{{ $item->CauseLawsuit->cause_law_name }}</td>
                                    <td>{{ $item->User->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->command }}</td>
                                    <td>

                                        @if (auth()->user()->hasPermission('prosecution_edit'))

                                            <a href="{{ route('prosecution.edit', $item->id) }}"
                                                class="btn btn-info btn-sm"><i
                                                    class="fa fa-edit"></i>@lang('site.edit')</a>

                                            <a href="{{ route('print', $item->id) }}" class="btn btn-warning btn-sm"><i
                                                    class="fa fa-print"></i>طبع
                                            </a>

                                        @else
                                            <a href="#" class="btn btn-primary disabled"><i
                                                    class="fa fa-plus"></i>@lang('site.edit')</a>
                                        @endif

                                        @if (auth()->user()->hasPermission('prosecution_delete'))

                                            <form method="post" action="{{ route('prosecution.destroy', $item->id) }}"
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
                        {{ $prosecution->appends(request()->query())->links() }}
                    </div>
                @else
                    <h2> @lang('site.no_data_found')</h2>
                @endif

                <div class="row">
                    <form action="{{ route('byMonth') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}

                        <div class="row">
                            <div class="form-group" style="margin-right: 16px; margin-top: 20px">
                                <p>كل الدعاوي</p>
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
                                <button type="submit" class="btn btn-primary"><i class=" fa fa-search">بحث</i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <form action="{{ route('byBroseType') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}
                        <div class="form-group">
                            <p>الدعاوي لتصنيف محدد </p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2"> الفترة من</label>
                                    <select name="month_from" class="form-control" style="height: 40px">
                                        @foreach ($prosecution as $key => $value)
                                            <option value="{{ $value->month }}">{{ $value->month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">الي</label>
                                    <select name="month_to" class="form-control" style="height: 40px">
                                        @foreach ($prosecution as $key => $value)
                                            <option value="{{ $value->month }}">{{ $value->month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">إسم التصنيف</label>
                                    <select name="prose_type" class="form-control" style="height: 40px">
                                        <option value="1">جنائية</option>
                                        <option value="2">مدنية</option>
                                        <option value="3">شرعية</option>
                                        <option value="4">إدارية</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 16px">
                                <button type="submit" class="btn btn-primary"><i class=" fa fa-search">بحث</i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <form action="{{ route('getByCustomer') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}
                        <div class="form-group">
                            <p>الدعاوي لمدعي محدد </p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2"> الفترة من</label>
                                    <select name="month_from" class="form-control" style="height: 40px">
                                        @foreach ($prosecution as $key => $value)
                                            <option value="{{ $value->month }}">{{ $value->month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">الي</label>
                                    <select name="month_to" class="form-control" style="height: 40px">
                                        @foreach ($prosecution as $key => $value)
                                            <option value="{{ $value->month }}">{{ $value->month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">إسم المدعى</label>
                                    <select name="customer_name" class="form-control" style="height: 40px">
                                        @foreach ($prosecution as $key => $value)
                                            <option value="{{ $value->customer_name }}">
                                                {{ $value->Customer->customer_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 16px">
                                <button type="submit" class="btn btn-primary"><i class=" fa fa-search">بحث</i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <form action="{{ route('getBySubject') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}
                        <div class="form-group">
                            <p>الدعاوي لموضوع محدد </p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2"> الفترة من</label>
                                    <select name="month_from" class="form-control" style="height: 40px">
                                        @foreach ($prosecution as $key => $value)
                                            <option value="{{ $value->month }}">{{ $value->month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">الي</label>
                                    <select name="month_to" class="form-control" style="height: 40px">
                                        @foreach ($prosecution as $key => $value)
                                            <option value="{{ $value->month }}">{{ $value->month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">إسم الموضوع</label>
                                    <select name="prose_text_name" class="form-control" style="height: 40px">
                                        @foreach ($prosecution as $key => $value)
                                            <option value="{{ $value->prose_text_name }}">
                                                {{ $value->ProseText->prose_text_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 16px">
                                <button type="submit" class="btn btn-primary"><i class=" fa fa-search">بحث</i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <form action="{{ route('byAllMonth') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}

                        <div class="row">
                            <div class="form-group" style="margin-right: 16px; margin-top: 20px">
                                <p>كل الدعاوي بالنسبه</p>
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
                                <button type="submit" class="btn btn-primary"><i class=" fa fa-search">بحث</i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <form action="{{ route('getBySubjectByTotal') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}
                        <div class="form-group">
                            <p>الدعاوي لتصنيف محدد بالنسبه </p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2"> الفترة من</label>
                                    <select name="month_from" class="form-control" style="height: 40px">
                                        @foreach ($prosecution as $key => $value)
                                            <option value="{{ $value->month }}">{{ $value->month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">الي</label>
                                    <select name="month_to" class="form-control" style="height: 40px">
                                        @foreach ($prosecution as $key => $value)
                                            <option value="{{ $value->month }}">{{ $value->month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">إسم التصنيف</label>
                                    <select name="prose_type" class="form-control" style="height: 40px">
                                        <option value="1">جنائية</option>
                                        <option value="2">مدنية</option>
                                        <option value="3">شرعية</option>
                                        <option value="4">إدارية</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 16px">
                                <button type="submit" class="btn btn-primary"><i class=" fa fa-search">بحث</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
