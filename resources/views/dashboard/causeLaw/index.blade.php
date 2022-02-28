@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>العمل</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">سبب الدعوى</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">سبب الدعوى<small
                            style="color: #f03">{{-- ' ' .$locals->total() --}}</small></h3>

                    <form action="{{ route('causeLawsuit.index') }}" method="GET">
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
                            
                            @if (auth()->user()->hasPermission('lawsuit_create'))
                            <a href="{{ route('causeLawsuit.create') }}" class="btn btn-primary"><i
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
                @if (isset($causeLaw) && $causeLaw->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                {{--  <th>رقم الولايه</th>  --}}
                                <th>إسم سبب الدعوى</th>
                                <th>@lang('site.command')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($causeLaw as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->cause_law_name }}</td>
                                    <td>{{ $item->command }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('lawsuit_edit'))
                                        <a href="{{ route('causeLawsuit.edit', $item->id) }}" class="btn btn-info btn-sm"><i
                                            class="fa fa-edit"></i>@lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i
                                                    class="fa fa-add"></i>@lang('site.edit')</a>
                                        @endif

                                        @if (auth()->user()->hasPermission('lawsuit_delete'))
                                        <form method="post" action="{{ route('causeLawsuit.destroy', $item->id) }}"
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
