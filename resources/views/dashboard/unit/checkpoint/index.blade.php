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
                                            <a style="float:right;" href="{{ route('admin.create_unit_checkpoint', $id) }}"
                                                class="btn-lg btn-success  ">{{ __('admin.add') }}</a>
                                            <table
                                                class="table table-striped w-100 text-center display nowrap table-bordered scroll-vertical">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('admin.units') }} </th>
                                                        <th>{{ __('admin.tests') }} </th>
                                                        <th>{{ __('admin.bank') }} </th>
                                                        <th>{{ __('admin/forms.operations') }}</th>
                                                        <th>{{ __('admin.views') }} </th>


                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($checkpoints as $index => $checkpoint)
                                                        <tr>
                                                            <td class="text-info">{{ $index + 1 }}</td>
                                                            <td class="text-info">{{ $checkpoint->unit->name }}</td>
                                                            <td class="text-info">

                                                                {{ $checkpoint->test->type == 0 ? 'Test' : ($checkpoint->test->type == 1 ? 'Quiz' : 'Homework') }}
                                                            </td>
                                                            <td class="text-info">{{ $checkpoint->bank_id }}</td>
                                                            <td>
                                                                <div class="btn-group" role="group"
                                                                    aria-label="Basic example">

                                                                    <a href="{{ route('admin.edit_unit_checkpoint', $checkpoint->id) }}"
                                                                        class="btn btn-info box-shadow-3 mr-1 "><i
                                                                            class="ft-edit"></i></a>
                                                                    <a href="{{ route('admin.delete_unit_checkpoint', $checkpoint->id) }}"
                                                                        class="delete btn btn-danger box-shadow-3 mr-1"
                                                                        data-id="{{ $checkpoint->id }}"><i
                                                                            class="ft-delete"></i></a>

                                                                </div>
                                                            </td>
                                                            <td class="text-info">
                                                                <a href="{{ route('admin.show_view_checkpoint', $checkpoint->id) }}"
                                                                    class="btn-info btn   ">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
                                                            </td>


                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="justify-content-center d-flex">
                                            {!! $checkpoints->appends(Request::except('page'))->render() !!}
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
