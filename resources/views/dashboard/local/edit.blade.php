@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>المحليات</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('local.index') }}">المحليات</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add') {{-- <small>Quick Exapm</small> --}}</h3>
                </div>
                <!----End box of header----->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('local.update', $local->id) }}" method="POST">
                        @csrf
                        {{ method_field('put') }}

                        {{-- <div class="form-group">
                            <label>رقم الولايه</label>
                            <input type="text" name="state_no" class="form-control">
                        </div> --}}

                        <div class="form-group">
                            <label>إسم المحليه</label>
                            <input type="text" name="local_name" class="form-control" value="{{ $local->local_name }}">
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">رقم الولايه</label>
                            <select name="state_no" class="form-control" style="height: 40px">
                                @foreach ($states as $key => $value)
                                    <option value="{{ $key +1 }}" @if ($local->state_no == $value->id)
                                        selected
                                    @endif>{{ $value->state_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ملاحظات</label>
                            <textarea name="command" id="" class="form-control" cols="4"
                                rows="4">{{ $local->command }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i
                                    class=" fa fa-plus">@lang('site.edit')</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
