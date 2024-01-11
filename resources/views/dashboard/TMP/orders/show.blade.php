<?php
$active_links = ['orders' , ''];
?>

@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">{{__('admin.main')}} </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.orders.index')}}">
                                    {{__('user.orders')}} </a>
                            </li>
                            <li class="breadcrumb-item active"> {{ $order->id }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
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
                                    <div class="table-responsive">
                                        <label style="font-syle:bold; font-size:27px">@lang('user.order_details')</label>
                                        <table class="datatable table table-stripped mb-0 datatables table-bordered">

                                            <tr>
                                                <th>#</th>
                                                <td>{{$order->id}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.driver_name')</th>
                                                <td>{{$order->driver->first_name??''}} {{$order->driver->last_name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('admin.driver_phone')</th>
                                                <td>{{$order->driver->phone?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('admin.category_name')</th>
                                                <td>{{$order->driver->category->name?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.customerName')</th>
                                                <td>{{$order->user->first_name??''}} {{$order->user->last_name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.customer_phone')</th>
                                                <td>{{$order->user->phone?? ''}}</td>
                                            </tr>

                                            <tr>
                                                <th>@lang('user.content')</th>
                                                <td>{{$order->content}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.photo_one')</th>
                                                <td>
                                                    <a href="{{$order->photo_one??''}}" target="blank">
                                                        <img src="{{ $order->photo_one }}" style="width:50px" class="img-thumbnail" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.photo_two')</th>
                                                <td>
                                                    <a href="{{$order->photo_two??''}}" target="blank">
                                                        <img src="{{ $order->photo_two }}" style="width:50px" class="img-thumbnail" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.photo_three')</th>
                                                <td>
                                                    <a href="{{$order->photo_three??''}}" target="blank">
                                                        <img src="{{ $order->photo_three }}" style="width:50px" class="img-thumbnail" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.src_lat')</th>
                                                <td>{{$order->src_lat}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.src_lng')</th>
                                                <td>{{$order->src_lon}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.src_address')</th>
                                                <td>{{$order->src_address}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.dest_lat')</th>
                                                <td>{{$order->dest_lat}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.dest_lng')</th>
                                                <td>{{$order->dest_lon}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.dest_address')</th>
                                                <td>{{$order->dest_address}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.date')</th>
                                                <td>{{$order->created_at}}</td>
                                                {{--  <td>{{$order->created_at}} ( {{$order->created_at->diffForHumans()}} )</td>  --}}
                                            </tr>
                                            <tr>
                                                <th>@lang('user.order_status')</th>
                                                <td>
                                                    {{--  @if ($trip->finished == 0)
                                                    <label class="bg-info">@lang('user.current')</label>
                                                    @elseif ($trip->finished == 1)
                                                    <label class="bg-success">@lang('user.finished')</label>
                                                    @endif  --}}

                                                    @if($order->order_status == 0)
                                                        <label class="text-info success">@lang('user.New_order')</label>
                                                    @elseif($order->order_status == 1)
                                                        <label class="text-info">@lang('user.on_way')</label>
                                                    @elseif($order->order_status == 2)
                                                        <label class="text-info primary ">@lang('user.receiving_point')</label>
                                                    @elseif($order->order_status == 3)
                                                        <label class="text-info warning ">@lang('user.order_received')</label>
                                                    @elseif($order->order_status == 4)
                                                        <label class="text-info warning ">@lang('user.order_delivery_point')</label>
                                                    @elseif($order->order_status == 5)
                                                        <label class="text-info warning ">@lang('user.delivered')</label>
                                                    @else
                                                        <label class="text-info danger">@lang('user.cancel_trip')</label>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.order_end_time')</th>
                                                {{--  <td>{{$order->order_end_time}}</td>  --}}
                                                <td>{{$order->order_end_time}} </td>
                                                {{--  <td>{{$order->order_end_time}} ( {{$order->order_end_time->diffForHumans()?? ''}} )</td>  --}}
                                            </tr>
                                            {{--  <tr>
                                                <th>@lang('admin.count_offers')</th>
                                                <td>{{$order->count_offers}}</td>
                                            </tr>  --}}
                                            <tr>
                                                <th>@lang('admin.payment_method')</th>
                                                <td>
                                                    @if($order->payment_method === 0)
                                                        <label class="text-info">@lang('user.visa')</label>
                                                    @elseif($order->payment_method == 1)
                                                        <label class="text-info">@lang('user.cash')</label>
                                                    @elseif($order->payment_method == 2)
                                                        <label class="text-info">@lang('user.wallet')</label>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.price')</th>
                                                <td>{{$order->price}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.app_order_percent')</th>
                                                <td>{{$order->app_order_percent}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.tax_value')</th>
                                                <td>{{$order->tax}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.totalPrice')</th>
                                                <td>{{$order->final_total}}</td>
                                            </tr>
                                        </table>
                                    </div>
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
