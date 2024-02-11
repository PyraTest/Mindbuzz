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
                                        <form class="form" action="{{ route('admin.add_question') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">


                                                <h4 class="form-section"><i class="ft-home"></i> بيانات السؤال </h4>

                                                <div class="row">




                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.question') }}</label>
                                                            <input type="text" name="question" class="form-control"
                                                                >
                                                            @error('question')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.hint') }}</label>
                                                            <input type="text" name="hint" class="form-control">
                                                            @error('hint')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" id="ans">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.answer') }}</label>
                                                            <textarea name="answer" class="form-control" id="answer" cols="30" rows="10"></textarea>
                                                            @error('answer')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" id="ans_choice">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.answer') }}</label>
                                                            <select id="choice_ans" name="choice_ans" class="form-control">


                                                            </select>
                                                            @error('answer')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 hidden" id="trueOrFalse">
                                                        <div class="form-group ">
                                                            <label>{{ __('admin.trueOrFalse') }}</label>
                                                            <select name="true_flag" id="" class="form-control ">
                                                                <option value=""disapled selected>
                                                                    {{ __('admin.trueOrFalse') }}</option>
                                                                <option value="0">{{ __('admin.false') }}</option>
                                                                <option value="1">{{ __('admin.true') }}</option>
                                                            </select>
                                                            @error('trueOrFalse')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.test') }}</label>
                                                            <select name="test_id" id="" class="form-control">
                                                                @foreach ($tests as $test)
                                                                    <option value="{{ $test->id }}">
                                                                        @if ($test->type == 0)
                                                                            test
                                                                        @elseif ($test->type == 1)
                                                                            quiz
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



                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.type') }}</label>
                                                            <select name="type" id="type_id" class="form-control">
                                                                <option value="" selected disabled>Select type
                                                                </option>
                                                                <option value="0">
                                                                    Complete question
                                                                </option>
                                                                <option value="1">
                                                                    Choices
                                                                </option>
                                                                <option value="2">
                                                                    True / False
                                                                </option>
                                                            </select>
                                                            @error('type_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="choices" id="choices" style="width:100%">
                                                        <div class="col-md-6">
                                                            <label>{{ __('admin.choices') }}</label>
                                                            <div class="form-group row" id="choice_div">


                                                                {{-- <input type="text" id="choices" name="choice[]" style="width:50%" class="form-control"
                                                                > 
                                                                <button id="add_to_select" type="button" class="btn btn-success" style="width:25%">ADD TO CHOICES</button> --}}



                                                            </div>
                                                            <span id="add_choice" class="btn btn-primary">+</span>
                                                        </div>

                                                    </div>

                                                    <div class="complete" id="complete" style="width:100%">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>{{ __('admin.first_part') }}</label>
                                                                <input type="text" name="first_part"
                                                                    class="form-control">


                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>{{ __('admin.second_part') }}</label>
                                                                <input type="text" name="second_part"
                                                                    class="form-control">


                                                            </div>
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
