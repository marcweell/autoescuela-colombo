       <!DOCTYPE html>
       <html lang="en">

       <head>
           <!-- Open Graph Meta-->
           <meta property="og:type" content="website">
           <meta property="og:site_name" content="Vali Admin">
           <meta property="og:title" content="Vali - Free Bootstrap 5 admin theme">
           <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
           <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
           <meta property="og:description"
               content="Vali is a responsive and free admin theme built with Bootstrap 5, SASS and PUG.js. It's fully customizable and modular.">

           <title>{{ config('app.name') }}</title>
           <meta charset="utf-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <!-- Add the slick-theme.css if you want default styling -->
           <link rel="stylesheet" href="{{ url('public/essential/plugins/pace/flash.css') }}">
           <link rel="stylesheet"
               href="{{ url('public/essential/plugins/lobibox-master/dist/css/lobibox.min.css') }}" />
           <link rel="stylesheet"
               href="{{ url('public/essential/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css') }}" />
           <link rel="stylesheet" href="{{ url('public/essential/plugins/font-awesome/css/all.min.css') }}" />
           <link rel="stylesheet" href="{{ url('public/essential/plugins/font-awesome/css/pro.min.css') }}" />
           <link rel="stylesheet" href="{{ url('public/essential/loader/loader.css') }}">
           <style>
               .menu ul li {
                   margin-bottom: 0px;
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
           </style>
           <!-- Main CSS-->
           <link rel="stylesheet" type="text/css" href="{{ url('public/dashboard/css/main.css') }}">
           <!-- Font-icon css-->
           <link rel="stylesheet" type="text/css"
               href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
       </head>

       <body class="app sidebar-mini">
           @include('loader')

           <!-- Navbar-->
           <header class="app-header"><a class="app-header__logo" href="{{ route('web.public.index') }}">Vali</a>
               <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
                   aria-label="Hide Sidebar"></a>
               <!-- Navbar Right Menu-->
               <ul class="app-nav">
                   <!--Notification Menu-->
                   <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown"
                           aria-label="Show notifications"><i class="bi bi-bell fs-5"></i></a>
                       <ul class="app-notification dropdown-menu dropdown-menu-right">
                           <li class="app-notification__title">You have 4 new notifications.</li>
                           <div class="app-notification__content">
                               <li><a class="app-notification__item" href="javascript:;"><span
                                           class="app-notification__icon"><i
                                               class="fa fa-bell fs-4 text-primary"></i></span>
                                       <div>
                                           <p class="app-notification__message">Lisa sent you a mail</p>
                                           <p class="app-notification__meta">2 min ago</p>
                                       </div>
                                   </a></li>
                           </div>
                           <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
                       </ul>
                   </li>
                   <!-- User Menu-->
                   <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown"
                           aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
                       <ul class="dropdown-menu settings-menu dropdown-menu-right">
                           <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-gear me-2 fs-5"></i>
                                   Settings</a></li>
                           <li><a class="dropdown-item" href="page-login.html"><i
                                       class="bi bi-box-arrow-right me-2 fs-5"></i> Logout</a></li>
                       </ul>
                   </li>
               </ul>
           </header>


           <!-- Sidebar menu-->
           <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
           <aside class="app-sidebar">
               <div class="app-sidebar__user"><img class="app-sidebar__user-avatar"
                       src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
                   <div>
                       <p class="app-sidebar__user-name">{{ $user->name }}</p>
                       <p class="app-sidebar__user-designation">{{ $user->type }}</p>
                   </div>
               </div>
               <ul class="app-menu">
                   <li><a class="app-menu__item l14k" data-href="{{ route('web.admin.index') }}" href="#"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Dashboard</span></a></li>
                   <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                               class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Usuarios</span><i
                               class="treeview-indicator bi bi-chevron-right"></i></a>
                       <ul class="treeview-menu">
                           <li><a class="treeview-item l14k" data-href="{{ route('web.admin.user.index') }}" href="#" target="_blank" rel="noopener"><i class="icon bi bi-circle-fill"></i> Lista</a></li>
                           <li><a class="treeview-item l14k" data-href="{{ route('web.admin.user.add.index') }}" href="#"><i class="icon bi bi-circle-fill"></i> crea</a></li>
                       </ul>
                   </li>
                   <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                               class="app-menu__icon fa fa-newspaper"></i><span class="app-menu__label">Paginas</span><i
                               class="treeview-indicator bi bi-chevron-right"></i></a>
                       <ul class="treeview-menu">
                           <li><a class="treeview-item" href="bootstrap-components.html"><i
                                       class="icon bi bi-circle-fill"></i> Bootstrap Elements</a></li>
                           <li><a class="treeview-item" href="https://icons.getbootstrap.com/" target="_blank"
                                   rel="noopener"><i class="icon bi bi-circle-fill"></i> Font Icons</a></li>
                           <li><a class="treeview-item" href="ui-cards.html"><i class="icon bi bi-circle-fill"></i>
                                   Cards</a></li>
                           <li><a class="treeview-item" href="widgets.html"><i class="icon bi bi-circle-fill"></i>
                                   Widgets</a></li>
                       </ul>
                   </li>
                   <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                               class="app-menu__icon bi bi-ui-checks"></i><span
                               class="app-menu__label">Perguntas</span><i
                               class="treeview-indicator bi bi-chevron-right"></i></a>
                       <ul class="treeview-menu">
                           <li><a class="treeview-item" href="form-components.html"><i
                                       class="icon bi bi-circle-fill"></i> Form Components</a></li>
                           <li><a class="treeview-item" href="form-samples.html"><i
                                       class="icon bi bi-circle-fill"></i> Form Samples</a></li>
                       </ul>
                   </li>
                   <li><a class="app-menu__item l14k" data-href="{{ route('web.admin.page_info.index') }}" href="#" target="_blank" ><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Configuracion</span></a></li>
               </ul>
           </aside>
           <main class="app-content">
               <div class="app-title">
                   <div>
                       <h1>{{ config("app.name") }}</h1>
                   </div>
                   <ul class="app-breadcrumb breadcrumb">
                       <li class="breadcrumb-item"><a href="{{ route('web.public.index') }}"><i class="bi bi-house-door fs-6"></i></a></li>
                   </ul>
               </div>
               <div class="row">
                   <div class="col-md-12" id="page-content">
                       @yield('content')
                   </div>
               </div>
           </main>


           @include('modals')
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
               })
           </script>

           @yield('scripts')


       </body>

       </html>
