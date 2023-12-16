<div class="header landing bg-transparent--">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="navigation">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="brand-logo">
                            <a href="{{ route('web.public.index') }}">
                                <img src="{{ url('public/assets/images/logo.png') }}" alt="" class="logo-primary">
                                <img src="{{ url('public/assets/images/logow.png') }}" alt=""
                                    class="logo-white">
                            </a>
                        </div>
                        <button class="bg-white navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item active"><a class="nav-link text-capitalize"
                                        href="{{ route('web.public.index') }}">{{ __('inicio') }}</a></li>
                                <li class="nav-item"><a class="nav-link text-capitalize"
                                        href="{{ route('web.public.about.index') }}">{{ __('Conceito') }}</a></li>
                                <li class="nav-item"><a class="nav-link text-capitalize"
                                        href="{{ route('web.public.index') . '#crowdf' }}"
                                        style="width: 150px;">{{ __('Crowdfunding 2.0') }}</a>
                                </li>
                                <li class="nav-item"><a class="nav-link text-capitalize"
                                        href="{{ route('web.public.plan.index') }}">{{ __('fases') }}</a></li>
                                <li class="nav-item"><a style="width: 130px;" class="nav-link text-capitalize"
                                        href="{{ route('web.public.index').'#tstm' }}">{{ __('Depoimentos') }}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="signin-btn d-flex align-items-center">
                            <div class="dark-light-toggle theme-switch  px-2" onclick="themeToggle()">
                                <span class="dark"><i class="ri-moon-line m-0"></i></span>
                                <span class="light"><i class="ri-sun-line m-0"></i></span>
                            </div> 
                            <a class="btn btn-primary text-uppercase shadow mx-1"
                                href="{{ route('web.account.index') }}">{{ Auth::check() ? __('conta') : __('Login') }}</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>