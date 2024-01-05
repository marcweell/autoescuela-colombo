<meta charset="utf-8" />
<title>
    {{ empty(uconfig('current_course')->name) ? '' : uconfig('current_course')->name . ' | ' }}
    {{ config('app.name') }}
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
<meta content="Coderthemes" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="{{ url('public/assets/images/favicon.ico') }}">

<!-- third party css -->
<link href="{{ url('public/assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
<!-- third party css end -->

<link href="{{ url('public/assets/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">

<script src="{{ url('public/assets/js/hyper-config.js') }}"></script>
<!-- App css -->
<link href="{{ url('public/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('public/assets/css/icons-modern.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" /> 
<link href="{{ url('public/assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
<link href="{{ url('public/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css') }}" rel="stylesheet"
    type="text/css">
<link rel="stylesheet" href="{{ url('public/assets/plugins/font-awesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ url('public/assets/plugins/font-awesome/css/solid.css') }}">
<link rel="stylesheet" href="{{ url('public/assets/plugins/font-awesome/css/pro.css') }}">
<link rel="stylesheet" href="{{ url('public/assets/plugins/pace/flash.css') }}">
<style>
    .modal .card {
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
    }
</style>
<!-- third party css -->
<link href="{{ url('public/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('public/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
