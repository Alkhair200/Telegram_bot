@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>شهود الجلسات</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">كل شهود الجلسات </li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">شهود الجلسات<small
                            style="color: #f03">{{-- ' ' .$locals->total() --}}</small></h3>

                    <form action="{{ route('sessionWitness.index') }}" method="GET">
                        <div class="row">

                        </div>
                        <div class="col-md-4">
                            @if (auth()->user()->hasPermission('session_witness_read'))

                            <a href="{{ route('sessionWitness.create') }}" class="btn btn-primary"><i
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
                @if (isset($sessionWitness) && $sessionWitness->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاريخ الدعوى</th>
                                <th>رقم الشاهد</th>
                                <th>شاهد المدعي ام شاهد المدعي علية</th>
                                <th>إسم مدخل البيانات</th>
                                <th>تاريخ ادخال البيانات</th>
                                <th>@lang('site.command')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessionWitness as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    {{-- <td>{{ $item->prose_date }}</td> --}}
                                    <td>{{ $item->prose_date }}</td>
                                    <td>{{ $item->ssession_no }}</td>
                                    <td>{{ $item->witness_name }}</td>
                                    <td>{{ $item->witch_witness }}</td>
                                    <td>{{ $item->User->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->command }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('session_witness_edit'))

                                        <a href="{{ route('sessionWitness.edit', $item->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>@lang('site.edit')</a>
            
                                        @else
                                            <a href="#" class="btn btn-primary disabled"><i
                                                    class="fa fa-plus"></i>@lang('site.edit')</a>
                                        @endif

                                        @if (auth()->user()->hasPermission('session_witness_delete'))

                                        <form method="post" action="{{ route('sessionWitness.destroy', $item->id) }}"
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
            </div>
    </div>
    </section>
    </div>
@endsection
