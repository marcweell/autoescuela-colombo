<!DOCTYPE html>

<html lang="en" data-layout="topnav" data-topbar-color="dark" data-menu-color="light"
    data-bs-theme="{{ uconfig('color-scheme-mode') }}">

<head>
    @include('crm.templates.elements.head')
    <style>
        ._grid:hover {
            background-color: #ccc !important;
        }
    </style>
</head>

<body>


    @include('loader')
    <!-- Begin page -->
    <div class="wrapper">

        @include('crm.templates.elements.nav')


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <!-- Start Content-->
            <div class="container-fluid">
 

                <div class="row">
                    <div class="col-12 pt-3" id="page-content">



                    </div> 
                </div>


            </div> <!-- container -->

            @include('user.templates.elements.footer')

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


        @include('modals')
        @include('crm.templates.elements.scripts')
        @include('crm.templates.elements.sidebar-right')
    </div>
    <!-- END wrapper -->
</body>

</html>
