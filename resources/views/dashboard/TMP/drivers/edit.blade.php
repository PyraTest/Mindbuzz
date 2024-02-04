<?php
$active_links = ['drivers' , ''];
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
                            <li class="breadcrumb-item"><a href="{{route('admin.drivers.index')}}">
                                    {{__('admin.drivers')}} </a>
                            </li>
                            <li class="breadcrumb-item active"> {{ $driver->first_name }}
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
                                    {{--  <form class="form" action="#" method="post"  --}}
                                    <form class="form" action="{{route('admin.drivers.update' , ['id'=> $driver -> id])}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">


                                            <h4 class="form-section"><i class="ft-home"></i> {{__('admin.driver_info')}}</h4>

                                            <div class="row">
                                                <input type="hidden" id="driver_id" name="driver_id" value="{{ $driver->id }}" />

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.first_name') }}</label>
                                                        <input type="text" name="first_name"
                                                            class="form-control" value="{{ $driver->first_name }}" required>
                                                        @error('first_name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.last_name') }}</label>
                                                        <input type="text" name="last_name"
                                                            class="form-control" value="{{ $driver->last_name }}" required>
                                                        @error('last_name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.phone') }}</label>
                                                        <input type="text" name="phone"
                                                            class="form-control" value="{{ $driver->phone }}" required>
                                                        @error('phone')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.country_code') }}</label>
                                                        <input type="text" name="country_code"
                                                            class="form-control" value="{{ $driver->country_code }}" required>
                                                        @error('country_code')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.email') }}</label>
                                                        <input type="email" name="email"
                                                            class="form-control" value="{{ $driver->email }}" required>
                                                        @error('email')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.balance') }}</label>
                                                        <input type="text" name="balance"
                                                            class="form-control" value="{{ $driver->balance }}" required>
                                                        @error('balance')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4><label>{{ __('admin.online_trip') }} : </label></h4>
                                                        <h4><label>{{  $driver->online_trip  }}</label></h4>

                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4><label>{{ __('admin.avg_rate') }} : </label></h4>
                                                        <h4><label>{{  $driver->avg_rate  }}</label></h4>

                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4><label>{{ __('admin.count_trips') }} : </label></h4>
                                                        <h4><label>{{  $driver->count_trips  }}</label></h4>

                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4><label>{{ __('admin.total_profit') }} : </label></h4>
                                                        <h4><label>{{  $driver->profit  }}</label></h4>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label>@lang('admin.activation')</label>
                                                    <select name="active" id="" class="form-control">
                                                        <option disabled selected>@lang('user.coose_statuss')</option>
                                                        <option {{$driver->active == 0 ? 'selected':''}} value="0">@lang('user.inactive')
                                                        </option>
                                                        <option {{$driver->active == 1 ? 'selected':''}} value="1">@lang('user.active')
                                                        </option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label>@lang('user.statuss')</label>
                                                    <select name="status" id="" class="form-control">
                                                        <option disabled selected>@lang('user.coose_statuss')</option>
                                                        <option {{$driver->status == 0 ? 'selected':''}} value="0">@lang('user.inactive')
                                                        </option>
                                                        <option {{$driver->status == 1 ? 'selected':''}} value="1">@lang('user.active')
                                                        </option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label>@lang('user.trip_status')</label>
                                                    <select name="trip_status" id="" class="form-control">
                                                        <option disabled selected>@lang('user.coose_statuss')</option>
                                                        <option {{$driver->trip_status == 0 ? 'selected':''}} value="0">@lang('user.inactive')
                                                        </option>
                                                        <option {{$driver->trip_status == 1 ? 'selected':''}} value="1">@lang('user.active')
                                                        </option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label>@lang('user.order_status')</label>
                                                    <select name="order_status" id="" class="form-control">
                                                        <option disabled selected>@lang('user.coose_statuss')</option>
                                                        <option {{$driver->order_status == 0 ? 'selected':''}} value="0">@lang('user.inactive')
                                                        </option>
                                                        <option {{$driver->order_status == 1 ? 'selected':''}} value="1">@lang('user.active')
                                                        </option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" >
                                                    <div class="form-group">
                                                        <label for="projectinput1">@lang('admin.category')</label>
                                                        <select name="category_id" class="select2 form-control">
                                                            <option disabled selected >من فضلك أختر قيمه</option>
                                                                @if($categories && $categories -> count() > 0)
                                                                @foreach($categories as $ser)
                                                                <option @if ($ser->id == $driver->category_id)
                                                                    selected
                                                                @endif value="{{$ser->id }}">
                                                                    {{$ser->name}}
                                                                    </option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('category_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.car_brand') }}</label>
                                                        <input type="text" name="car_brand"
                                                            class="form-control" value="{{ $driver->car_brand }}" required>
                                                        @error('car_brand')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.car_name') }}</label>
                                                        <input type="text" name="car_name"
                                                            class="form-control" value="{{ $driver->car_name }}" required>
                                                        @error('car_name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.car_plate_number') }}</label>
                                                        <input type="text" name="car_plate_number"
                                                            class="form-control" value="{{ $driver->car_plate_number }}" required>
                                                        @error('car_plate_number')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.manufacturing_year') }}</label>
                                                        <input type="text" name="manufacturing_year"
                                                            class="form-control" value="{{ $driver->manufacturing_year }}" required>
                                                        @error('manufacturing_year')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.car_color') }}</label>
                                                        <input type="text" name="car_color"
                                                            class="form-control" value="{{ $driver->car_color }}" required>
                                                        @error('car_color')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.icon') }}</label>
                                                        <input type="file" name="photo"
                                                            class="form-control" value="{{ $driver->photo }}" >
                                                        @error('photo')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{$driver->photo??''}}" target="blank">
                                                    <img src="{{$driver->photo}}" class="img-thumbnail" style="margin-top: 2.3rem !important;width: 100px;">
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.driving_license') }}</label>
                                                        <input type="file" name="driving_license"
                                                            class="form-control" value="{{ $driver->driving_license }}" >
                                                        @error('driving_license')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{$driver->driving_license??''}}" target="blank">
                                                    <img src="{{$driver->driving_license}}" class="img-thumbnail" style="margin-top: 2.3rem !important;width: 100px;">
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.identity') }}</label>
                                                        <input type="file" name="identity"
                                                            class="form-control" value="{{ $driver->identity }}" >
                                                        @error('identity')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{$driver->identity??''}}" target="blank">
                                                    <img src="{{$driver->identity}}" class="img-thumbnail" style="margin-top: 2.3rem !important;width: 100px;">
                                                    </a>
                                                    {{--  <img src="{{$driver->identity}}" class="img-thumbnail" style="margin-top: 2.3rem !important;width: 100px;">  --}}
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.car_form') }}</label>
                                                        <input type="file" name="car_form"
                                                            class="form-control" value="{{ $driver->car_form }}" >
                                                        @error('car_form')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{$driver->car_form??''}}" target="blank">
                                                    <img src="{{$driver->car_form}}" class="img-thumbnail" style="margin-top: 2.3rem !important;width: 100px;">
                                                    </a>
                                                    {{--  <img src="{{$driver->car_form}}" class="img-thumbnail" style="margin-top: 2.3rem !important;width: 100px;">  --}}
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.full_insurance') }}</label>
                                                        <input type="file" name="full_insurance"
                                                            class="form-control" value="{{ $driver->full_insurance }}" >
                                                        @error('full_insurance')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{$driver->full_insurance??''}}" target="blank">
                                                    <img src="{{$driver->full_insurance}}" class="img-thumbnail" style="margin-top: 2.3rem !important;width: 100px;">
                                                    </a>
                                                    {{--  <img src="{{$driver->full_insurance}}" class="img-thumbnail" style="margin-top: 2.3rem !important;width: 100px;">  --}}
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
