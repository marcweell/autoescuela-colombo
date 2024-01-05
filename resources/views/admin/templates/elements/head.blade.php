
<head>
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="">
    <meta property="og:title" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="">

    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" href="{{ url('public/essential/plugins/pace/flash.css') }}">
    <link rel="stylesheet" href="{{ url('public/essential/plugins/toast-master/css/jquery.toast.css') }}" />
    <link rel="shortcut icon" href="{{ url("public/essential/img/favicon.png") }}" type="image/x-icon">

    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet"
        href="{{ url('public/essential/plugins/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('public/essential/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/essential/plugins/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/essential/plugins/font-awesome/css/solid.css') }}">
    <link rel="stylesheet" href="{{ url('public/essential/plugins/font-awesome/css/pro.css') }}">
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
    <link rel="stylesheet" href="{{ url('public/essential/plugins/Croppie/croppie.css') }}">
    <link rel="stylesheet" href="{{ url('public/essential/plugins/color-picker-huebee/huebee.css') }}">
    <link rel="stylesheet" href="{{ url('public/essential/plugins/bootstrap-icon-picker/dist/css/bootstrapicons-iconpicker.min.css') }}">

    <link rel="stylesheet" href="{{ url('public/essential/plugins/select2/select2.min.css') }}">

    <link rel="stylesheet" href="{{ url('public/essential/plugins/summernote-0.8.20/dist/summernote-bs5.css') }}" />
    <link rel="stylesheet" href="{{ url('public/essential/plugins/jPages-master/css/jPages.css') }}">
    <link href="{{ url('public/essential/plugins/jquery-smartwizard/dist/css/smart_wizard_all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/essential/plugins/gallery/gallery.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('public/essential/plugins/jquery-steps-master/demo/css/jquery.steps.css') }}">


    <link rel="stylesheet" href="{{ url('public/essential/plugins/dropzone/dist/basic.css') }}">
    <link rel="stylesheet" href="{{ url('public/essential/plugins/dropzone/dist/dropzone.css') }}">



@yield('head')


</head>
