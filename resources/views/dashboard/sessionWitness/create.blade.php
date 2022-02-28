@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>الشهود</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('sessionWitness.index') }}">الشهود</a></li>
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

                    <form action="{{ route('sessionWitness.store') }}" method="POST">
                        @csrf
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label for="projectinput2">تاريخ الدعوى</label>
                            <select name="prose_date" class="form-control" style="height: 40px">
                                @foreach ($prosecutions as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->prose_date }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">رقم الشاهد</label>
                            <select name="court_name" class="form-control" style="height: 40px">
                                @foreach ($Witness as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->court_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectinput2">تصنيف الشاهد</label>
                            <select name="lawyerTo_name" class="form-control" style="height: 40px">
                                <option value="1">شاهد المدعي</option>
                                <option value="2">شاهد المدعي عليه</option>
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
