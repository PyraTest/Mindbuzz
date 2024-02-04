<?php
$active_links = ['drivers' , ''];
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
                            <li class="breadcrumb-item"><a href="{{route('admin.drivers.index')}}">
                                    {{__('admin.drivers')}} </a>
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
                                    {{--  <div class="container mt-5">  --}}
                                        <h2>@lang('admin.map_driver')  ({{ $CountDrivers }})</h2>
                                        <div id="map" style = "height:450px;"></div>
                                    {{--  </div>  --}}

                                    <script type="text/javascript">
                                        function initMap() {
                                            const myLatLng = { lat: 30.033333, lng: 31.233334 };
                                            const map = new google.maps.Map(document.getElementById("map"), {
                                                zoom: 5,
                                                center: myLatLng,
                                            });

                                            var locations = {{ Js::from($array) }};

                                            var infowindow = new google.maps.InfoWindow();

                                            var marker, i;

                                            for (i = 0; i < locations.length; i++) {
                                                var icon = locations[i][3] || {};

                                                  marker = new google.maps.Marker({
                                                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                                    map: map,
                                                    title: locations[i][0],
                                                    icon: icon.icon,
                                                    shadow: icon.shadow,
                                                    //visible: true,
                                                    //zIndex: i,
                                                    //icon:locations[i][3],
                                                    //animation:google.maps.Animation.Drop,
                                                    //draggable: true

                                                  });

                                                  google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                                    return function() {
                                                      infowindow.setContent(locations[i][0]);
                                                      infowindow.open(map, marker);
                                                    }
                                                  })(marker, i));

                                            }
                                        }

                                        window.initMap = initMap;
                                    </script>

                                    <script type="text/javascript"
                                        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script>


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
