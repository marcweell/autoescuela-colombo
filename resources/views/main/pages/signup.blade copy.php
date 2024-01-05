@extends('admin.templates.auth')

@section('login-form')
    <div class="login-wrapper">
        <form method="post" action="{{ route('web.account.auth.login') }}" method="post" class="form_ parent-load">
            <div class="login-screen">
                <div class="login-body">
                    <a href="{{ url('/') }}" class="login-logo">
                        <img src="{{ url('public/assets/img/logo.png') }}" style="width: auto;">
                    </a>
                    <h6>Insira suas credenciais para iniciar sessao.</h6>
                    <div class="field-wrapper pb-3">
                        <a href="{{ url('/') }}" class="know-more"><i class="fa fa-long-arrow-left"></i> Voltar a Pagina Inicial</a>
                    </div>
                    <div class="field-wrapper">
                        <input name="user" type="text" autofocus>
                        <div class="field-placeholder">Usuario/Email</div>
                    </div>
                    <div class="actions">
                        <button type="submit" class="btn btn-secondary chl_loader">{{ __("Confirmar") }}</button>
                    </div>
                </div>

                <div class="login-footer">
                    <span class="additional-link">Ja possui uma conta?<a href="{{ route('web.account.auth.index') }}" class="btn btn-primary">Entrar</a></span>
                </div>
            </div>
        </form>
    </div>
@endsection
