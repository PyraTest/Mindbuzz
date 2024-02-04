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
                                <li class="breadcrumb-item active"> {{ __('admin.begin') }}
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

                                    <h3 class="card-title">{{ __('admin.begin') }}</h3>

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
                                            <a style="float:right;" href="{{ route('admin.create_benchmark', $id) }}"
                                                class="btn-lg btn-success  ">{{ __('admin.add') }}</a>
                                            <table
                                                class="table table-striped w-100 text-center display nowrap table-bordered scroll-vertical">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('admin.numbers') }} </th>
                                                        <th>{{ __('admin.programs') }} </th>
                                                        <th>{{ __('admin.test') }} </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-info">{{ $benchmarks->id }}</td>
                                                        <td class="text-info">{{ $benchmarks->number }}</td>
                                                        <td class="text-info">{{ $benchmarks->program->name }}</td>
                                                        <td class="text-info">
                                                            @if ($benchmarks->test->type == 0)
                                                                Test
                                                            @elseif ($benchmarks->test->type == 1)
                                                                Quiz
                                                            @elseif ($benchmarks->test->type == 2)
                                                                Homework
                                                            @endif
                                                        </td>

                                                        <!--<td class="text-info"></td>-->


                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>


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
