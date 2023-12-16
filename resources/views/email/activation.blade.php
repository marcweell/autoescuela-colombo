@extends('email.template')
@section('content')
    <tr>
        <div class="text" style="padding: 0 2.5em; text-align: center;">

            @if (!empty($user))
                <h1 style="display: block">Ola!, {{ implode(' ', [$user->name, $user->last_name]) }}</h2>
            @endif

            <h2>{{ $header ?? __('Ativacao de Conta') }}</h2>
            <h3 style="padding: 2px;">{{ $body ?? __('Clique no botao abaixo para activar a sua conta') }}</h3>
            <p><a href="{{ $link }}"
                    style="background: #357573; padding: 10px; margin: 10px; color: #fff; font-weight: bold; text-decoration: none; text-transform: uppercase;">{{ $link_btn ?? __('Ativar Conta') }}</a>
            </p>
            <h3 style="padding: 2px;">{!! empty($more) ? '' : $more !!}</h3>
        </div>
    </tr>
@endsection
