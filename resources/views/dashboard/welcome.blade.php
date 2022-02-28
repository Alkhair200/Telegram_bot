@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class='content-header'>
            <h1>@lang('site.home')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                {{--  <li class="active">@lang('site.users')</li>  --}}
            </ol>
        </section>
 
    </div>
@endsection

@push('scripts')

@endpush
