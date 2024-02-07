<?php
$active_links = ['orders' , 'showorders'];
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
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin.main')}}</a>
                            </li>
                            <li class="breadcrumb-item active"> {{__('admin.orders')}}
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

                                <h2 class="card-title">{{__('user.orders')}}</h2>

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


                                    <form action="{{ route('admin.orders.index') }}" method="get">
                                        @csrf
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <input class="form-control" type="text"
                                                        name="order_search_input"
                                                        placeholder="{{__('admin/forms.search')}}">
                                                </div>
                                            </div>

                                            <div class="col-sm-3" style="padding-right: 0px !important;">
                                                <button type="submit"
                                                    class="btn btn-outline-info btn-min-width box-shadow-3 cat_search_btn">{{__('admin/forms.search')}}
                                                </button>

                                                {{--  <a class="btn btn-outline-primary  btn-min-width box-shadow-3"
                                                    href="{{ route('admin.orders.create') }}">
                                                    {{__('admin/forms.add')}}
                                                </a>  --}}
                                            </div>

                                        </div>
                                    </form>
                                    <div>
                                    <table
                                        class="table table-striped w-100 text-center display nowrap table-bordered scroll-vertical">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('admin.user_name') }}</th>
                                            <th>{{ __('admin.driver_name') }}</th>
                                            <th>{{ __('admin.phone_user') }}</th>
                                            <th>{{ __('user.order_status') }}</th>
                                            <th>{{ __('admin.total') }}</th>
                                            <th>{{ __('admin.operations') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($orders as $index => $order)
                                                <tr>
                                                    <td class="text-info">{{$index + 1}}</td>
                                                    <td class="text-info">{{$order->user->first_name ?? ''}} {{$order->user->last_name ?? ''}}</td>
                                                    <td class="text-info">{{$order->driver->first_name ?? ''}} {{$order->driver->last_name ?? ''}}</td>
                                                    <td class="text-info">{{$order->user->phone?? ''}}</td>
                                                    @if($order->order_status == 0)
                                                        <td class="text-info success">@lang('user.New_order')</td>
                                                    @elseif($order->order_status == 1)
                                                        <td class="text-info">@lang('user.on_way')</td>
                                                    @elseif($order->order_status == 2)
                                                        <td class="text-info primary ">@lang('user.receiving_point')</td>
                                                    @elseif($order->order_status == 3)
                                                        <td class="text-info warning ">@lang('user.order_received')</td>
                                                    @elseif($order->order_status == 4)
                                                        <td class="text-info warning ">@lang('user.order_delivery_point')</td>
                                                    @elseif($order->order_status == 5)
                                                        <td class="text-info warning ">@lang('user.delivered')</td>
                                                    @else
                                                        <td class="text-info danger">@lang('user.cancel_trip')</td>
                                                    @endif
                                                    <td class="text-info">{{$order->final_total}}</td>

                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="{{route('admin.orders.show', ['id'=> $order -> id])}}"
                                                                class="btn btn-info box-shadow-3 mr-1 "><i class="ft-edit"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    </div>

                                    <div class="justify-content-center d-flex">
                                        {!! $orders->appends(Request::except('page'))->render() !!}
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

