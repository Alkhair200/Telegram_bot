@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>المحامين</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('lawyers.index') }}">المحامين</a></li>
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

                    <form action="{{ route('lawyers.store') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}

                        {{-- <div class="form-group">
                            <label>رقم الولايه</label>
                            <input type="text" name="state-no" class="form-control">
                        </div> --}}

                        <div class="form-group">
                            <label>إسم المحامى</label>
                            <input type="text" name="lawyer_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="text" name="phone_no" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">النوع</label>
                            <select name="gender" class="form-control" style="height: 40px">
                                <option value="1">ذكر</option>
                                <option value="0">انثي</option>
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
