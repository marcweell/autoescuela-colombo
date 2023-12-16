<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="pb-2">{{ __('Detalhes de Transacao') }}</h5>
                <ul>
                    <li class=""> ID: {{ $transaction->code }} </li>
                    <li class=""> Tipo: {{ $transaction->type }} </li>
                    <li class=""> Montante: {{ $transaction->currency_symbol . format_number($transaction->amount ?? 0) }} </li>
                    <li class=""> Estado: {!! $transaction->status == 'completed'
                        ? '<span class="badge text-light bg-success text-light">' . $transaction->status . '</span>'
                        : '<span class="badge text-light bg-warning text-light">' . $transaction->status . '</span>' !!} </li>
                    <li class=""> Data de Pagamento: {{ tools()->date_convert($transaction->payment_date, 'd/m/Y') }} </li>

                </ul>
            </div>
            <div class="col-md-6">
                <h5 class="pb-2">Descricao</h5>
                <p class="">{{ $transaction->description }}</p>
            </div>
            <div class="col-12">

                <ul>
                    <h6 class="p-2">Anexos: </h6>
                    @foreach ($transaction_attachment as $value)
                        @if ($value->transaction_id !== $transaction->id)
                            @continue;
                        @endif
                        <li><a target="_blank" href="{{ url('storage/files/' . $value->file) }}"><i
                                    class="fa fa-file p-2"></i>{{ $value->name }}</a></li>
                    @endforeach
                </ul>
            </div>


        </div>

    </div> <!-- end card-body -->
</div>
