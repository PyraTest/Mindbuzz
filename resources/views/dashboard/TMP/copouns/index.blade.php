<?php
$active_links = ['copouns' , 'showcopouns'];
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
                                    href="{{route('admin.dashboard')}}">{{__('admin/sidebar.main')}}</a>
                            </li>
                            <li class="breadcrumb-item active"> {{__('admin/sidebar.copouns')}}
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
                                
                                <h3 class="card-title">{{__('admin/sidebar.copouns')}}</h3>

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

                            <div class="card-content collapse show" id="table_data" style="transition: all 1s;">

                                @include('dashboard.copouns.pagination_data' , $copouns)

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

<script>
    $(document).ready(function () {





    });
</script>

@stop