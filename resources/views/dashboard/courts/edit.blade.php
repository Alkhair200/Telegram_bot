@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>المحاكم</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('courts.index') }}">المحاكم</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.edit') {{-- <small>Quick Exapm</small> --}}</h3>
                </div>
                <!----End box of header----->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('courts.update', $courts->id) }}" method="POST">
                        @csrf
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>إسم المحكمه</label>
                            <input type="text" name="court_name" class="form-control" value="{{ $courts->court_name }}">
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">رقم الولايه</label>
                            <select name="state_name" class="form-control" style="height: 40px">
                                @foreach ($states as $key => $value)
                                    <option value="{{ $value->id }}" @if ($courts->state_name == $value->id)
                                        selected
                                @endif>{{ $value->state_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">رقم المحليه</label>
                            <select name="local_name" class="form-control" style="height: 40px">
                                @foreach ($locals as $key => $value)
                                    <option value="{{ $value->id }}" @if ($courts->local_name == $value->id)
                                        selected
                                @endif>{{ $value->local_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">رقم الوحده الإداريه</label>
                            <select name="administrative_unit_name" class="form-control" style="height: 40px">
                                @foreach ($administrativeUnit as $key => $value)
                                    <option value="{{ $value->id }}" @if ($courts->administrative_unit_name == $value->id)
                                        selected
                                @endif>{{ $value->administrative_unit_name }}</option>
                                @endforeach
                            </select>
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
