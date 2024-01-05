        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="{{  route("web.index") }}" class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ url('public/assets/images/logo-light.png') }}" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ url('public/assets/images/logo-light.png') }}" alt="small logo">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="{{  route("web.index") }}" class="logo-dark">
                            <span class="logo-lg">
                                <img src="{{ url('public/assets/images/logo-dark.png') }}" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ url('public/assets/images/logo-dark.png') }}" alt="small logo">
                            </span>
                        </a>
                    </div>
 

 
                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">
             

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="align-middle d-none d-lg-inline-block">English</span> <i
                                class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <span class="align-middle">German</span>
                            </a>


                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <span class="align-middle">Russian</span>
                            </a>

                        </div>
                    </li>
 
 

                    <li class="d-none d-sm-inline-block">
                        <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                            <i class="ri-settings-3-line font-22"></i>
                        </a>
                    </li>
  
             
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->
