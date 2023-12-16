<!DOCTYPE html>
<html lang="{!! str_replace('_', '-', app()->getLocale()) !!}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{!! config('app.name') !!}</title>
    <meta name="description" content="">

    <link rel="stylesheet" href="public/assets/plugins/bootstrap-5.3.1/css/bootstrap.min.css">

    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/assets/plugins/slick/slick/slick.css') }}" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/assets/plugins/slick/slick/slick-theme.css') }}" />
 
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('public/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{!! url('public/assets/css/style.css') !!}">
    <style>
        a.full-logo img {
            width: 100%;
        }

        @media only screen and (min-width: 767px) {
            .sidebar-compressed .sidebar {
                width: 120px !important;
                transition-duration: 0.2s;

            }

            .sidebar-compressed .menu ul li a .nav-text {
                display: none !important;
                transition-duration: 0.2s;

            }

            .sidebar-compressed .header {
                left: 120px;
                width: calc(100% - 150px);
                transition-duration: 0.2s;

            }

            .sidebar-compressed .menu ul li i {
                text-align: center;
                font-size: 45px;
                margin-right: 15px;
                margin-bottom: 8px !important;
                transition-duration: 0.2s;

            }

            .sidebar-compressed .admin .content-body {
                margin-left: 145px;
                transition-duration: 0.2s;

            }
        }

        .sidebar-compressed .pfl span,
        .sidebar-compressed .pfl h6,
        .sidebar-compressed .pfl p {
            display: none !important;
            transition-duration: 0.2s;

        }

        .bw {
            -webkit-filter: grayscale(100%) !important;
            filter: grayscale(100%) !important;
        }
    </style>

    <link rel="stylesheet" href="{!! url('public/assets/plugins/pace/flash.css') !!}">
    <link rel="stylesheet" href="{!! url('public/assets/plugins/lobibox-master/dist/css/lobibox.min.css') !!}" />
    <link rel="stylesheet" href="{!! url('public/assets/plugins/DataTables/datatables.min.css') !!}">
    <link rel="stylesheet" href="{!! url('public/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css') !!}" />
    <link rel="stylesheet" href="{!! url('public/assets/plugins/font-awesome/css/all.min.css') !!}" />
    <link rel="stylesheet" href="{!! url('public/assets/plugins/font-awesome/css/pro.min.css') !!}" />
    <link rel="stylesheet" href="{!! url('public/assets/plugins/color-picker-huebee/huebee.css') !!}">
    <link rel="stylesheet" href="{!! url('public/assets/loader/loader.css') !!}">
    <link rel="stylesheet" href="{!! url('public/assets/plugins/summernote-0.8.18/summernote-bs4.css') !!}" />
    <style>
        .menu ul li .active {
            background-color: var(--bs-primary);
            border-radius: 10px;
        }

        .menu ul li a span {
            color: var(--bs-primary);
        }

        .menu ul li .active span,
        .menu ul li .active .fa,
        .menu ul li .active .far,
        .menu ul li .active i {
            color: #fff !important;
        }

        .avatar-xs {
            width: 50px;
        }

        .modal .dashboard-card,
        .modal .dashboard-card-body,
        .modal .card,
        .modal .card-body {
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: none !important;
        }

        .nav-text {
            text-transform: uppercase;
        }
    </style>
    <link rel="stylesheet" href="{!! url('public/assets/loader/loader.css') !!}">
</head>

<body class="@@dashboard">

    @include('loader')

    <div id="main-wrapper" class="admin">

        <div class="header shadow">
            <div class="mx-5">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="header-content">
                            <div class="header-left">
                                <!--div class="brand-logo d-block m-0">
                                    <a class="mini-logo" href="{{ url('/') }}"><img src="{!! url('public/assets/images/logoi.png') !!}" alt="" width="40"></a>
                                </div-->
                            </div>
                            <div class="header-right">
                                <!-- <div class="theme-switch"><i class="ri-sun-line"></i></div> -->



                                <div class="dropdown profile_log dropdown">
                                    <button data-bs-toggle="dropdown" class="btn btn-sm btn-default text-dark mx-1 "
                                        href="#">
                                        <!--i class="fa fa-language px-1"></i--><span
                                            class="text-uppercase">{{ $user->language }}</span></button>
                                    <div tabindex="-1" class="dropdown-menu dropdown-menu-end">

                                        @foreach ($language as $item)
                                            <a class="dropdown-item logout l14k" data-id="-1"
                                                data-href="{!! route('web.app.profile.update.locale.do') !!}"
                                                data-payloads="{{ json_encode(['locale' => $item->code]) }}">
                                                {!! $item->name !!}
                                            </a>
                                        @endforeach


                                    </div>
                                </div>

                                <div class="dark-light-toggle theme-switch" onclick="themeToggle()">
                                    <span class="dark"><i class="ri-moon-line"></i></span>
                                    <span class="light"><i class="ri-sun-line"></i></span>
                                </div>


                                <div class="nav-item dropdown notification dropdown">
                                    <div data-bs-toggle="dropdown">
                                        <div class="notify-bell icon-menu">
                                            <span>
                                                <i class="ri-notification-2-line"></i>
                                            </span>
                                            <span class="badge bg-danger p-0 badge-danger"
                                                style="position: absolute; top: 0px; left: 11px; padding: 3px!important;">{!! count($notification ?? []) !!}</span>
                                        </div>
                                    </div>
                                    <div tabindex="-1"
                                        class="dropdown-menu notification-list dropdown-menu dropdown-menu-end">
                                        <h4 class="text-capitalize">{!! __('notificacoes') !!}</h4>
                                        <div class="lists" style="overflow: auto;max-height: 60vh;padding: 10px; ">
                                            
                                        @foreach ($notification as $item)
                                        <div class="d-flex align-items-center"><span
                                                class="me-3 icon pending"><i
                                                    class="ri-question-mark"></i></span>
                                            <div>
                                                <h6>{!! tools()->date_convert($item->created_at) !!}
                                                    <button
                                                        data-href="{{ route('web.app.notification.remove.do') }}"
                                                        data-id='{{ $item->id }}' data-title="Remover"
                                                        class=" l14k prompt float-end btn btn-sm btn-outline-primary"><i
                                                            class="fa fa-times"></i></button>
                                                </h6>
                                                <p>{!! $item->message !!}</p>
                                                <hr>
                                            </div>
                                        </div>
                                    @endforeach


                                        </div>
                                        <div class="lists">
                                            <a class="l14k text-capitalize"
                                                data-href="{!! route('web.app.notification.index') !!}">{!! __('mais') !!}<i
                                                    class="ri-arrow-right-s-line"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown profile_log dropdown">
                                    <div data-bs-toggle="dropdown">
                                        <div class="user icon-menu active">
                                            <span>
                                                <img src="{!! tools()->photo($user->profile_picture) !!}" alt="">
                                            </span>
                                            <span
                                                class="d-none d-md-block">{{ implode(' ', [$user->name, $user->last_name]) }}</span>
                                        </div>
                                    </div>
                                    <div tabindex="-1" class="dropdown-menu dropdown-menu-end">
                                        <div class="user-email">
                                            <div class="user">
                                                <span class="thumb">
                                                    <img src="{!! tools()->photo($user->profile_picture) !!}" alt="">
                                                </span>
                                                <div class="user-info">
                                                    <h5>{!! implode(' ', [$user->name, $user->last_name]) !!}</h5>
                                                    <span>{!! $user->code !!}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="dropdown-item l14k" data-href="{!! route('web.app.profile.update.index') !!}">
                                            <span><i class="ri-user-line"></i></span>{{ __('Perfil') }}
                                        </a>
                                        <a class="dropdown-item logout l14k" data-href="{!! route('web.account.auth.logout') !!}">
                                            <i class="ri-logout-circle-line"></i>{{ __('Terminar Sessao') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar shadow">
            <!--div class="brand-logo"><a class="full-logo" href="{!! route('web.public.index') !!}"><img
                        src="{!! url('public/assets/images/logo.png') !!}" alt=""></a></div-->
            <div class="text-right pt-4 px-2 w-100 d-none d-sm-block">
                <button class="btn text-dark float-end sb-switch"><i class="fa fa-arrow-left"></i></button>
            </div>
            <div class="mt-5 mb-0 text-center d-none d-md-block pfl">
                <img style="max-width: 60px;width: 100%;" src="{!! tools()->photo($user->profile_picture) !!}" class="rounded-circle">
                <h6 class="pt-1 mt-3 mb-0">Olá, {!! implode(' ', [$user->name, $user->last_name]) !!}</h6>
                <span class="pt-1 d-block">{{ $user->code }}</span>
                <span class="d-block">Seja bem-vindo novamente!</span>
            </div>
            <div class="menu mt-md-2" style="max-height: 80vh; overflow-y: auto;">
                <ul>
                    <li>
                        <a class="l14k" data-href="{!! route('web.app.index') !!}"
                            data-payloads="{{ json_encode(['summary' => true]) }}">
                            <span><i class="ri ri-layout-grid-fill"></i></span>
                            <span class="nav-text">{!! __('Meu Painel') !!}</span>
                        </a>
                    </li>

                    <li>
                        <a class="l14k" data-href="{!! route('web.app.mandala.index') !!}">
                            <span><i class="fa fa-chart-line"></i></span>
                            <span class="nav-text">{!! __('Minhas Fases') !!}</span>
                        </a>
                    </li>

                    <li>
                        <a class="l14k" data-href="{!! route('web.app.plan.index') !!}">
                            <span><i class="fa fa-street-view"></i></span>
                            <span class="nav-text">{!! __('Fases') !!}</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="l14k" data-href="{!! route('web.app.transaction.index') !!}">
                            <span><i class="far fa-sack-dollar"></i></span>
                            <span class="nav-text">{!! __('Transacoes') !!}</span></a>
                    </li>

                    <li class="">
                        <a class="l14k" data-href="{!! route('web.app.folder.index') !!}">
                            <span><i class="far fa-folder-download"></i></span>
                            <span class="nav-text">{!! __('Material de apoio') !!}</span></a>
                    </li>

                    <li class="">
                        <a class="l14k" data-href="{!! route('web.app.testimony.index') !!}">
                            <span><i class="fa fa-comments"></i></span>
                            <span class="nav-text">{!! __('Depoimentos') !!}</span></a>
                    </li>

                    <li class=""><a href="#" class="l14k" data-href="{!! route('web.account.auth.logout') !!}">
                            <span><i class="fa fa-sign-out text-warning"></i></span>
                            <span class="nav-text text-warning">{{ __('Terminar Sessao') }}</span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>


        <div class="content-body">
            <div class="container-- mx-5" id="page-content">



            </div>
        </div>



    </div>



    <script src="{!! url('public/assets/vendor/jquery/jquery.min.js') !!}"></script>
    <script src="{!! url('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{{ url('public/assets/plugins/jquery.lazy/jquery.lazy.min.js') }}"></script>

    <script>
        $(function() {
            setInterval(() => {
                $('.lazy').Lazy();
            }, 1000);
        });
    </script>
    
    <script src="{!! url('public/assets/js/scripts.js') !!}"></script>

    <script type="text/javascript" src="{{ url('public/assets/plugins/slick/slick/slick.min.js') }}"></script>


    <script src="{!! url('public/assets/plugins/pace/pace.min.js') !!}"></script>
    <script src="{!! url('public/assets/plugins/DataTables/datatables.min.js') !!}"></script>
    <script src="{!! url('public/assets/plugins/summernote-0.8.18/summernote.js') !!}"></script>

    <script src="{!! url('public/assets/plugins/Croppie/croppie.js') !!}"></script>
    <link rel="stylesheet" href="{!! url('public/assets/plugins/Croppie/croppie.css') !!}" />
    
    <script src="{!! url('public/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js') !!}"></script>
    <script src="{!! url('public/assets/plugins/lobibox-master/dist/js/lobibox.min.js') !!}"></script>
    <script src="{!! url('public/assets/app/custom.js') !!}"></script>
    <script src="{!! url('public/assets/app/webapi.js') !!}"></script>
    <script src="{!! url('public/assets/app/inits.js') !!}"></script>
    <script>
        $(function() {
            env.token = '{!! csrf_token() !!}';
            var options = {
                root: "{!! route('web.public.index') !!}",
                init: [{
                    url: location.href
                }]
            };
            app.init(options);

            setTimeout(function() {
                setInterval(function() {
                    app.listenner.listen("clickEvents");
                    app.listenner.listen("copyEvents");
                }, 200);
            }, 500);
            

            $(".sb-switch").click(function() {
                if ($("body").hasClass("sidebar-compressed")) {
                    $("body").removeClass("sidebar-compressed");
                    $(this).html('<i class="fa fa-arrow-left"></i>');
                } else {
                    $("body").addClass("sidebar-compressed");
                    $(this).html('<i class="fa fa-arrow-right"></i>');
                }
            }) ;
        });
    </script>

    @yield('scripts')
    @include('modals')


</body>

</html>
