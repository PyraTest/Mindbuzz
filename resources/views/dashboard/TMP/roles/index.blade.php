<?php
$active_links = ['roles' , 'show_roles'];
?>

@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                {{-- <h3 class="content-header-title">الصلاحيات </h3> --}}
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active">الصلاحيات
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
                                <h4 class="card-title"> الصلاحيات </h4>
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
                                <div class="card-body card-dashboard" style="overflow-x: auto;">
                                    <table class="table text-center display nowrap table-striped table-bordered">
                                        <thead class="">
                                            <tr>
                                                <th>الاسم</th>
                                                <th>الصلاحيات</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($roles)
                                            @foreach($roles as $role)
                                            <tr>
                                                <td>{{$role -> name}}</td>

                                                <td>
                                                    @foreach($role -> permissions as $permission)
                                                    <span class="badge badge-primary">{{$permission}}</span> 
                                                    @endforeach

                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">

                                                        @if ($admin->role_id != $role->id)
                                                        <a href="{{route('admin.roles.edit',$role -> id)}}"
                                                            class="btn btn-info box-shadow-3 mr-1 mb-1"><i
                                                                class="ft-edit"></i></a>
                                                                
                                                        <a href="{{route('admin.roles.delete',$role -> id)}}"
                                                            class="delete btn btn-danger box-shadow-3 mr-1 mb-1"><i
                                                                class="ft-delete"></i></a>
                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endisset


                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">

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