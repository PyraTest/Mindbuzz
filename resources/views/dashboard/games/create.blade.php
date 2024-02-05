<?php
$active_links = ['sub_services', 'addsub_services'];
?>

@extends('layouts.admin')
@section('style')
    <link type="text/css" rel="stylesheet" href="http://example.com/image-uploader.min.css">

@stop
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            {{-- <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">{{__('admin/sidebar.main')}} </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.sub_services')}}">
                                    {{__('admin.sub_services')}} </a>
                            </li>
                            <li class="breadcrumb-item active"> {{__('admin.add_sub_services')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div> --}}
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
                                        <form class="form" action="{{ route('admin.store_game') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">


                                                <h4 class="form-section"><i class="ft-home"></i> بيانات اللعبة </h4>

                                                <div class="row">



                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.lessons') }}</label>
                                                            <select name="lesson_id" class="form-control" id="">
                                                                @foreach ($lessons as $lesson)
                                                                    <option value="{{ $lesson->id }}">{{ $lesson->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('lesson_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.game_type_id') }}</label>
                                                            <select name="game_type_id" class="form-control" id="gameType"
                                                                onchange="displayLetters()">
                                                                <option value="" disabled selected>Select game type
                                                                </option>
                                                                @foreach ($types as $type)
                                                                    <option value="{{ $type->id }}">{{ $type->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('game_type_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror


                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.letters_num') }}</label>
                                                            <input type="text" name="num_of_letters" id="num_of_letters"
                                                                class="form-control" required>
                                                            <label>{{ __('admin.num_of_letters_repeat') }}</label>
                                                            <input type="number" min="1" max="9" name="num_of_letter_repeat"
                                                                id="num_of_letters_repeat" class="form-control" required>
                                                            @error('num_of_letters')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 hidden" id="letters">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.letters') }}</label>
                                                            <div class="border p-2 mb-3">
                                                                <label>Letter one</label>
                                                            <input type="text" name="letter[]" id="letterOne"
                                                                class="form-control mb-2" placeholder="First Letter">
                                                            <div class="row  imageWord" >
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>
                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word" class="form-control mb-2">
                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>

                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word" class="form-control mb-2">

                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>

                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word" class="form-control mb-2">

                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>

                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word" class="form-control mb-2">

                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="border p-2 mb-3">
                                                                <label>Letter two</label>

                                                            <input type="text" name="letter[]" id="letterTwo"
                                                                class="form-control mb-2" placeholder="Second Letter">
                                                            <div class="row  imageWord" >
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>
                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>

                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word"
                                                                        class="form-control mb-2">

                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>

                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word"
                                                                        class="form-control mb-2">

                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>

                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word"
                                                                        class="form-control mb-2">

                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="border p-2 mb-3">
                                                                <label>Letter three</label>
                                                            <input type="text" name="letter[]" id="letterThree"
                                                                class="form-control mb-2" placeholder="Third Letter">
                                                            <div class="row  imageWord" >
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>
                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>

                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word"
                                                                        class="form-control mb-2">

                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>

                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word"
                                                                        class="form-control mb-2">

                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="file" class="form-control mb-2"
                                                                        name="image[]">
                                                                    <label>{{ __('admin.word') }}</label>

                                                                    <input type="text" name="word[]"
                                                                        placeholder="Enter Word"
                                                                        class="form-control mb-2">

                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="border p-2 ">
                                                                <label>Letter four</label>

                                                                <input type="text" name="letter[]" id="letterFour"
                                                                    class="form-control mb-2" placeholder="Fourth Letter">
                                                                <div class="row  imageWord" >
                                                                    <div class="col-3">
                                                                        <input type="file" class="form-control mb-2"
                                                                            name="image[]">
                                                                        <label>{{ __('admin.word') }}</label>
                                                                        <input type="text" name="word[]"
                                                                            placeholder="Enter Word"
                                                                            class="form-control mb-2">
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <input type="file" class="form-control mb-2"
                                                                            name="image[]">
                                                                        <label>{{ __('admin.word') }}</label>

                                                                        <input type="text" name="word[]"
                                                                            placeholder="Enter Word"
                                                                            class="form-control mb-2">

                                                                    </div>
                                                                    <div class="col-3">
                                                                        <input type="file" class="form-control mb-2"
                                                                            name="image[]">
                                                                        <label>{{ __('admin.word') }}</label>

                                                                        <input type="text" name="word[]"
                                                                            placeholder="Enter Word"
                                                                            class="form-control mb-2">

                                                                    </div>
                                                                    <div class="col-3">
                                                                        <input type="file" class="form-control mb-2"
                                                                            name="image[]">
                                                                        <label>{{ __('admin.word') }}</label>

                                                                        <input type="text" name="word[]"
                                                                            placeholder="Enter Word"
                                                                            class="form-control mb-2">

                                                                    </div>
                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>
                                                </div>


                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> اضافة
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
        function displayLetters() {
            $("#letters").removeClass("hidden");
        }
        // function displayLetters() {
        //     $(".imageWord").removeClass("hidden");
        // }
    </script>
@stop
