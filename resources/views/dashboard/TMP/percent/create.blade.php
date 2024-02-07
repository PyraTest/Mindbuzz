<?php
$active_links = ['markets' , ''];
?>

@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        
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
                                    <form class="form" action="{{route('admin.percent.add')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">


                                            <h4 class="form-section"><i class="ft-home"></i> بيانات الصفه </h4>
                                            <div class="row">

                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.app_trip_percent') }}</label>
                                                        <input type="text" name="percent"
                                                            class="form-control" value="{{ $percent->percent }}">
                                                        
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

<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>

<script>
    //ckeditor direction
    CKEDITOR.config.language = "{{ app()->getLocale() }}"
</script>

@stop