@extends('main.templates.auth')

@section('content')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-xl-5 col-md-6">
            <div class="mini-logo text-center my-4"><a href="{{ route('web.public.index') }}"><img class="img-fluid"
                        src="{{ url('public/assets/images/logo.png') }}" alt=""></a>
                <h4 class="card-title mt-5">{{ __("Ativar Conta") }}</h4>
            </div>
            <div class="auth-form card">
                <div class="card-body">


                    <form method="post" action="{{ route('web.account.activation.auth') }}" method="post"
                        class="form_ parent-load">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        @if (!empty($connect_to))
                            <input type="hidden" name="connect_to" value="{{ $connect_to }}">
                        @endif
                        @if (!empty($invite_token))
                            <input type="hidden" name="invite_token" value="{{ $invite_token }}">
                        @endif


                        <div class="form-group">
                            <label>{{ __("Nova senha") }}</label>


                            <div class="input-group">
                                <input type="password" id="pwd" class="form-control" name="password">
                                <div class="input-group-append">
                                    <button id="togglePassword" class="btn btn-dark btn-lg rounded-0" type="button"><i
                                            class="fa fa-eye"></i></button>
                                </div>
                            </div>


                        </div>

                        <div class="form-group">
                            <label>{{ __("Confirme a Senha") }}</label>
                            <input type="password" class="form-control" name="confirm_password">
                        </div>


                        <div class="mt-3 d-grid gap-2"><button type="submit"
                                class="btn btn-primary mr-2 chl_loader">{{ __("Confirmar") }}</button></div>
                    </form>
                    </p>
                </div>
            </div>
            <div class="privacy-link d-inline w-100">
                <a class="text-primary p-2" href="{{ route('web.public.index') }}">{{ __("Pagina Inicial") }}</a>
                <a class="text-primary p-2" target="_blank" href="{{ route('web.public.terms.index') }}">{{ __("Termos de Uso")  }}</a>
                <a class="text-primary p-2" target="_blank" href="{{ route('web.public.privacy.index') }}">{{ __("Politicas") }}</a>
            </div>
        </div>
    @endsection
 