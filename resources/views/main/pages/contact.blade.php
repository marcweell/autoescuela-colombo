@extends('main.templates.main')

@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-6">
                    <div class="page-title-content">
                        <h3>{{ __('Fale Connosco') }}</h3>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="breadcrumbs"><a href="{{ route('web.public.index') }}">{{ __('Pagina Inicial') }}</a></div>
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
                                    <h2>{{ __('Entrar em contato') }}</h2>
                                    <form method="post" action="{{ route('web.public.api.message.send') }}"
                                        id="contact-form" class="form_ prompt">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Nome') }}</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Seu Nome" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Email') }}</label>
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Seu Email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Assunto') }}</label>
                                            <input type="text" class="form-control" name="subject" placeholder="Assunto"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Mensagem') }}</label>
                                            <textarea required name="message" cols="30" rows="5" class="form-control" placeholder="Digite sua mensagem"></textarea>
                                        </div>
                                        <div class="form-group pt-3">

                                            <button type="submit" class="btn-secondary chl_loader">{{ __('Enviar') }} <i
                                                    class="far fa-paper-plane"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
