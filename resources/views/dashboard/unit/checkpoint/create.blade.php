<?php
$active_links = ['sub_services', 'addsub_services'];
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
                                        <form class="form" action="{{ route('admin.store_unit_checkpoint') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">


                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المادة </h4>

                                                <div class="row">



                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.units') }}</label>
                                                            <select name="unit_id" id="" class="form-control">
                                                                @foreach ($units as $unit)
                                                                    <option value="{{ $unit->id }}">{{ $unit->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('unit_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.tests') }}</label>
                                                            <select name="test_id" id="" class="form-control">
                                                                @foreach ($tests as $test)
                                                                    <option value="{{ $test->id }}">
                                                                        @if ($test->type == 0)
                                                                            Test
                                                                        @elseif ($test->type == 1)
                                                                            Quiz
                                                                        @elseif ($test->type == 2)
                                                                            Homework
                                                                        @endif

                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('test_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.bank') }}</label>
                                                            <select name="bank_id" id="" class="form-control">
                                                                @foreach ($banks as $bank)
                                                                    <option value="{{ $bank->id }}">
                                                                        {{ $bank->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('program_id')
                                                                <span class="text-danger">{{ $message }}</span>
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
                                                    <i class="la la-check-square-o"></i> اضافة
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
