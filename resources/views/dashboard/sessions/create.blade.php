@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الجلسات</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('sessions.index') }}">كل الجلسات</a></li>
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

                    <form action="{{ route('sessions.store') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}

                        {{-- <div class="form-group">
                            <label for="projectinput2">رقم الدعوى</label>
                            <select name="prose_name" class="form-control" style="height: 40px">
                                @foreach ($prosecutions as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->id }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="form-group">
                            <label for="projectinput2">تاريخ الدعوى</label>
                            <select name="prose_date" class="form-control" style="height: 40px">
                                @foreach ($prosecutions as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->prose_date }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>تاريخ الجلسة</label>
                            <input type="date" name="session_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>زمن الجلسة</label>
                            <input type="time" name="session_time" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">رقم المحكمة</label>
                            <select name="court_name" class="form-control" style="height: 40px">
                                @foreach ($courts as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->court_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">رقم محامي المدعي</label>
                            <select name="lawyer_name" class="form-control" style="height: 40px">
                                @foreach ($lawyers as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->lawyer_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">رقم محامي المدعي عليه</label>
                            <select name="lawyerTo_name" class="form-control" style="height: 40px">
                                @foreach ($lawyers as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->lawyer_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">إسم القاضى</label>
                            <select name="judge_name" class="form-control" style="height: 40px">
                                @foreach ($judge as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>قرار الجلسة</label>
                            <textarea name="session_decision" id="" class="form-control" cols="4" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">القرار نهائي ام لا</label>
                            <select name="end_decision" class="form-control" style="height: 40px">
                                <option value="1">نهائي</option>
                                <option value="2">لا</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ملاحظات</label>
                            <textarea name="command" id="" class="form-control" cols="4" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i
                                    class=" fa fa-plus">@lang('site.add')</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
