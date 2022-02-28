@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>@lang('site.users')</h1>
            <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{route('users.index')}}">@lang('site.users')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add') {{--<small>Quick Exapm</small>--}}</h3>
                </div> <!----End box of header----->
                <div class="box-body">
                    @include('partials._errors')

                <form action="{{route('users.store')}}" method="POST">
                    @csrf
                    {{method_field('post')}}


                        <div class="form-group">
                            <label>@lang('site.name')</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.email')</label>
                            <input type="email" name="email" class="form-control" value="{{old('email')}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.password')</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.password_confirmation')</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.permissions')</label>

                             @php
                                $models = ['users' ,'customers','customerTo' ,'local','state','lawyers','work','cause_lawsuit' ,'subject_consult','prose_text'
                            ,'courts' ,'contract_subject','claimants_works','administrative_unit','witness','clients','judges','clientsTo','prosecution'
                            ,'sessions','sessions_witness','appeal','consults','contract','authorization','address','messages','subject_authorization'];

                                $maps = ['create' ,'read' ,'update','delete'];
                            @endphp 

                            <div class="card card-primary card-tabs">
                                <div class="card-header p-0 pt-1">
                                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                  
                                   
                                     @foreach ($models as $index=>$model)
                                    <li class="nav-item">    
                                    <a class="nav-link {{$index == 0 ? 'active' : ''}}" id="custom-tabs-one-home-tab" data-toggle="pill" href="#{{$model}}" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">@lang('site.'.$model)</a>
                                        </li>
                                         @endforeach 
                                  </ul>
                                </div>
                                <div class="card-body">
                                  <div class="tab-content" id="custom-tabs-one-tabContent">

                                       @foreach ($models as $index=> $model)
                                        <div class="tab-pane fade {{$index == 0 ? 'active' : ''}}" id="{{$model}}" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                            
                                            @foreach ($maps as $map)

                                                <label><input type="checkbox" name="permissions[]" value="{{$model. '_' .$map}}" id="">@lang('site.' .$map)</label>
                                            
                                            @endforeach
                                        </div>
                                      @endforeach 
                                  </div>
                                </div>
                                <!-- /.card -->
                              </div>
    
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class=" fa fa-plus">@lang('site.add')</i></button>
                            </div>
                        </div>

            
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection