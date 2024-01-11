<?php
$active_links = ['notifications' , 'shownotifications'];
?>

@extends('layouts.admin')

@section('style')

    <style>

        /*.card-body{
            overflow-x: auto;
        }*/
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
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ __('admin/sidebar.notifications') }}
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

                                    <h3 class="card-title">{{__('admin/sidebar.notifications')}}</h3>

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
                                                <th>{{ __('admin/forms.notification_type') }}</th>
                                                <th>{{__('admin/forms.sender_name')}}</th>
                                                <th>{{__('admin/forms.message')}}</th>
                                                <th>{{ __('admin/forms.date') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                @isset($notifications)
                                                @foreach($notifications as $noty)
                                                    <tr>
                                                        @php
                                                        $user = '';
                                                        if($noty->sender_model == 'user'){
                                                            $user = App\Models\User::find($noty->sender_id);
                                                            $from_name = $user->name;
                                                        }elseif($noty->sender_model == 'driver'){
                                                            $driver = App\Models\Driver::find($noty->sender_id);
                                                            $from_name = $driver->name;
                                                        }
                                                        @endphp
                                                        <td class="text-info">
                                                            @if ($noty->type == 'order')
                                                                <a href="{{route('admin.order.show', ['id'=> $noty->type_id])}}" class="text-info">{{__('admin/forms.'.$noty->type.'')}}</a>
                                                            @endif
                                                             : {{ $noty->type_id }}
                                                        </td>
                                                        <td>
                                                            @if ($noty->sender_model == 'user')
                                                                {{ __('admin/forms.client') }} : {{$from_name}}
                                                            @elseif ($noty->sender_model == 'driver')
                                                                {{ __('admin/forms.driver') }} : {{$from_name}}
                                                            @endif
                                                        </td>
                                                        <td>{{getNotificationMessage($noty->message_id).$noty->type_id}}</td>
                                                        <td>{{  \Carbon\Carbon::parse($noty->created_at)->toDateString().' , '. \Carbon\Carbon::parse($noty->created_at)->format('g:i A') }} </td>
                                                    </tr>
                                                @endforeach
                                            @endisset

                                            </tbody>
                                        </table>

                                        <div class="justify-content-center d-flex">
                                            {!! $notifications->appends(Request::except('page'))->render() !!}
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

