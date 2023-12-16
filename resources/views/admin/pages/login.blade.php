@extends('admin.templates.auth') 
@section('content')

<div class="row justify-content-center h-100 align-items-center">
    <div class="col-xl-5 col-md-6">
        <div class="mini-logo text-center my-4"><a href="{{ route('web.public.index') }}"><img class="img-fluid" src="{{ url('public/assets/images/logo.png') }}" alt=""></a>
            <h4 class="card-title mt-5">Digite suas credenciais - ADMIN</h4>
        </div>
        <div class="auth-form card">
            <div class="card-body">
                <form action="{{ route('web.admin.account.auth.login') }}" method="post" class="form_ parent-load">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Usuário</label>
                            <input   type="text" class="form-control" name="user">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password"  class="form-control" name="password">
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input name="remember" type="checkbox" class="form-check-input">
                                <label class="form-check-label">Salvar Sessão</label>
							</div>
                        </div>
                        <div class="col-6 text-end"><a href="{{ route('web.admin.account.forgot.index') }}">Esqueceu sua senha?</a></div>
                    </div>
                    <div class="mt-3 d-grid gap-2"><button type="submit" class="btn btn-primary mr-2 chl_loader">Entrar</button></div>
                </form>
            </div>
        </div>
        <div class="privacy-link d-inline w-100">
            <a class="text-primary p-2" href="{{ route('web.public.index') }}">Página Inicial</a>
    </div>
</div>

@endsection