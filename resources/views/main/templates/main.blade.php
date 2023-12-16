<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('public/assets/img/favicon.png') }}">

    <link rel="stylesheet"
        href="{{ url('public/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/plugins/pace/flash.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/plugins/lobibox-master/dist/css/lobibox.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/plugins/Croppie/croppie.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/plugins/jquery-ui-1.13.2/jquery-ui.min.css') }}">


    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/assets/plugins/slick/slick/slick.css') }}" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/assets/plugins/slick/slick/slick-theme.css') }}" />

    <link rel="stylesheet" href="{{ url('public/assets/plugins/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/plugins/font-awesome/css/pro.min.css') }}" />
    <style>
        .bottom-logo img {
            width: 200px;
        }

        @media only screen and (max-width: 767px) {
            .header .brand-logo img {
                width: 94px !important;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ url('public/assets/loader/loader.css') }}">

    <link rel="stylesheet" href="{{ url('public/assets/css/style-main.css') }}">
</head>

<body class="@@dashboard">

    @include('loader')
    <div id="main-wrapper" class="front--">

        @include('main.elements.header')




        @yield('content')



        @include('main.elements.footer')

    </div>



    <script src="{{ url('public/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/assets/plugins/jquery.lazy/jquery.lazy.min.js') }}"></script>
    <script>
        $(function() {
            setInterval(() => {
                $('.lazy').Lazy();
            }, 1000);
        });
    </script>
    <script src="{{ url('public/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
    <script src="{{ url('public/assets/js/plugins/magnific-popup-init.js') }}"></script>
    <script src="{{ url('public/assets/js/scripts.js') }}"></script>
    <script src="{{ url('public/assets/plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>

    <script src="{{ url('public/assets/plugins/pace/pace.min.js') }}"></script>

    <script src="{{ url('public/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js') }}"></script>
    <script src="{{ url('public/assets/plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ url('public/assets/plugins/Croppie/croppie.js') }}"></script>
    <script src="{{ url('public/assets/plugins/Simple-jQuery-Mind-Map-Diagram-Plugin-mindmap/dist/mindmap.js') }}">
    </script>
    <script type="text/javascript" src="{{ url('public/assets/plugins/slick/slick/slick.min.js') }}"></script>


    <script src="{{ url('public/assets/plugins/lobibox-master/dist/js/lobibox.min.js') }}"></script>
    <script src="{{ url('public/assets/app/custom.js') }}"></script>
    <script src="{{ url('public/assets/app/webapi.js') }}"></script>
    <script src="{{ url('public/assets/app/inits.js') }}"></script>


    <script>
        $(function() {
            env.token = '{{ csrf_token() }}';


            var options = {
                root: "{{ route('web.public.index') }}",

            };
            app.init(options);
        })
    </script>

    @yield('scripts')
    @include('modals')



</body>

</html>
