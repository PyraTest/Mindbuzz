<?php
$active_links = ['trips' , ''];
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
                            <li class="breadcrumb-item"><a href="">{{__('admin/sidebar.main')}} </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.trips.index')}}">
                                    {{__('user.trips')}} </a>
                            </li>
                            <li class="breadcrumb-item active"> {{ $trip->id }}
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
                                        <label style="font-syle:bold; font-size:27px">@lang('user.trip_details')</label>
                                        <table class="datatable table table-stripped mb-0 datatables table-bordered">

                                            <tr>
                                                <th>#</th>
                                                <td>{{$trip->id}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.driver_name')</th>
                                                <td>{{$trip->driver->first_name??''}} {{$trip->driver->last_name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('admin.driver_phone')</th>
                                                <td>{{$trip->driver->phone?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('admin.category_name')</th>
                                                <td>{{$trip->category->name?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.customerName')</th>
                                                <td>{{$trip->user->first_name??''}} {{$trip->user->last_name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.customer_phone')</th>
                                                <td>{{$trip->user->phone?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.src_lat')</th>
                                                <td>{{$trip->src_lat}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.src_lng')</th>
                                                <td>{{$trip->src_lon}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.src_address')</th>
                                                <td>{{$trip->src_address}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.dest_lat')</th>
                                                <td>{{$trip->dest_lat}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.dest_lng')</th>
                                                <td>{{$trip->dest_lon}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.dest_address')</th>
                                                <td>{{$trip->dest_address}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.date')</th>
                                                <td>{{$trip->created_at}}</td>
                                                {{--  <td>{{$trip->created_at}} ( {{$trip->created_at->diffForHumans()}} )</td>  --}}
                                            </tr>
                                            <tr>
                                                <th>@lang('user.trip_status')</th>
                                                <td>
                                                    {{--  @if ($trip->finished == 0)
                                                    <label class="bg-info">@lang('user.current')</label>
                                                    @elseif ($trip->finished == 1)
                                                    <label class="bg-success">@lang('user.finished')</label>
                                                    @endif  --}}

                                                    @if($trip->trip_status == 'new')
                                                        <label class="text-info success">@lang('user.New_trip')</label>
                                                    @elseif($trip->trip_status == 'Underway')
                                                        <label class="text-info">@lang('user.Underway_trip')</label>
                                                    @elseif($trip->trip_status == 'completed')
                                                        <label class="text-info primary ">@lang('user.completed_trip')</label>
                                                    @elseif($trip->trip_status == 'scheduled')
                                                        <label class="text-info warning ">@lang('user.scheduled_trip')</label>
                                                    @else
                                                        <label class="text-info danger">@lang('user.cancel_trip')</label>
                                                    @endif
                                                </td>
                                            </tr>
                                            {{--  <tr>
                                                <th>@lang('admin.count_offers')</th>
                                                <td>{{$trip->count_offers}}</td>
                                            </tr>  --}}
                                            <tr>
                                                <th>@lang('admin.payment_method')</th>
                                                <td>
                                                    @if($trip->payment_method === 0)
                                                        <label class="text-info">@lang('user.visa')</label>
                                                    @elseif($trip->payment_method == 1)
                                                        <label class="text-info">@lang('user.cash')</label>
                                                    @elseif($trip->payment_method == 2)
                                                        <label class="text-info">@lang('user.wallet')</label>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.price')</th>
                                                <td>{{$trip->price}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.app_tirp_percent')</th>
                                                <td>{{$trip->app_trip_percent}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.tax_value')</th>
                                                <td>{{$trip->tax}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('user.totalPrice')</th>
                                                <td>{{$trip->final_total}}</td>
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
