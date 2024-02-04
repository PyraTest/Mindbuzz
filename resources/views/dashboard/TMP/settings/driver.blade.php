<?php
$active_links = ['settings' , 'driversettings'];
?>

@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">{{__('admin/sidebar.main')}} </a>
                            </li>
                            <li class="breadcrumb-item active"> {{__('admin/sidebar.driver_app_settings')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h4 class="card-title" id="basic-layout-form"> أضافة قسم رئيسي </h4> --}}
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('dashboard.includes.alerts.success')
                            @include('dashboard.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body">

                                    <form class="form" action="{{route('admin.pages.driver_about_us_terms')}}"
                                        method="post">
                                        @csrf

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> بيانات الموقع ذات الترجمه
                                            </h4>
                                            <div class="row">

                                                @foreach (array_keys(config('laravellocalization.supportedLocales')) as $locale)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __('admin/forms.'.$locale.'.about_us') }}</label>
                                                        <textarea name="{{ $locale }}[about_us_driver]"
                                                            class="form-control ckeditor">
                                                        @if ($all_settings && $all_settings->where('name' , 'about_us_driver')->first() != null)
                                                        {{ $all_settings->where('name' , 'about_us_driver')->first()->translate($locale)->content }}
                                                        @endif</textarea>
                                                        @error($locale.'.about_us_driver')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @endforeach

                                                @foreach (array_keys(config('laravellocalization.supportedLocales')) as $locale)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __('admin/forms.'.$locale.'.terms') }}</label>
                                                        <textarea name="{{ $locale }}[terms_driver]"
                                                            class="form-control ckeditor" @if ($all_settings &&
                                                            $all_settings->where('name' , 'terms_driver')->first() != null)
                                                            @endif
                                                        >@if ($all_settings &&
                                                        $all_settings->where('name' , 'terms_driver')->first() != null)
                                                    {{ $all_settings->where('name' ,
                                                    'terms_driver')->first()->translate($locale)->content }}
                                                    @endif</textarea>
                                                        @error($locale.'.terms_driver')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>

@stop

@section('script')

<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>

<script>
    //ckeditor direction
    CKEDITOR.config.language = "{{ app()->getLocale() }}"
</script>

@stop
