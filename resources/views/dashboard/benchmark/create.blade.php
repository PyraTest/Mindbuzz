<?php
$active_links = ['sub_services', 'addsub_services'];
?>
@section('style')

@endsection
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
                                        <form class="form" action="{{ route('admin.add_benchmark') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">


                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المعيار </h4>

                                                <div class="row">



                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.numbers') }}</label>
                                                            <input type="text" name="number" class="form-control"
                                                                required>
                                                            @error('number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.programs') }}</label>
                                                            <select name="program_id" class="form-control" id="program">
                                                                <option value="" selected disabled>Select program</option>
                                                                @foreach ($programs as $program)
                                                                    <option value="{{ $program->id }}">{{ $program->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('program_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.test') }}</label>
                                                            <select name="test_id" class="form-control" id="">
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
                                                            @error('answer')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.units') }}</label>
                                                            {{-- <select class="js-select-unit form-control" id="unit"
                                                                name="unit_id[]" multiple="multiple">

                                                                @foreach ($units as $unit)
                                                                    <option value="{{ $unit->id }}"
                                                                        data-program="{{ $unit->program_id }}">
                                                                        {{ $unit->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select> --}}
                                                            <select id="unit" name="unit_id[]" class="js-select-unit form-control"></select>

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
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <script>
        $('#unit').hide();

        // Fetch units based on the selected program
        $('#program').on('change', function() {
            var selectedProgram = $(this).val();

            // Make an Ajax request to get units for the selected program
            $.ajax({
                url: 'post-units/' + selectedProgram,
                type: 'GET',
                success: function(data) {
                    // Update unit options based on the Ajax response
                    $('#unit').html('');
                    $.each(data, function(index, unit) {
                        $('#unit').append('<option value="' + unit.id + '">' + unit.name +
                            '</option>');
                    });

                    // Show the updated unit dropdown
                    $('#unit').show();

                    // Update Select2 to reflect changes
                    $('#unit').val('').trigger('change');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>

@stop
