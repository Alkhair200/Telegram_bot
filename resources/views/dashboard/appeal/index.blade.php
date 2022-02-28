@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الإسئنافات</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">الإسئنافات </li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">الإسئنافات <small
                            style="color: #f03">{{-- ' ' .$locals->total() --}}</small></h3>

                    <form action="{{ route('appeal.index') }}" method="GET">
                        <div class="row">

                        </div>
                        <div class="col-md-4">

                            @if (auth()->user()->hasPermission('appeal_read'))

                            <a href="{{ route('appeal.create') }}" class="btn btn-primary"><i
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
                @if (isset($appeal) && $appeal->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاريخ الإستئناف</th>
                                <th>تاريخ الدعوى</th>
                                <th>حكم القاضى السابق</th>
                                <th>حكم القاضى الإستئناف</th>
                                <th>تاريخ الحكم</th>
                                <th>إسم مدخل البيانات</th>
                                <th>تاريخ إدخال البيانات</th>
                                <th>@lang('site.command')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appeal as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->appeal_date }}</td>
                                    <td>{{ $item->Prosecution->prose_date }}</td>
                                    <td>{{ $item->provirus_judge }}</td>
                                    <td>{{ $item->appeal_judge }}</td>
                                    <td>{{ $item->judge_meant_date }}</td>
                                    <td>{{ auth()->user()->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->command }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('appeal_edit'))

                                        <a href="{{ route('appeal.edit', $item->id) }}" class="btn btn-info btn-sm"><i
                                            class="fa fa-edit"></i>@lang('site.edit')</a>

                                            <a href="{{ route('printAppeal', $item->id) }}"
                                                class="btn btn-warning btn-sm"><i class="fa fa-print"></i>طبع
                                            </a>
            
                                        @else
                                            <a href="#" class="btn btn-primary disabled"><i
                                                    class="fa fa-plus"></i>@lang('site.edit')</a>
                                        @endif

                                        @if (auth()->user()->hasPermission('appeal_delete'))

                                        <form method="post" action="{{ route('appeal.destroy', $item->id) }}"
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
                <form action="{{ route('appealByMonth') }}" method="POST">
                    @csrf
                    {{ method_field('post') }}

                    <div class="row">
                        <div class="form-group" style="margin-right: 16px; margin-top: 20px">
                            <p>كل الإسئنافات</p>
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
            </div>
    </div>
    </section>
    </div>
@endsection
