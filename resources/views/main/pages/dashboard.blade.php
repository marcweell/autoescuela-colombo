<!DOCTYPE html>
<html lang="en">

@include('admin.templates.elements.head')
<body class="app sidebar-mini">
    @include('loader')

    @include('admin.templates.elements.header')
    @include('main.templates.elements.sidebar')


    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>{{ config('app.name') }}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('web.public.index') }}"><i
                            class="fa fa-home fs-6"></i></a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12" id="page-content">
                @yield('content')
            </div>
        </div>
    </main>


    @include('modals')
    @include('admin.templates.elements.scripts')


</body>

</html>
