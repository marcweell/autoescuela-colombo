
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conta | {{ config("app.name") }}</title>
    <link rel="stylesheet" href="{{ url('public/essential/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/essential/plugins/pace/flash.css') }}">
    <link rel="stylesheet" href="{{ url('public/essential/plugins/toast-master/css/jquery.toast.css') }}" />
    <link rel="stylesheet" href="{{ url('public/essential/plugins/jquery-ui-1.13.2/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/essential/loader/loader.css') }}">

    <style>

        .modal .dashboard-card,
        .modal .dashboard-card-body,
        .modal .card,
        .modal .card-body {
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: none !important;
        }
    </style>

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('public/dashboard/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body>
    @include('loader')
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">

        @yield('content')






    </section>
    <!-- Essential javascripts for application to work-->
    <script src="{{ url('public/dashboard/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ url('public/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('public/dashboard/js/main.js') }}"></script>



    <script src="{{ url('public/essential/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ url('public/essential/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js') }}"></script>
    <script src="{{ url('public/essential/plugins/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ url('public/essential/app/custom.js') }}"></script>
    <script src="{{ url('public/essential/app/webapi.js') }}"></script>
    <script src="{{ url('public/essential/app/inits.js') }}"></script>

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






    <link rel="stylesheet" href="{{ url('') }}" />










    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>

