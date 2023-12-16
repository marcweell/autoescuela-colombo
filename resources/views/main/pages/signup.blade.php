@extends('main.templates.auth')

@section('content')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-xl-5 col-md-6">
            <div class="mini-logo text-center my-4"><a href="{{ route('web.public.index') }}"><img class="img-fluid"
                        src="{{ url('public/assets/images/logo.png') }}" alt=""></a>
                <h4 class="card-title mt-5">{{ __("Digite seus dados") }}</h4>
            </div>
            <div class="auth-form card">

                @if (!empty($inviter->id))
                    <div class="card-body text-end">

                        <h6>{{ __("Patrocinador") }}:</h6>
                        <small>{{ implode(' ', [$inviter->name, $inviter->last_name]) }} | {{ $inviter->email }}</small>
                        <hr>
                    </div>
                @endif



                <div class="card-body">
                    <form action="{{ route('web.account.signup.do') }}" method="post" class="form_ parent-load">

                        @if (!empty($connect_to))
                            <input type="hidden" name="connect_to" value="{{ $connect_to }}">
                        @endif
                        @if (!empty($invite_token))
                            <input type="hidden" name="invite_token" value="{{ $invite_token }}">
                        @endif


                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __("Nome") }} <span class="text-danger">*</span></label>
                                        <input required type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __("Sobrenome") }} <span class="text-danger">*</span></label>
                                        <input required type="text" name="last_name" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>{{ __("Email") }} <span class="text-danger">*</span></label>
                            <input required type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>{{ __("Nome de Usuario") }}</label>
                            <input type="text" class="form-control" name="code">
                        </div>

                        <div class="form-group">
                            <label>{{ __("Pais") }} <span class="text-danger">*</span></label>
                            <select name="country_id" required class="form-control">
                                @foreach ($country as $item)
                                    <option value="{{ $item->id }}"
                                        {{ strtolower($item->code) == 'br' ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <hr>
                        </div>

                        <div class="form-group">
                            <label>{{ __("Whatsapp") }} <span class="text-danger">*</span></label>
                            <input required type="text" name="whatsapp" class="form-control">
                        </div>


                        <div class="form-group">
                            <label>{{ __("Pix") }} <span class="text-danger">*</span></label>
                            <input required type="text" name="pix" class="form-control">
                        </div>

                        <div class="form-check">
                            <div class="left p-3">
                                <input required type="checkbox" class="text-white" id="exampleCheck1">
                                <label class="form-check-label text-white" for="exampleCheck1">{{ __("Aceito os") }} <a
                                        class="text-info" target="_blank"
                                        href="{{ route('web.public.terms.index') }}">{{ __("Termos e Condicoes.") }}</a></label>
                            </div>
                        </div>


                        <div class="mt-3 d-grid gap-2"><button type="submit"
                                class="btn btn-primary mr-2 chl_loader">{{ __('Confirmar') }}</button></div>
                    </form>
                </div>
            </div> 
            <div class="privacy-link d-inline w-100">
                <a class="text-primary p-2" href="{{ route('web.public.index') }}">{{ __('Pagina Inicial') }}</a>
                <a class="text-primary p-2" target="_blank"
                    href="{{ route('web.public.terms.index') }}">{{ __('Termos de Uso') }}</a>
                <a class="text-primary p-2" target="_blank"
                    href="{{ route('web.public.privacy.index') }}">{{ __('Politicas') }}</a>
            </div>
        </div>
    @endsection
