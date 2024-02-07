<?php
$active_links = ['sub_services' , 'addsub_services'];
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
                            <li class="breadcrumb-item"><a href="{{route('admin.sub_services')}}">
                                    {{__('admin.sub_services')}} </a>
                            </li>
                            <li class="breadcrumb-item active"> {{__('admin.add_sub_services')}}
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
                                    <form class="form" action="{{route('admin.sub_services.store')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">


                                            <h4 class="form-section"><i class="ft-home"></i> بيانات خدمة فرعية </h4>

                                            <div class="row">
                                                @foreach  (config('translatable.locales') as $index => $locale)
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('admin/forms.'.$locale.'.name') }}</label>
                                                        <input type="text" name="{{ $locale }}[name]"
                                                            class="form-control" value="{{ old($locale . '.name') }}" required>
                                                        @error($locale.'.name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @endforeach

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('admin.select_service')</label>
                                                        <select name="service_id" class="select2 form-control">
                                                            <option disabled selected >من فضلك أختر قيمه</option>
                                                                @if($services && $services -> count() > 0)
                                                                @foreach($services as $service)
                                                                <option value="{{$service->id }}">{{$service->name}}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('service_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.icon') }}</label>
                                                        <input type="file" name="icon"
                                                            class="form-control" value="{{ old('icon') }}" required>
                                                        @error('icon')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>


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

@stop
