<?php
$active_links = ['users' , ''];
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
                            <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">
                                    {{__('admin.users')}} </a>
                            </li>
                            <li class="breadcrumb-item active"> {{ $salon->first_name }}
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
                                    {{--  <form class="form" action="#" method="post"  --}}
                                    <form class="form" action="{{route('admin.salons.update' , ['id'=> $salon -> id])}}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="form-body">


                                            <h4 class="form-section"><i class="ft-home"></i> {{__('admin.user_info')}}</h4>

                                            <div class="row">
                                                <input type="hidden" id="user_id" name="user_id" value="{{ $salon->user_id }}" />

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.name') }}</label>
                                                        <input type="text" name="name"
                                                            class="form-control" value="{{ $salon->name }}" required>
                                                        @error('name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.last_name') }}</label>
                                                        <input type="text" name="last_name"
                                                            class="form-control" value="{{ $salon->last_name }}" required>
                                                        @error('last_name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.description') }}</label>
                                                        <input type="text" name="description"
                                                            class="form-control" value="{{ $salon->description }}" required>
                                                        @error('description')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.address') }}</label>
                                                        <input type="text" name="address"
                                                            class="form-control" value="{{ $salon->address }}" required>
                                                        @error('address')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.country') }}</label>
                                                        <input type="text" name="country"
                                                            class="form-control" value="{{ $salon->country }}" >
                                                        @error('country')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.is_owner') }}</label>
                                                        <input disabled type="text" name="is_owner"
                                                            class="form-control" value="{{translateIsOwner($salon->is_owner) }}" required>
                                                        @error('is_owner')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div> --}}
                                               
                                                {{-- @if($salon)
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.Salon') }}</label>
                                                        <input disabled type="text" name="salon"
                                                            class="form-control" value="{{$salon->name}}" required>
                                                        @error('salon')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @endif --}}


                                              
                                                
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.icon') }}</label>
                                                        <input type="file" name="image"
                                                            class="form-control" value="{{ $salon->image }}" >
                                                        @error('image')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{$salon->image ?? ''}}" target="blank">
                                                    <img src=" {{$salon->image}}" class="img-thumbnail" style="margin-top: 2.3rem !important;width: 100px;">
                                                    </a>
                                                </div>
                                                
                                            </div>

                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> تحديث
                                            </button>
                                        </div>
                                    </form>

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
