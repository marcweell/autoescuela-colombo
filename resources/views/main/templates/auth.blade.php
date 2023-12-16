<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conta | {{ config('app.name') }}</title>
    <meta name="description" content="">


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('public/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">

    <link rel="stylesheet"
        href="{{ url('public/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/plugins/pace/flash.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/plugins/lobibox-master/dist/css/lobibox.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/plugins/Croppie/croppie.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/plugins/jquery-ui-1.13.2/jquery-ui.min.css') }}">

    <link rel="stylesheet"
        href="{{ url('public/assets/plugins/Simple-jQuery-Mind-Map-Diagram-Plugin-mindmap/dist/mindmap.css') }}" />

    <link rel="stylesheet" href="{{ url('public/assets/plugins/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/plugins/font-awesome/css/pro.min.css') }}" />
    <style>
        .node__text {
            color: black !important;
        }

        .modal .dashboard-card,
        .modal .dashboard-card-body,
        .modal .card,
        .modal .card-body {
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: none !important;
        }
    </style>

    <link rel="stylesheet" href="{{ url('public/assets/loader/loader.css') }}">
</head>

<body class="@@dashboard">

    @include('loader')
    <div class="authincation section-padding">
        <div class="container h-100">
            @yield('content')
        </div>
    </div>



    <script src="{{ url('public/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/assets/js/scripts.js') }}"></script>



    <script src="{{ url('public/assets/plugins/pace/pace.min.js') }}"></script>

    <script src="{{ url('public/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js') }}"></script>
    <script src="{{ url('public/assets/plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ url('public/assets/plugins/Croppie/croppie.js') }}"></script>

    <script src="{{ url('public/assets/plugins/Simple-jQuery-Mind-Map-Diagram-Plugin-mindmap/dist/mindmap.js') }}">
    </script>
    <script src="{{ url('public/assets/plugins/lobibox-master/dist/js/lobibox.min.js') }}"></script>
    <script src="{{ url('public/assets/app/custom.js') }}"></script>
    <script src="{{ url('public/assets/app/webapi.js') }}"></script>
    <script src="{{ url('public/assets/app/inits.js') }}"></script>

    <script>
        $(function() {
            env.token = '{{ csrf_token() }}';

            app.listenner.add("pw", function() {

                const togglePassword = document.querySelector('#togglePassword');
                const password = document.querySelector('#pwd');

                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type');
                    switch (type) {
                        case 'password':
                            password.setAttribute('type', "text");
                            break;
                        default:
                            password.setAttribute('type', "password");
                            break;
                    }
                });



            });

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
