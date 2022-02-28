@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الدعاوي</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('prosecution.index') }}">الدعاوي</a></li>
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

                    <form action="{{ route('prosecution.update' ,$prosecution->id) }}" method="POST">
                        @csrf
                        {{ method_field('put') }}

                    <div class="form-group">
                        <label>تاريخ الدعوه</label>
                        <input type="date" name="prose_date" class="form-control"   value="{{$prosecution->prose_date}}">
                    </div>

                    <div class="form-group">
                        <label for="projectinput2">المدعي</label>
                        <select name="customer_name" class="form-control" style="height: 40px">
                            @foreach ($customers as $key => $value)
                                <option value="{{ $value->id }}" @if ($value->id == $prosecution->customer_name)
                                    selected
                                @endif>{{ $value->customer_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="projectinput2">المدعي عليه</label>
                        <select name="customerTo_name" class="form-control" style="height: 40px">
                            @foreach ($customerTo as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->customerTo_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="projectinput2">موضوع الدعوه</label>
                        <select name="prose_text_name" class="form-control" style="height: 40px">
                            @foreach ($proseText as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->prose_text_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="projectinput2">تصنيف الدعوه</label>
                        <select name="prose_type" class="form-control" style="height: 40px">
                            {{--  {{}}  --}}
                            @foreach (ProseType() as $key => $item)
                            <option value="{{$key}}" @if ($key == $prosecution->prose_type)
                                selected
                            @endif>{{$item}}</option>
                            @endforeach  
                                
                                {{--  <option value="2">مدنية</option>
                                <option value="3">شرعية</option>
                                <option value="4">إدارية</option>  --}}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="projectinput2">سبب الدعوه</label>
                        <select name="cause_lawsuit_name" class="form-control" style="height: 40px">
                            @foreach ($causeLawsuit as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->cause_law_name  }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>ملاحظات</label>
                        <textarea name="command" id="" class="form-control" cols="4" rows="4">{{ $prosecution->command}}</textarea>
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
