@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>التوكيلات</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('authorization.index') }}">التوكيلات</a></li>
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

                    <form action="{{ route('authorization.update' ,$authorization->id) }}" method="POST">
                        @csrf
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label> تاريخ التوكيل</label>
                            <input type="date" name="authorization_date" class="form-control" value="{{$authorization->authorization_date}}">
                        </div>

                        <div class="form-group">
                            <label> نوع التوكيل</label>
                            <input type="text" name="authorization_type" class="form-control"  value="{{$authorization->authorization_type}}">
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">إسم الموكل</label>
                            <select name="client_name" class="form-control" style="height: 40px">
                                @foreach ($clients as $key => $value)
                                    <option value="{{ $value->id }}" @if ($authorization->client_name == $value->id)
                                        selected
                                    @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">إسم الموكل له</label>
                            <select name="clientTo_name" class="form-control" style="height: 40px">
                                @foreach ($clientTo as $key => $value)
                                    <option value="{{ $value->id}}" @if ($authorization->clientTo_name == $value->id)
                                        selected
                                    @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>رقم موضوع التوكيل</label>
                            <input type="text" name="authorization_subject_no" class="form-control" value="{{$authorization->authorization_subject_no}}">
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">إسم الشاهد الاول</label>
                            <select name="first_witness_no" class="form-control" style="height: 40px">
                                @foreach ($witness as $key => $value)
                                    <option value="{{ $value->id}}" @if ($authorization->first_witness_no == $value->id)
                                        selected
                                    @endif>{{ $value->witness_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">إسم الشاهد الثاني</label>
                            <select name="second_witness_no" class="form-control" style="height: 40px">
                                @foreach ($witness as $key => $value)
                                    <option value="{{ $value->id}}" @if ($authorization->second_witness_no == $value->id)
                                        selected
                                    @endif>{{ $value->witness_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>ملاحظات</label>
                            <textarea name="command" id="" class="form-control" cols="4" rows="4">{{$authorization->command}}</textarea>
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
