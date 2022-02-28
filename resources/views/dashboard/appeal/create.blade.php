@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الإسئنافات</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('appeal.index') }}">الإسئنافات</a></li>
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

                    <form action="{{ route('appeal.store') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>تاريخ الإستئناف</label>
                            <input type="date" name="appeal_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">تاريخ الدعوى</label>
                            <select name="prosecution_date" class="form-control" style="height: 40px">
                                @foreach ($prosecution as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->prose_date }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>حكم القاضى السابق</label>
                            <textarea name="provirus_judge" id="" class="form-control" cols="4" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label>حكم قاضي الاستئناف</label>
                            <textarea name="appeal_judge" id="" class="form-control" cols="4" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label>تاريخ الحكم</label>
                            <input type="date" name="judge_meant_date" class="form-control">
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
