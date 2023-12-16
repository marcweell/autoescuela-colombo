@extends('main.templates.main')

@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-6">
                    <div class="page-title-content">
                        <h3>{{ __("Sobre") }}</h3>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="breadcrumbs"><a href="{{ route('web.public.index') }}">{{ __("Página Inicial") }}</a></div>
                </div>
            </div>
        </div>
    </div>

    <div class="item-single section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="top-bid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    {!! page_info('about') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
