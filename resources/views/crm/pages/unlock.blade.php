<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('public/assets/images/favicon.ico') }} ">

    <!-- App css -->
    <link href="{{ url('public/assets/css/icons.min.css') }} " rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets/css/app.min.css') }} " rel="stylesheet" type="text/css" id="app-style" />
     <!DOCTYPE html>

</head>

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand text-center text-lg-start">
                        <a href="index.html" class="logo-dark">
                            <span><img src="{{ url('public/assets/images/logo-dark.png') }} " alt=""
                                    height="18"></span>
                        </a>
                        <a href="index.html" class="logo-light">
                            <span><img src="{{ url('public/assets/images/logo.png') }} " alt=""
                                    height="18"></span>
                        </a>
                    </div>

                    <!-- title-->
                    <div class="text-center w-75 m-auto">
                        <img src="{{ Flores\Tools::photo(md5($user->photo) . '.png') }}" height="200"
                            alt="user-image" class="rounded-circle shadow">
                        <h4 class="text-dark-50 text-center mt-3 fw-bold">Ola!,
                            {{ implode([$user->name, ' ', $user->last_name]) }} </h4>
                        <p class="text-muted mb-4">Enter your password to access the admin.</p>
                    </div>
                    <!-- form -->
                    <form action="{{ route('web.account.auth.login') }}" method="post" class="form_ parent-load">
                        <input class="form-control" type="hidden" name="user" required=""
                            value="{{ $user->code }}">
                        <div class="mb-3">
                            <a href="pages-recoverpw-2.html" class="text-muted float-end"><small>Forgot your
                                    password?</small></a>
                            <label for="password" class="form-label">{{ __('Senha') }}</label>
                            <input class="form-control" type="password" name="password" required="" id="password"
                                placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">Lembrar Sessao</label>
                            </div>
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary chl_loader" type="submit"><i class="mdi mdi-login"></i>
                                Autenticar
                            </button>
                        </div>
                        <!-- social-->
                        <div class="text-center mt-4">
                            <p class="text-muted font-16"><a
                                    href="{{ route('web.account.auth.index', ['not_me']) }}">Tentar outra conta</a></p>

                        </div>
                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Don't have an account? <a href="pages-register-2.html"
                                class="text-muted ms-1"><b>Sign Up</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">I love the color!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> It's a elegent templete. I love it very
                    much! . <i class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    - Hyper Admin User
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- bundle -->
    <script src="{{ url('public/assets/js/vendor.min.js') }} "></script>
    <script src="{{ url('public/assets/js/app.min.js') }} "></script>
    <script src="{{ url('public/assets/app/custom.js') }}"></script>
    <script src="{{ url('public/assets/app/webapi.js') }}"></script>
    <script src="{{ url('public/assets/app/inits.js') }}"></script>
    <script>
        $(function() {
            env.token = '{{csrf_token() }}';
            app.init();
        })
    </script>

</body>

</html>
