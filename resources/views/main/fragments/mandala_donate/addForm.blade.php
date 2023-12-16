<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Inciar Transacao') }}</h4>
        <form action="{{ route('web.app.mandala.donate.add.do') }}" class="form_ parent-load-- row" method="post">
            <div class="read-content">
                <div class="media pt-3 d-sm-flex d-block justify-content-between row">
                    <div class="col-md-6 mb-3">
                        <h4 class="d-block">{{ __("Informacoes de Doador") }}</h4>
                        <div class="d-flex">

                            <img class="me-3 rounded" width="70" height="70" alt="image"
                                src="{{ tools()->photo($user->profile_picture) }}">
                            <div class="media-body me-2">
                                <h5 class="text-primary mb-0 mt-1">{{ implode(' ', [$user->name, $user->last_name]) }}
                                </h5>
                                <p class="mb-0">{{ $user->code }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h4 class="d-block">{{ __("Informacoes de Recebedor") }}</h4>
                        <div class="d-flex">

                            <img class="me-3 rounded" width="70" height="70" alt="image"
                                src="{{ tools()->photo($beneficiary->profile_picture) }}">
                            <div class="media-body me-2">
                                <h5 class="text-primary mb-0 mt-1">
                                    {{ implode(' ', [$beneficiary->name, $beneficiary->last_name]) }}</h5>
                                <p class="mb-0">{{ $beneficiary->code }}</p>
                            </div>
                        </div>
                        <ul>
                            <h6 class="mt-3">{{ __("Contas") }}</h6>
                            @foreach ($payments as $item)
                                <li class="text-primary p-2">{{ $item->payment_method_name . ': ' . $item->account_number }}   {{ (!empty($item->company) and strtolower($item->payment_method_name) == 'usdt') ? " -  {$item->company}" : '' }}
                               
                                    @if (strtolower($item->payment_method_name) == "pix")
                                    <button role="button"
                                    data-content="{{ $item->account_number }}" class="btn btn-dark copyl"
                                    type="button"><i class="fa fa-copy"></i></button>
                                    @endif
    
    
                               
                                </li>
                            @endforeach
                        </ul>

                        <ul>
                            <h6 class="mt-3">{{ __("Redes Sociais") }}</h6>
                            @foreach ($user_social_media as $item)
                                <li class="text-primary p-2">{{ $item->social_media_name . ': ' . $item->profile_id }}</li>

                                @if (strtolower($item->social_media_name) == 'whatsapp')
                                    <li>
                                        <a href="https://wa.me/{{ $item->profile_id }}" class="btn btn-success"><i
                                                class="fa fa-paper-plane"></i> {{ __("Mandar Mensagem") }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>


                        <div class="media mb-2">
                            <h5 class="my-1 text-primary"><i class="fa fa-coins"></i>
                                {{ $mandala->currency_symbol . format_number($mandala->price * 0.75) }} ({{ convertCoin($mandala->currency_code,"USD",$mandala->price * 0.75,"USD") }})</h5>
                        </div>
                        <label for="name" class="form-label">{{ __('Metodo de Pagamento') }}</label>
                        <select name="payment_method_id" id="user_id" class="form-control">
                            @foreach ($payment_method as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}{{ !empty($item->account_number_type) and (strtolower($item->name) == 'pix' ? " ({$item->account_number_type})" : '') }} 
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
            </div>
            <input type="hidden" name="mandala_participant_id" value="{{ $mandala_participant->id }}">


            <div class="col-12 mb-3">
                <label for="amount" class="form-label">{{ __('Descricao') }}</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>


            <div class="col-md-12">
                <h4 class="mb-4">Anexos
                    <button type="button" role="button" to="#carr" elem-target="#em"
                        class="clonehim btn btn-dark float-end"><i class="fa fa-plus"></i></button>
                </h4>
                <hr>
            </div>
            <div class="col-12">
                <div class="row" id="carr">


                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-dark  chl_loader--"><i
                        class="fa fa-git checkout CAR-5-cobranca-e-pagamento-por-qrcodepaper-plane p-1"></i>{{ __('Enviar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>



<div style="display:none;" id="em">
    <div class="im_dad col-12 mb-1">
        <div>
            <div class="input-group">
                <input type="file" name="attach[]">
                <div class="input-group-append">
                    <button class="rm_dad btn btn-dark waves-effect waves-light" type="button"><i
                            class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
