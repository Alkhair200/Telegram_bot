@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>المدعى عليه</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">المدعى عليه</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">المدعى عليه<small
                            style="color: #f03">{{-- ' ' .$locals->total() --}}</small></h3>

                    <form action="{{ route('customersTo.index') }}" method="GET">
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

                            @if (auth()->user()->hasPermission('customersTo_read'))

                                <a href="{{ route('customersTo.create') }}" class="btn btn-primary"><i
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
                @if (isset($customersTo) && $customersTo->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>إسم العميل</th>
                                <th>النوع</th>
                                <th>نوع اثبات الشخصية</th>
                                <th>رقم اثبات الشخصية</th>
                                <th>رقم الهاتف</th>
                                <th>رقم الولاية</th>
                                <th>رقم المحلية</th>
                                <th>رقم الوحدة الادارية</th>
                                <th>@lang('site.command')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customersTo as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->customerTo_name }}</td>
                                    <td>{{ $item->getGender() }}</td>
                                    <td>{{ $item->personal_identity_type }}</td>
                                    <td>{{ $item->personal_identity_no }}</td>
                                    <td>{{ $item->phone_no }}</td>
                                    <td>
                                        @foreach ($states as $state)
                                            @if ($state->id == $item->state_name)
                                                {{ $state->state_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($locals as $value)
                                            @if ($value->id == $item->administrative->local_name)
                                                {{ $value->local_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $item->administrative->administrative_unit_name }}</td>
                                    <td>{{ $item->command }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('customersTo_edit'))

                                            <a href="{{ route('customers.edit', $item->id) }}"
                                                class="btn btn-info btn-sm"><i
                                                    class="fa fa-edit"></i>@lang('site.edit')</a>

                                        @else
                                            <a href="#" class="btn btn-primary disabled"><i
                                                    class="fa fa-plus"></i>@lang('site.edit')</a>
                                        @endif

                                        @if (auth()->user()->hasPermission('customersTo_delete'))

                                            <form method="post" action="{{ route('customersTo.destroy', $item->id) }}"
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

                                        <a href="{{ route('customersTo.edit', $item->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>@lang('site.edit')</a>


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
