
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conta | {{ config("app.name") }}</title>
    <link rel="stylesheet" href="{{ url('public/essential/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/essential/plugins/pace/flash.css') }}">
    <link rel="stylesheet" href="{{ url('public/essential/plugins/lobibox-master/dist/css/lobibox.min.css') }}" />
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
      <div class="logo">
        <h1>Vali</h1>
      </div>
      <div class="login-box">
        <form class="login-form form_" action="{{ route('web.account.auth.login') }}">
          <h3 class="login-head"><i class="bi bi-person me-2"></i>SIGN IN</h3>
          <div class="mb-3">
            <label class="form-label">USERNAME</label>
            <input class="form-control" name="user" type="text" placeholder="Email" autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label">PASSWORD</label>
            <input class="form-control" type="password" name="password" placeholder="Password">
          </div>
          <div class="mb-3">
            <div class="utility">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox"><span class="label-text">Stay Signed in</span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-bs-toggle="flip">Forgot Password ?</a></p>
            </div>
          </div>
          <div class="mb-3 btn-container d-grid">
            <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-box-arrow-in-right me-2 fs-5"></i>SIGN IN</button>
          </div>
        </form>
        <form class="forget-form" action="index.html">
          <h3 class="login-head"><i class="bi bi-person-lock me-2"></i>Forgot Password ?</h3>
          <div class="mb-3">
            <label class="form-label">EMAIL</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="mb-3 btn-container d-grid">
            <button class="btn btn-primary btn-block"><i class="bi bi-unlock me-2 fs-5"></i>RESET</button>
          </div>
          <div class="mb-3 mt-3">
            <p class="semibold-text mb-0"><a href="#" data-bs-toggle="flip"><i class="bi bi-chevron-left me-1"></i> Back to Login</a></p>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="{{ url('public/dashboard/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ url('public/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('public/dashboard/js/main.js') }}"></script>



    <script src="{{ url('public/essential/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ url('public/essential/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js') }}"></script>
    <script src="{{ url('public/essential/plugins/lobibox-master/dist/js/lobibox.min.js') }}"></script>
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
















    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-bs-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>

