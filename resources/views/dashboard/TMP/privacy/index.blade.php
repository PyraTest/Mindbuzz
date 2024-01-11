<?php
$active_links = ['markets' , ''];
?>

@extends('layouts.admin')

@section('style')

    <style>

        table thead{
            background-color: #E3EBF3;
        }
        
        table tr th{
            cursor: pointer;
        }
        
        div.dataTables_wrapper div.dataTables_filter label {
            display: block !important;
        }

        .dataTables_scrollHead{
            overflow: auto !important;
        }
        .dataTables_scrollBody{
            overflow: initial !important;
            max-height: 1000px !important;
        }
        .card-body{
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
            
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                    <h3 class="card-title">{{__('admin/forms.attributes')}}</h3>

                                     <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
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

                                        
                                       

                                        <table
                                            class="table w-100 text-center display nowrap table-bordered scroll-vertical">
                                            <thead >
                                            <tr>
                                                <th>{{__('admin.en.terms')}}</th>
                                                <th>{{ __('admin.ar.terms') }}</th>
                                                 <th>{{ __('admin/forms.operations') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($privacy)
                                                @foreach($privacy as $pri)
                                                    <tr>
                                                        <td>{{ $pri->privacy_en }}</td>
                                                        <td>{{$pri ->privacy}}</td>
                                                    <td><div class="btn-group" role="group" aria-label="Basic example">
                                                            
                                                            <a href="{{route('admin.privacy.edit', ['id'=> $pri -> id])}}"
                                                                class="btn btn-info box-shadow-3 mr-1 "><i class="ft-edit"></i></a>


                                                        </div></td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>

                                        <div class="justify-content-center d-flex">
                                            {!! $privacy->appends(Request::except('page'))->render() !!}
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

