<?php
$active_links = ['main_slider' , 'addmain_slider'];
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
                            <li class="breadcrumb-item"><a href="{{route('admin.cities')}}">
                                    {{__('admin/sidebar.cities')}} </a>
                            </li>
                            <li class="breadcrumb-item active"> {{__('admin/sidebar.add_main_slider')}}
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
                                    <form class="form" action="{{route('admin.main_slider.store')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">


                                            <h4 class="form-section"><i class="ft-home"></i> بيانات السلايدر </h4>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image"> {{ __('admin/forms.image') }} </label><span class="text-danger"> *</span>
                                                    <input type="file" id="image" class="form-control" name="image">
                                                    @error("image")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> {{ __('admin/forms.type') }}</label>
                                                    <select data-dependent="type_id" id="type" name="type" class="select2 form-control dynamic">
                                                        <option disabled selected >من فضلك أختر قيمه</option>
                                                            <option value="product">منتج</option>
                                                            <option value="category">قسم</option>
                                                    </select>
                                                    @error('type')
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> {{ __('admin/forms.type_id') }} <i id="loader" class="la la-spinner spinner text-info font-large-1" style="visibility: hidden;"></i></label>
                                                    <select id="type_id" name="type_id" class="select2 form-control">
                                                        <option disabled selected >من فضلك أختر قيمه</option>
                                                    </select>
                                                    @error('type_id')
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="link"> {{ __('admin/forms.link') }} </label>
                                                    <input type="text" id="link" class="form-control"
                                                        name="link" value="{{ old('link') }}">
                                                    @error("link")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
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

<script>
    $(document).ready(function(){
    
     $('.dynamic').change(function(){
      if($(this).val() != '')
      {
        $('#loader').css('visibility' , 'visible')
        console.log($('#loader'))
       var select = $(this).attr("id");
       var value = $(this).val();
       var dependent = $(this).data('dependent');
       var _token = "{{ csrf_token() }}";
       $.ajax({
        url:"{{ route('dynamicdependent.fetch') }}",
        method:"POST",
        data:{select:select, value:value, _token:_token, dependent:dependent},
        success:function(result)
        {
         $('#'+dependent).html(result);
         $('#loader').css('visibility' , 'hidden')
        }
    
       })
      }

     });
    
    
     $('#type').change(function(){
      $('#type_id').val('');
     });
     
    
    });
    </script>

@stop