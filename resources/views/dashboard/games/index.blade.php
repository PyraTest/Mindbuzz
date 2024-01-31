<?php
$active_links = ['courses' , 'showusers'];
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


                                    
                                    <div>
                                    <table
                                        class="table table-striped w-100 text-center display nowrap table-bordered scroll-vertical">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('admin.lessons') }} </th>
                                            <th>{{ __('admin.game_type') }} </th>
                                            <th>{{ __('admin.audio') }} </th>
                                            <th>{{ __('admin.num_letter') }} </th>
                                            <th>{{ __('admin.num_letter_repeat') }} </th>
                                            <th>{{ __('admin.num_trial') }} </th>
                                            <th>{{ __('admin/forms.operations') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($games as $index => $game)
                                                <tr>
                                                    <td class="text-info">{{$index + 1}}</td>
                                                    <td class="text-info">{{$game->lesson->name}}</td>
                                                    <td class="text-info">{{$game->gameTypes->name}}</td>

                                                    <td class="text-info">
                                                        @if ($game->audio_flag == 0)
                                                            off
                                                            @else
                                                            on
                                                        @endif
                                                    
                                                    </td>
                                                    <td class="text-info">{{$game->num_of_letters}}</td>
                                                    <td class="text-info">{{$game->num_of_letter_repeat}}</td>
                                                    <td class="text-info">{{$game->num_of_trials}}</td>
         
                                                    <td>
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic example">
                                                           
                                                            <a href="{{ route('admin.edit_ending', $game->id) }}"
                                                                class="btn btn-info box-shadow-3 mr-1 "><i
                                                                    class="ft-edit"></i></a>

                                                            <a href="{{ route('admin.delete_ending', $game->id) }}"
                                                                class="delete btn btn-danger box-shadow-3 mr-1"
                                                                data-id="{{ $game->id }}"><i
                                                                    class="ft-delete"></i></a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    </div>

                                    {{-- <div class="justify-content-center d-flex">
                                        {!! $games->appends(Request::except('page'))->render() !!}
                                    </div> --}}
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

