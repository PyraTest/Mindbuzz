<?php $active_links = ['', '']; ?>
@extends('layouts.admin')
@section('content')


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            @if(Session::has('success'))
            <div class="col-md-12">
                <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                    <span class="text-white" style="font-weight: bold;">{{Session::get('success')}}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            @endif
        </div>
        <div class="content-body">

            @include('dashboard.includes.alerts.success')
            @include('dashboard.includes.alerts.errors')

            <!-- eCommerce statistic -->
            <div class="row">
                <!--<div class="col-xl-6 col-lg-6 col-6">-->
                <!--<input type="date" id="from_date" name="from" class="form-control" value="">-->
                <!--<h4>{{ __('admin.from') }}</h4>-->
                <!--</div>-->
                <!--<div class="col-xl-6 col-lg-6 col-6">-->
                <!--<input type="date" id="to_date" name="to" class="form-control" value="">-->
                <!--<h4>{{ __('admin.to') }}</h4>-->
                <!--</div>-->
                

                
                
                
                @can('create-unit')
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="info" id="reservations">Placeholder</h3>  
                                        <h3>{{ __('admin.ad_count') }}</h3>
                                    </div>
                                    <div>
                                        <i class="ft-list info font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%"
                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 @endcan
            </div>
            <!--/ eCommerce statistic -->
            <!-- Candlestick Multi Level Control Chart -->

            <!-- Sell Orders & Buy Order -->
            <!--<div class="row match-heighttt">-->
            <h2>Placeholder</h2>
            
 <table
                                        class="table table-striped w-100 text-center display wrap table-bordered ">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Placeholder</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>

                                           
                                                <tr>
                                                    <td class="text-info">Placeholder</td>
                                                    <td class="text-info">Placeholder</td>
                                                    
                                                    
                                                  
                                                   
                                                </tr>
                                           

                                        </tbody>
                                    </table>
                                    
                                    <h2>{{ __('admin.latest_numbers')  }}</h2>
                                    <table
                                        class="table table-striped w-100 text-center display nowrap table-bordered ">
                                        <thead>
                                        <tr>
                                             <th>#</th>
                                            <th>Placeholder</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>

                                            
                                                <tr>
                                                    <td class="text-info">1</td>
                                                    <td class="text-info">Placeholder</td>
                                                    
                                                    
                                                    <!--{{-- @if($salon->gender == '1')-->
                                                    <!--    <td class="text-info">@lang('admin.man')</td>-->
                                                    <!--@else-->
                                                    <!--    <td class="text-info">@lang('admin.woman')</td>-->
                                                    <!--@endif --}}-->
                                                    <!--{{--  <td class="text-info">{{$user->balance}}</td>  --}}-->
                                                </tr>
                                            

                                        </tbody>
                                    </table>
                                    <h2>{{ __('admin.latest_transaction')  }}</h2>
                                    <table
                                        class="table table-striped w-100 text-center display nowrap table-bordered ">
                                        <thead>
                                        <tr>
                                             <th>#</th>
                                            <th>{{ __('admin.user') }}</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>

                                            
                                                <tr>
                                                    <td class="text-info">1</td>
                                                    <td class="text-info">Placeholder</td>
                                                    
                                                    <!--{{-- @if($salon->gender == '1')-->
                                                    <!--    <td class="text-info">@lang('admin.man')</td>-->
                                                    <!--@else-->
                                                    <!--    <td class="text-info">@lang('admin.woman')</td>-->
                                                    <!--@endif --}}-->
                                                    <!--{{--  <td class="text-info">{{$user->balance}}</td>  --}}-->
                                                </tr>
                                           

                                        </tbody>
                                    </table>

               

            </div>
            <!--/ Sell Orders & Buy Order -->

        <!--</div>-->







        <!-- Line Chart
                <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title">Line Chart</h4>
                          <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                          <div class="heading-elements">
                            <ul class="list-inline mb-0">
                              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                              <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                              <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                              <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="card-body">
                            <p class="card-text">A line chart that is rendered within the browser using SVG or
                              VML. Displays tooltips when hovering over points.</p>
                            <div id="line-chart">
                                xmskclmskcm
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   /Line Chart -->





    </div>









</div>

@stop




@section('script')

<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyCK2d_HHyV8F-hKtqHGahmrZXIK1qQUcw0",
        authDomain: "taxicool-2bdfe.firebaseapp.com",
        databaseURL: "https://taxicool-2bdfe-default-rtdb.firebaseio.com",
        projectId: "taxicool-2bdfe",
        storageBucket: "taxicool-2bdfe.appspot.com",
        messagingSenderId: "166259098660",
        appId: "1:166259098660:web:374cdf0ed9cd9e8344c4b1",
        measurementId: "G-L1QRHWC5JM"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    /*function startFCM() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                $.ajax({
                    url: '#',
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token stored.');
                    },
                    error: function (error) {
                        alert(error);
                    },
                });
            }).catch(function (error) {
                alert(error);
            });
    }*/

    messaging.onMessage(function (payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });
</script>

@stop
