<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ str_replace('-', ' ', config('app.name')) . ' | ' . $title }}</title>

        <!-- short cut cions -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
        <link rel="favicon" href="{{asset('frontend')}}/img/favicon.png">
        <link rel="shortcut icon" href="{{asset('frontend')}}/img/favicon.png">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('frontend')}}/img/favicon.png">
        <!-- short cut cions -->
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

        <!-- CSS Files -->
        <link href="{{ asset('css') }}/app.css" rel="stylesheet" />
        <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />

        @stack('styles')

        <!-- Custom CSS Files -->
        <link href="{{ asset('css') }}/custom.css" rel="stylesheet" />


    </head>
    <body class="{{ $class ?? '' }}">

        @auth('admin')
            @include('backend.layouts.page_templates.auth')
        @endauth


        @guest('admin')
            @include('backend.layouts.page_templates.guest')
        @endguest

        <!--   Core JS Files   -->
        <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
        <script src="{{asset('js/app.js')}}"></script>
        <!--  Notifications Plugin    -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

        @stack('scripts')

        {{-- <script src="{{ asset('material') }}/js/material-dashboard.js"></script> --}}

        <script>
            $(document).ready(function() {
                // SideNav Button Initialization
                $(".button-collapse").on('click', function(){
                    $(".sidebar").toggleClass('hide');
                    $(".navbar, .footer").toggleClass('align-parent');
                    $(".main-panel").toggleClass('full-width');
                });

                // Footer year
                $('.copyright').append(new Date().getFullYear())

                // Laravel ajax-token integration
                var _token = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
            });
        </script>


    </body>
</html>
