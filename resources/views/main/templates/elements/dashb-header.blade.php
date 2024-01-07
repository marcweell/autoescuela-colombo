
           <!-- Navbar-->
           <header class="app-header">
            <a class="app-header__logo" href="{{ route('web.public.index') }}">
                <img height="25px" src="{{ url('public/essential/img/logo.png') }}" alt="">
            </a>
            <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="javascript:void()"
                data-toggle="sidebar" aria-label="Hide Sidebar"></a>
            <!-- Navbar Right Menu-->
            <ul class="app-nav">
                <!--Notification Menu-->
                <li class="dropdown"><a class="app-nav__item" href="javascript:void()" data-bs-toggle="dropdown"
                        aria-label="Show notifications"><i class="fa fa-bell fs-5"></i></a>
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
                        <li class="app-notification__footer"><a href="javascript:void()">See all notifications.</a>
                        </li>
                    </ul>
                </li>
                <!-- User Menu-->
                <li class="dropdown"><a class="app-nav__item" href="javascript:void()" data-bs-toggle="dropdown"
                        aria-label="Open Profile Menu"><i class="fa fa-user fs-4"></i></a>
                    <ul class="dropdown-menu settings-menu dropdown-menu-right">
                        <li><a class="dropdown-item _link_"
                                data-href="{{ route('web.app.profile.index') }}" href="#"><i
                                    class="fa fa-user-cog me-2 fs-5"></i>
                                {{ __('Perfil') }}</a></li>
                        <li><a class="dropdown-item _link_ prompt"
                                data-href="{{ route('web.account.auth.logout') }}"
                                data-title="{{ __('Cerrar sesión') }}" href="#"><i
                                    class="fa fa-sign-out me-2 fs-5"></i> {{ __('Cerrar sesión') }}</a></li>
                    </ul>
                </li>
            </ul>
        </header>

