@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الوحدات الإداريه</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">كل الوحدات الإداريه</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">الوحدات الإداريه<small
                            style="color: #f03">{{-- ' ' .$locals->total() --}}</small></h3>

                    <form action="{{ route('adminUnit.index') }}" method="GET">
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

                            @if (auth()->user()->hasPermission('adminUnit_create'))
                            <a href="{{ route('adminUnit.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i>@lang('site.add')</a>
                            @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i
                                        class="fa fa-add"></i>@lang('site.add')</a>
                            @endif
                        </div>
                </div>
                </form>
            </div>
            <div class="box-body">
                @if (isset($administrative) && $administrative->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>رقم الولايه</th>
                                <th>رقم المحليه</th>
                                <th>إسم الوحده الإداريه</th>
                                <th>@lang('site.command')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($administrative as $index => $item)
                            
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->state->state_name}}</td>
                                    <td>{{ $item->local->local_name }}</td>
                                    <td>{{ $item->administrative_unit_name }}</td>
                                    <td>{{ $item->command }}</td>
                                    <td>

                                        @if (auth()->user()->hasPermission('adminUnit_edit'))
                                        <a href="{{ route('adminUnit.edit', $item->id) }}" class="btn btn-info btn-sm"><i
                                            class="fa fa-edit"></i>@lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i
                                                    class="fa fa-add"></i>@lang('site.edit')</a>
                                        @endif

                                        @if (auth()->user()->hasPermission('adminUnit_delete'))
                                        <form method="post" action="{{ route('adminUnit.destroy', $item->id) }}"
                                            style="display: inline-block">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                        class="fa fa-trash"></i>@lang('site.delete')</button>
                                            </div>
                                        </form>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i
                                                    class="fa fa-add"></i>@lang('site.delete')</a>
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
