<?php
$active_links = ['users', 'showusers'];
?>

@extends('layouts.admin')

@section('style')

    <style>
        table thead {
            background-color: #E3EBF3;
        }

        table tr th {
            cursor: pointer;
        }

        div.dataTables_wrapper div.dataTables_filter label {
            display: block !important;
        }

        .dataTables_scrollHead {
            overflow: auto !important;
        }

        .dataTables_scrollBody {
            overflow: initial !important;
            max-height: 1000px !important;
        }

        .card-body {
            padding-top: 0px !important;
        }

        .dropdown .dropdown-menu .dropdown-item {
            padding: 3px 10px !important;
        }
    </style>

@endsection

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.dashboard') }}">{{ __('admin/sidebar.main') }}</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ __('admin.programs') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                    <h3 class="card-title">{{ __('admin.programs') }}</h3>

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
                                    <div class="card-body card-dashboard">



                                        <div>
                                            <table
                                                class="table table-striped w-100 text-center display nowrap table-bordered scroll-vertical">
                                                <thead>
                                                    <tr>
                                                        <th>All</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('admin.show_program_beginnings', $programs->id) }}"
                                                                class="btn btn-info">Beginnings</a>
                                                            {{-- @foreach ($units as $unit)
                                                                Unit: <a
                                                                        href="{{ route('admin.show_program_units', $programs->id) }}"
                                                                        class="btn btn-info">{{ $unit->unit_id }}</a> 
                                                                Benchmark:<a
                                                                        href="{{ route('admin.show_program_benchmarks', $programs->id) }}"
                                                                        class="btn btn-info">{{ $unit->benchmark_id }}</a>
                                                            @endforeach --}}
                                                            <?php $index = 1;
                                                            $indexBenchmark = 1;
                                                            ?>
                                                            @foreach ($units as $benchmarkId => $benchmarkUnits)
                                                                @foreach ($benchmarkUnits as $unit)
                                                                     <a
                                                                        href="{{ route('admin.show_program_view_unit', $unit->unit_id) }}"
                                                                        class="btn btn-info">Unit:{{ $index++ }}</a>
                                                                @endforeach
                                                                 <a
                                                                    href="{{ route('admin.show_program_view_benchmark', $unit->benchmark_id) }}"
                                                                    class="btn btn-dark">Benchmark:{{ $indexBenchmark++ }}</a>
                                                            @endforeach
                                                            {{-- 
                                                            @foreach ($units as $unit)
                                                                <p>Unit: {{ $unit->unit_id }}</p>
                                                                <p>Benchmark: {{ $unit->benchmark_name }}</p>
                                                                <p>Number: {{ $unit->number }}</p>
                                                                <hr>
                                                            @endforeach --}}


                                                            <a href="{{ route('admin.show_program_endings', $programs->id) }}"
                                                                class="btn btn-info">End of year</a>
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                        {{-- <div class="justify-content-center d-flex">
                                            {!! $programs->appends(Request::except('page'))->render() !!}
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop


@section('script')


@stop
