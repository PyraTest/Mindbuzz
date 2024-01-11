<?php
$active_links = ['users' , 'showusers'];
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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/sidebar.main')}}</a>
                            </li>
                            <li class="breadcrumb-item active"> {{__('admin.users')}}
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

                                <h3 class="card-title">{{__('admin.users')}}</h3>

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


                                    <form action="{{ route('admin.salons.salon_res',$_GET['salon']) }}" method="get">
                                        @csrf
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <input class="form-control" type="text"
                                                        name="arrive"
                                                        placeholder="{{__('admin/forms.search')}}">
                                                </div>
                                                
                                                 <div class="btn-group" role="group" aria-label="Basic example">
                                                            
                                                            <a href="{{route('admin.salons.salon_res',['arrive' => 0,'salon' => $_GET['salon']])}}"
                                                                class=" btn btn-success box-shadow-3 mr-1 ">لم يبدأ بعد</a>
                                                            <a href="{{route('admin.salons.salon_res',['arrive' => 1, 'salon' => $_GET['salon']])}}"
                                                                class=" btn btn-warning box-shadow-3 mr-1 ">وصل العميل</a>
                                                            <a href="{{route('admin.salons.salon_res',['arrive' => 2, 'salon' => $_GET['salon']])}}"
                                                                class=" btn btn-danger box-shadow-3 mr-1 ">منهي</a>
                                                            <a href="{{route('admin.salons.salon_res',['arrive' => 3,'salon' => $_GET['salon']])}}"
                                                                class=" btn btn-info box-shadow-3 mr-1 ">ملغي</a>

                                                        </div>
                                            </div>

                                            <div class="col-sm-3" style="padding-right: 0px !important;">
                                                <button type="submit"
                                                    class="btn btn-outline-info btn-min-width box-shadow-3 cat_search_btn">{{__('admin/forms.search')}}
                                                </button>

                                                {{--  <a class="btn btn-outline-primary  btn-min-width box-shadow-3"
                                                    href="{{ route('admin.users.create') }}">
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
                                            <th>{{ __('admin.Salon') }}</th>
                                            <th>{{ __('admin.assistant') }}</th>
                                            <th>{{ __('admin.customer') }}</th>
                                            <th>{{ __('admin.date') }}</th>
                                            <th>{{ __('admin.time') }}</th>
                                            <th>{{ __('admin.status') }}</th>
                                            <!--{{--  <th>{{ __('admin.balance') }}</th>  --}}-->
                                            <!--<th>{{ __('admin.icon') }}</th>-->
                                            <th>{{ __('admin/forms.operations') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($reservations as $index => $reservation)
                                                <tr>
                                                    <td class="text-info">{{$index + 1}}</td>
                                                    <td class="text-info">{{translateSalon($reservation->salon_id)}}</td>
                                                    <td class="text-info">{{translateUser($reservation->user_id) ?? ''}}</td>
                                                    <td class="text-info">{{translateUser($reservation->customer_id)}}</td>
                                                    <td class="text-info">{{$reservation->date}}</td>
                                                    <td class="text-info">{{date('H:i:s a',strtotime($reservation->time))}}</td>
                                                    <td class="text-info">{{translateArriveStatus($reservation->arrive_flag)}}</td>
                                                    <!--{{-- @if($salon->gender == '1')-->
                                                    <!--    <td class="text-info">@lang('admin.man')</td>-->
                                                    <!--@else-->
                                                    <!--    <td class="text-info">@lang('admin.woman')</td>-->
                                                    <!--@endif --}}-->
                                                    <!--{{--  <td class="text-info">{{$user->balance}}</td>  --}}-->
                                                    <!--<td><img src="{{$reservation->image}}" class="img-thumbnail" style="width: 50px;"></td>-->

                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            
                                                            <!--<a href="{{route('admin.salons.edit', ['id'=> $reservation -> id])}}"-->
                                                            <!--    class="btn btn-info box-shadow-3 mr-1 "><i class="ft-edit"></i></a>-->

                                                            <!-- <a href="{{route('admin.salons.delete', ['id'=> $reservation -> id])}}"-->
                                                            <!--    class="delete btn btn-danger box-shadow-3 mr-1 "><i class="ft-delete"></i></a>-->
                                                            <!--<a href="{{route('admin.salons.salon_assistants', ['id'=> $reservation -> id])}}"-->
                                                            <!--    class="delete btn btn-success box-shadow-3 mr-1 ">الموظفين</a>-->
                                                            <!--<a href="{{route('admin.salons.salon_res', ['id'=> $reservation -> id])}}"-->
                                                            <!--    class="delete btn btn-warning box-shadow-3 mr-1 ">الحجوزات</a>-->

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    </div>

                                    <div class="justify-content-center d-flex">
                                        {!! $reservations->appends(Request::except('page'))->render() !!}
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

