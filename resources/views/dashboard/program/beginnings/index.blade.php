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
                                <li class="breadcrumb-item active"> {{ __('admin.users') }}
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

                                    <h3 class="card-title">{{ __('admin.users') }}</h3>

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
                                                class="table table-striped w-100 text-center display nowrap table-bordered scroll-vertical table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('admin.video') }} </th>
                                                        <th>{{ __('admin.video_author') }} </th>
                                                        <th>{{ __('admin.video_message') }} </th>
                                                        <th>{{ __('admin.documentation') }} </th>
                                                        <th>{{ __('admin.test') }} </th>
                                                        <th>{{ __('admin.programs') }} </th>
                                                        <th>{{ __('admin.test') }} </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($beginnings as $index => $beginning)
                                                        <tr>
                                                            <td class="text-info">{{ $index + 1 }}</td>
                                                            <td class="text-info"><a href="{{ $beginning->video }}"
                                                                    target="_blank">{{ $beginning->video }}</a>
                                                            </td>
                                                            <td class="text-info">{{ $beginning->video_author }}</td>
                                                            <td class="text-info">{{ $beginning->video_message }}</td>
                                                            <td class="text-info ">
                                                                <a href="{{ asset('assets/upload/documentation_files') }}/{{ $beginning->doc }}"
                                                                    target="_blank" class="text-decoration-underline">doumentation file</a>
                                                            </td>
                                                            <td class="text-info">
                                                                <a href="{{ asset('assets/upload/test_files') }}/{{ $beginning->test }}"
                                                                    target="_blank">Test file</a>
                                                            </td>
                                                            <td class="text-info">{{ $beginning->program->name }}</td>
                                                            {{-- <td class="text-info">{{ $beginning->test_id }}</td> --}}
                                                            <td class="text-info">
                                                                @if ($beginning->test_id == 0)
                                                                    Test
                                                                @elseif ($beginning->test_id == 1)
                                                                    Quiz
                                                                @elseif ($beginning->test_id == 2)
                                                                    Homework
                                                                @endif
                                                            </td>
                                                           
                                                        </tr>
                                                    @endforeach

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
