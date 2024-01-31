<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Steera.">
    <meta name="keywords" content="Wassal">
    <meta charset="utf-8">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="">
    {{--  <link rel="apple-touch-icon" href="{{getSettings('logo')->image_path}}">  --}}
    <link rel="shortcut icon" type="image/x-icon" href="">
    {{--  <link rel="shortcut icon" type="image/x-icon" href="{{getSettings('logo')->image_path}}">  --}}
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin//plugins/animate/animate.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/' . getFolder() . '/vendors.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/vendors/css/weather-icons/climacons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/fonts/meteocons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/charts/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/charts/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/vendors/css/charts/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/vendors/css/forms/toggle/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/vendors/css/forms/toggle/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/' . getFolder() . '/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/' . getFolder() . '/pages/chat-application.css') }}">

    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/' . getFolder() . '/app.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/' . getFolder() . '/custom-rtl.css') }}"> --}}
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/' . getFolder() . '/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/' . getFolder() . '/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/fonts/simple-line-icons/style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/' . getFolder() . '/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/' . getFolder() . '/pages/timeline.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/cryptocoins/cryptocoins.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/vendors/css/extensions/datedropper.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/vendors/css/extensions/timedropper.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/vendors/css/file-uploaders/dropzone.min.css') }}">

    {{-- Image uploader --}}
    <link type="text/css" rel="stylesheet" href="http://example.com/image-uploader.min.css">
    {{-- Image uploader --}}


    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/css-rtl/plugins/file-uploaders/dropzone.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- END Page Level CSS-->


    {{-- noty --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/noty/noty.css') }}">
    <script src="{{ asset('assets/plugins/noty/noty.min.js') }}"></script>


    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/style.css') }}">
    <!-- END Custom CSS-->


    @yield('style')
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body class="vertical-layout vertical-menu 2-columns  menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu" data-col="2-columns">

    <!-- fixed-top-->
    @include('dashboard.includes.header')
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('dashboard.includes.sidebar')

    @yield('content')
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('dashboard.includes.footer')


    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('assets/admin/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('assets/admin/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/admin/vendors/js/tables/datatable/dataTables.buttons.min.js') }}" type="text/javascript">
    </script>

    <script src="{{ asset('assets/admin/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/admin/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/admin/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/scripts/forms/switch.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('assets/admin/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/vendors/js/charts/echarts/echarts.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/admin/vendors/js/extensions/datedropper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/vendors/js/extensions/timedropper.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/admin/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/scripts/pages/chat-application.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{ asset('assets/admin/js/scripts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    {{-- <script src="{{ asset('assets/admin/js/scripts/pages/dashboard-crypto.js') }}" type="text/javascript"></script> --}}


    {{-- <script src="{{ asset('assets/admin/js/scripts/tables/datatables/datatable-basic.js') }}" type="text/javascript"> --}}
    {{-- </script> --}}
    {{-- <script src="{{ asset('assets/admin/js/scripts/extensions/date-time-dropper.js') }}" type="text/javascript"></script> --}}
    <!-- END PAGE LEVEL JS-->

    <script src="{{ asset('assets/admin/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/admin/js/scripts/modal/components-modal.js') }}" type="text/javascript"></script>



    {{--
    <script src="{{asset('assets/admin/js/scripts/charts/google/line/line.js')}}"></script>
    <script src="{{asset('assets/admin/js/scripts/charts/google/line/line-interval.js')}}"></script>
    <script src="{{asset('assets/admin/js/scripts/charts/google/line/area.js')}}"></script>
    <script src="{{asset('assets/admin/js/scripts/charts/google/line/area-interval.js')}}"></script>
    <script src="{{asset('assets/admin/js/scripts/charts/google/line/area-stacked.js')}}"></script>
    <script src="{{asset('assets/admin/js/scripts/charts/google/line/area-stepped.js')}}"></script>
    <script src="{{asset('assets/admin/js/scripts/charts/google/line/area-stacked-stepped.js')}}"></script>
    --}}


    <script src="{{ asset('assets/admin/vendors/js/extensions/dropzone.min.js') }}" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    {{-- Image uploader --}}

    <script type="text/javascript" src="http://example.com/jquery.min.js"></script>
    <script type="text/javascript" src="http://example.com/image-uploader.min.js"></script>

    {{-- Image uploader --}}

    <script>
        $(document).ready(function() {
            $('#addQuestionBankBtn').click(function() {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('create-question-bank') }}",
                    dataType: 'json',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('New question bank created with ID: ' + response.id);
                        if (response.success) {
                            $('#successMessage').html(response.success).show();
                        }
                        updateSelectOptions();
                    },
                    error: function(error) {
                        console.log('Error creating question bank: ' + error.responseJSON
                            .message);
                    }
                });
            });

            function updateSelectOptions() {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('get-question-banks') }}",
                    dataType: 'json',
                    success: function(questionBanks) {
                        $('#bankSelect').empty();

                        $.each(questionBanks, function(index, questionBank) {
                            $('#bankSelect').append($('<option>', {
                                value: questionBank.id,
                                text: questionBank.id
                            }));
                        });
                    },
                    error: function(error) {
                        console.log('Error fetching question banks: ' + error.responseJSON.message);
                    }
                });
            }
            $('#letter_images').imageUploader({
                // preloaded: photos,
                // imagesInputName: 'photos',
                label: 'Drag & Drop images here or click to browse'
            });
        });
    </script>

    <script>
        $('.delete').click(function(e) {
            e.preventDefault();
            var that = $(this);

            var n = new Noty({
                text: "تأكيد الحذف",
                layout: "{{ app()->getLocale() === 'ar' ? 'topLeft' : 'topRight' }}",
                type: "warning",
                timeout: 4000,
                killer: true,
                buttons: [
                    Noty.button("نعم", 'btn btn-success mr-2', function() {
                        var url = that.attr('href');
                        var id = that.data('id');

                        // Send AJAX request to delete the unit
                        $.ajax({
                            url: url,
                            type: 'DELETE', // Specify the request method as DELETE
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(data) {
                                // Handle success, e.g., show a success message
                                console.log(data.success);

                                // Reload the page after deletion
                                location.reload();
                            },
                            error: function(error) {
                                // Handle error, e.g., show an error message
                                console.error(error.responseText);
                            }
                        });
                    }),

                    Noty.button("لا", 'btn btn-primary mr-2', function() {
                        n.close();
                    })
                ]
            });

            n.show();
        });

        //delete using noty
        // $('.delete').click(function(e) {

        //     // console.log($(this).attr('href'));
        //     var that = $(this)

        //     e.preventDefault();

        //     var n = new Noty({
        //         text: "تأكيد الحذف",
        //         layout: "{{ app()->getLocale() === 'ar' ? 'topLeft' : 'topRight' }}",
        //         type: "warning",
        //         timeout: 4000,
        //         killer: true,
        //         buttons: [
        //             Noty.button("نعم", 'btn btn-success mr-2', function() {
        //                 // console.log(that);
        //                 // // that.closest('form').submit();
        //                 // // console.log(that.closest('form'));
        //                 window.location.href = that.attr('href');
        //                 var url = that.attr('href');
        //                 var id = that.data('id');

        //                 // Send AJAX request to delete the unit
        //                 $.ajax({
        //                     url: url,
        //                     type: 'DELETE',
        //                     data: {
        //                         id: id,
        //                         _token: '{{ csrf_token() }}',
        //                     },
        //                     success: function(data) {
        //                         // Handle success, e.g., show a success message
        //                         console.log(data.success);

        //                         // Reload the page after deletion
        //                         location.reload();
        //                     },
        //                     error: function(error) {
        //                         // Handle error, e.g., show an error message
        //                         console.error(error.responseText);
        //                     }
        //                 });
        //             }),

        //             Noty.button("لا", 'btn btn-primary mr-2', function() {
        //                 n.close();
        //             })
        //         ]
        //     });

        //     n.show();

        // }); //end of delete using noty
    </script>

    @include('partials._session')




    {{-- <script>
        $('#meridians1').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians2').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians3').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians4').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians5').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians6').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians7').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians8').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians9').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians10').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians11').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians12').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians13').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
        $('#meridians14').timeDropper({
            meridians: true,
            setCurrentTime: false
        });
    </script> --}}

    <script>
        // Preparing AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); // End of Preparing AJAX
    </script>

    @yield('script')

    {{-- <script>
        $(document).ready(function() {
            $('#example').dataTable({
                /* Disable initial sort */
                "order": []
            });
        })
    </script> --}}


</body>

</html>
