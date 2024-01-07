@extends("main.templates.auth",['page_title'=>'Login'])

@section('content')

<section class="inner-page">
    <div class="container">

        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-xl-5 col-md-6">
                <div class="auth-form card">
                    <div class="card-body">
                        <form action="{{ route('web.account.auth.login') }}" method="post" class="form_ parent-load">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label">{{ __("Usuário") }}</label>
                                    <input   type="text" class="form-control" name="user">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">{{ __("Senha") }}</label>
                                    <div class="input-group">
                                        <input type="password" id="pwd" class="form-control" name="password">
                                        <div class="input-group-append">
                                            <button id="togglePassword" class="btn btn-dark btn-lg rounded-0" type="button"><i
                                                    class="fa fa-eye"></i></button>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input name="remember" type="checkbox" class="form-check-input">
                                        <label class="form-check-label">{{ __("Salvar Sessão") }}</label></div>
                                </div>
                                <div class="col-6 text-end"><a href="{{ route('web.account.forgot.index') }}">{{ __("Esqueceu sua senha?") }}</a></div>
                            </div>
                            <div class="mt-3 d-grid gap-2"><button type="submit" class="btn btn-dark mr-2 chl_loader">{{ __("Entrar") }}</button></div>
                        </form>
                    </div>
                </div>
                <div class="mt-4">
                    <a class="text-primary p-2" href="{{ route('web.public.index') }}">{{ __("Página Inicial") }}</a>
                    <a class="text-primary p-2" href="{{ route('web.account.signup.index') }}">{{ __("Criar Conta") }}</a>
                    <a class="text-primary p-2" target="_blank" href="{{ route('web.public.terms.index') }}">{{ __("Termos de Uso") }}</a>
                    <a class="text-primary p-2" target="_blank" href="{{ route('web.public.privacy.index') }}">{{ __("Políticas") }}</a>
            </div>
        </div>








    </div>
</section>



@endsection
