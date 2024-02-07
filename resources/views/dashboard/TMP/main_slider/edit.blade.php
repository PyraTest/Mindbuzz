<?php
$active_links = ['main_slider' , ''];
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
                            <li class="breadcrumb-item"><a href="{{route('admin.main_slider')}}">
                                    {{__('admin/sidebar.main_slider')}} </a>
                            </li>
                            <li class="breadcrumb-item active"> {{ $main_slider->id }}
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
                                    <form class="form"
                                        action="{{route('admin.main_slider.update' , ['id'=> $main_slider->id])}}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">


                                            <h4 class="form-section"><i class="ft-home"></i> بيانات السلايدر </h4>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="image"> {{ __('admin/forms.image') }}
                                                            </label>
                                                            <input type="file" id="image" class="form-control"
                                                                name="image">
                                                            @error("image")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <img src="/assets/images/sliders/{{$main_slider->image_ar}}" class="img-thumbnail"
                                                            style="margin-top: 2.3rem !important;width: 50px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!--<div class="col-md-6">-->
                                            <!--    <div class="form-group">-->
                                            <!--        <label> {{ __('admin/forms.type') }}</label>-->
                                            <!--        <select data-dependent="type_id" id="type" name="type" class="select2 form-control dynamic">-->
                                            <!--            <option value="" selected>من فضلك أختر قيمه</option>-->
                                            <!--            <option @if ($main_slider->type == 'product')-->
                                            <!--                selected-->
                                            <!--                @endif value="product">منتج</option>-->
                                            <!--            <option @if ($main_slider->type == 'category')-->
                                            <!--                selected-->
                                            <!--                @endif value="category">قسم</option>-->
                                            <!--            </optgroup>-->
                                            <!--        </select>-->
                                            <!--        @error('type')-->
                                            <!--        <span class="text-danger"> {{$message}}</span>-->
                                            <!--        @enderror-->
                                            <!--    </div>-->
                                            <!--</div>-->

                                            <!--<div class="col-md-6">-->
                                            <!--    <div class="form-group">-->
                                            <!--        <label> {{ __('admin/forms.type_id') }} <i id="loader" class="la la-spinner spinner text-info font-large-1" style="visibility: hidden;"></i></label>-->
                                            <!--        <select id="type_id" name="type_id" class="select2 form-control">-->
                                            <!--            <option value="{{ $main_slider->type_id }}" selected >-->
                                            <!--                @if ($main_slider->type == 'product')-->
                                            <!--                {{ App\Models\Product::find($main_slider->type_id)->name }}-->
                                            <!--                @elseif ($main_slider->type == 'category')-->
                                            <!--                    {{ App\Models\Category::find($main_slider->type_id)->name }}-->
                                            <!--                @endif-->
                                            <!--            </option>-->
                                            <!--        </select>-->
                                            <!--        @error('type_id')-->
                                            <!--        <span class="text-danger"> {{$message}}</span>-->
                                            <!--        @enderror-->
                                            <!--    </div>-->
                                            <!--</div>-->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="desc"> {{ __('admin/forms.description') }} </label>
                                                    <input type="text" id="desc" class="form-control" name="description }}"
                                                        value="{{ $main_slider->desc_ar }}">
                                                    @error("desc")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="link"> {{ __('admin/forms.link') }} </label>
                                                    <input type="text" id="link" class="form-control" name="link"
                                                        value="{{ $main_slider->link }}">
                                                    @error("link")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
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