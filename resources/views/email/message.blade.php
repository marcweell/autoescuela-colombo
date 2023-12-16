@extends('email.template')
@section('content')
    <table style="width: 80%;">
        <tr>
            <td>
                <div class="text" style="padding: 0 2.5em; text-align: justify;">
                    <h2>Saudacoes, <b>{{ $name }}</b></h2>
                    <h3>Recebemos a sua mensagem com o assunto "{{ $subject }}".</h3>
                    <p style="font-size: 14pt">Caso nao seja voce, clique <a href="#">aqui</a> para rejeitar esta mensagem.</p>
                    <hr>
                    <h4 class="text">Conteudo da Mensagem: <br/>
                    <small class="text">{{ $message }}</small>
                    </h4>
                </div>
            </td>
        </tr>
    </table>
@endsection
