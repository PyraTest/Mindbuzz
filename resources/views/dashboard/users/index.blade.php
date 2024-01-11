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


                                    <form action="{{ route('admin.users.index') }}" method="get">
                                        @csrf
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <input class="form-control" type="text"
                                                        name="user_search_input"
                                                        placeholder="{{__('admin/forms.search')}}">
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
                                            <th>{{ __('admin.name') }} </th>
                                            <th>{{ __('admin.count') }} </th>
                                            <th>{{ __('admin.city') }}</th>
                                            <th>{{ __('admin.phone') }}</th>
                                            {{--  <th>{{ __('admin.balance') }}</th>  --}}
                                            <th>{{ __('admin.icon') }}</th>
                                            <th>{{ __('admin/forms.operations') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($users as $index => $user)
                                            
                                                <tr>
                                                    <td class="text-info">{{$index + 1}}</td>
                                                    <td class="text-info">{{$user->name}}</td>
                                                    <td class="text-info">{{\App\Models\Advertisment::where('user_id',$user->id)->count()}}</td>
                                                    
                                                    <td class="text-info">{{$user->city}}</td>
                                                    <td class="text-info">{{$user->country_code.' '.$user->phone}}</td>
                                                    
                                                    <!--<td class="text-info"></td>-->
                                                    
                                                    <!--@if($user->gender == '1')-->
                                                    <!--    <td class="text-info">@lang('admin.man')</td>-->
                                                    <!--@else-->
                                                    <!--    <td class="text-info">@lang('admin.woman')</td>-->
                                                    <!--@endif-->
                                                    {{--  <td class="text-info">{{$user->balance}}</td>  --}}
                                                    <td><img src="{{$user->photo}}" class="img-thumbnail" style="width: 50px;"></td>

                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            {{--  @if($user->type == '1')
                                                                <a href="{{route('admin.users.active', ['id'=> $user->id])}}"
                                                                        class="btn btn-outline-danger box-shadow-3 mr-1 ">@lang('admin.inactive')</a>
                                                            @else
                                                                <a href="{{route('admin.users.active', ['id'=> $user->id])}}"
                                                                        class="btn btn-outline-primary box-shadow-3 mr-1 ">@lang('admin.active')</a>
                                                            @endif  --}}
                                                            <a href="{{route('admin.users.edit', ['id'=> $user -> id])}}"
                                                                class="btn btn-info box-shadow-3 mr-1 "><i class="ft-edit"></i></a>

                                                            <a href="{{route('admin.users.delete', ['id'=> $user -> id])}}"
                                                                class="delete btn btn-danger box-shadow-3 mr-1 "><i class="ft-delete"></i></a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    </div>

                                    <div class="justify-content-center d-flex">
                                        {!! $users->appends(Request::except('page'))->render() !!}
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

