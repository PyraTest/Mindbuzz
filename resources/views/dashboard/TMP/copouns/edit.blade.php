<?php
$active_links = ['copouns' , 'addcopouns'];
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
                            <li class="breadcrumb-item"><a href="{{route('admin.copouns.index')}}">
                                    {{__('admin/sidebar.copouns')}} </a>
                            </li>
                            <li class="breadcrumb-item"> <a href="#">{{$copoun->code}}</a>
                            </li>
                            <li class="breadcrumb-item"> {{__('admin/forms.edit')}}
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

                            {{-- @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="container">
                                <div class="alert alert-danger">
                                    <p class="text-white">{{ $error }}</p>
                                </div>
                            </div>
                            @endforeach
                            @endif --}}

                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{route('admin.copouns.update' , $copoun->id)}}" method="post" >
                                        @csrf

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> بيانات كوبون الخصم </h4>

                                            <input type="hidden" name="id" value="{{$copoun->id}}">

                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="code"> {{ __('admin/forms.code') }} </label>
                                                        <input type="text" id="code" class="form-control"
                                                            name="code" value="{{ $copoun->code }}">
                                                        @error("code")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="val"> {{ __('admin/forms.val') }} </label>
                                                        <input type="number" id="val" class="form-control"
                                                            name="val" value="{{ $copoun->value }}">
                                                        @error("val")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="max_price"> {{ __('admin/forms.max_price') }} </label>
                                                        <input type="number" id="max_price" class="form-control"
                                                            name="max_price" value="{{ $copoun->max_price }}">
                                                        @error("max_price")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="max_users"> {{ __('admin/forms.max_users') }} </label>
                                                        <input type="number" id="max_users" class="form-control"
                                                            name="max_users" value="{{ $copoun->max_users }}">
                                                        @error("max_users")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="expire_date"> {{ __('admin/forms.expire_date') }} </label>
                                                        <input type="date" id="expire_date" class="form-control"
                                                            name="expire_date" value="{{ $copoun->expire_date }}">
                                                        @error("expire_date")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        {{-- <textarea name="about_ar" id="" class="form-control ckeditor" cols="30"
                                            rows="10"></textarea> --}}


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