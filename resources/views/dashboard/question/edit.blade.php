<?php
$active_links = ['sub_services', 'addsub_services'];
?>

@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            {{-- <div class="content-header row">
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
        </div> --}}
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
                                        <form class="form" action="{{ route('admin.update_question', $questions->id) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-body">


                                                <h4 class="form-section"><i class="ft-home"></i> تعديل السؤال </h4>

                                                <div class="row">



                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.number') }}</label>
                                                            <input type="text" name="number" class="form-control"
                                                                required value="{{ $questions->number }}">
                                                            @error('number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.question') }}</label>
                                                            <input type="text" name="question" class="form-control"
                                                                required value="{{ $questions->question }}">
                                                            @error('question')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.answer') }}</label>
                                                            <input type="text" name="answer" class="form-control"
                                                                required value="{{ $questions->answer }}">
                                                            @error('answer')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.test') }}</label>
                                                            <select name="test_id" id="" class="form-control">

                                                                @foreach ($tests as $test)
                                                                    <option
                                                                        value="{{ $test->id }}"{{ $questions->test_id == $test->id ? 'selected' : '' }}>
                                                                        @if ($test->type == 0)
                                                                            Test
                                                                        @elseif ($test->type == 1)
                                                                            Quiz
                                                                        @else
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
