<div class="card">

    <div class="card-body">
        <h4 class="header-title" style="{{ empty($mandala->hex_color) ? '' : 'color: ' . $mandala->hex_color . '!important;' }}">
            <img style="width: 100px;margin: 10px;" class="lazy" data-src="{{ tools()->photo($mandala->plan_icon) }}"
                alt="">{{ __('Gerenciar') . ' - ' . $mandala->name }} </h4>

        <button data-id="{{ $mandala->id }}" class="btn btn-lg btn-dark m-3 l14k"
            data-href="{{ route('web.admin.mandala.participant.manage.tree.index') }}"><i class="fa fa-tree"></i>Vis&atilde;o da Matriz</button>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                    type="button" role="tab" aria-controls="home" aria-selected="true">Recebedor</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Construtor</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="doador-tab" data-bs-toggle="tab" data-bs-target="#doador" type="button"
                    role="tab" aria-controls="doador" aria-selected="false">Doadores</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="danation-tab" data-bs-toggle="tab" data-bs-target="#danation"
                    type="button" role="tab" aria-controls="danation" aria-selected="false">Doacoes</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active p-4" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    @foreach ($mandala_participant as $item)
                        @if ($item->type !== 'receptor')
                            @continue;
                        @endif
                        <div class="col-sm-12 col-md-6 col-lg-3">

                            <div class="card p-2">
                                <img class="card-img-top" src="{{ tools()->photo($item->user_profile_picture) }}"
                                    alt="card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <div class="flex-grow-1 ms-2">
                                            <h5 class="my-0">{{ $item->user_full_name }}</h5>
                                            <p class="mb-0 txt-muted">{{ $item->user_code }}</p>
                                        </div>
                                    </h5>
                                    <p class="card-text"></p>
                                    <!--a href="#" class="btn btn-secondary">Go somewhere</a-->
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <a data-payloads="{{ json_encode(['type' => 'receptor', 'mandala_id' => $mandala->id]) }}"
                            data-href="{{ route('web.admin.mandala.participant.add.index') }}"
                            class="btn btn-secondary l14k">Adicionar</a>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade p-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">.
                <div class="row">
                    @foreach ($mandala_participant as $item)
                        @if ($item->type !== 'construtor')
                            @continue;
                        @endif
                        <div class="col-sm-12 col-md-6 col-lg-3">

                            <div class="card p-2 shadow">
                                <img class="card-img-top" src="{{ tools()->photo($item->user_profile_picture) }}"
                                    alt="card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <div class="flex-grow-1 ms-2">
                                            <h5 class="my-0">{{ $item->user_full_name }}</h5>
                                            <p class="mb-0 txt-muted">{{ $item->user_code }}</p>
                                        </div>
                                    </h5>
                                    <p class="card-text">Indicador: {{ $item->inviter_full_name }}</p>
                                    <!--a href="#" class="btn btn-secondary">Go somewhere</a-->
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <a data-payloads="{{ json_encode(['type' => 'construtor', 'mandala_id' => $mandala->id]) }}"
                            data-href="{{ route('web.admin.mandala.participant.add.index') }}"
                            class="btn btn-secondary l14k">Adicionar</a>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade p-4" id="doador" role="tabpanel" aria-labelledby="doador-tab">
                <div class="row">
                    @foreach ($mandala_participant as $item)
                        @if ($item->type !== 'doador')
                            @continue;
                        @endif




                        @php
                            $unlock_id = null;
                        @endphp

                        @foreach ($mandala_unlock as $mu)
                            @if ($mu->user_id = $item->user_id)
                                @php
                                    $unlock_id = $mu->id;
                                @endphp
                            @break
                        @endif
                    @endforeach


                    <div class="col-sm-12 col-sm-12 col-md-6 col-lg-3">

                        <div class="card p-2 shadow">
                            <img class="card-img-top" src="{{ tools()->photo($item->user_profile_picture) }}"
                                alt="card image cap">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <div class="flex-grow-1 ms-2">
                                        <h5 class="my-0">{{ $item->user_full_name }}</h5>
                                        <p class="mb-0 txt-muted">{{ $item->user_code }}</p>
                                    </div>
                                </h5>
                                <p class="card-text">Indicador: {{ $item->inviter_full_name }}</p>


                                @if ($item->user_type == 'admin' or in_array($item->id, $unlockeds))
                                    <a data-id="-1"
                                        data-payloads="{{ json_encode(['mandala_participant_id' => $item->id]) }}"
                                        data-href="{{ route('web.admin.mandala.donate.add.index') }}"
                                        href="#" class="btn btn-info btn-block btn-sm w-100 l14k">Carregar
                                        Doacao</a>
                                @endif


                                @if (!in_array($item->id, $unlocks) and !in_array($item->id, $unlockeds) and $item->user_type !== 'admin')
                                    <a data-id="-1"
                                        data-payloads="{{ json_encode(['mandala_participant_id' => $item->id]) }}"
                                        data-href="{{ route('web.admin.mandala.unlock.add.index') }}"
                                        href="#" class="btn btn-dark btn-block btn-sm w-100 l14k">Carregar
                                        Doacao a Indicador</a>
                                @elseif(in_array($item->id, $unlocks) and $item->user_type !== 'admin')
                                    <a data-payloads="{{ json_encode(['mandala_unlock_id' => $unlock_id]) }}"
                                        data-href="{{ route('web.admin.mandala.unlock.approvement.accept') }}"
                                        href="#"
                                        class="btn btn-success btn-block btn-sm w-100 l14k">Aceitar</a>
                                    <a data-payloads="{{ json_encode(['mandala_unlock_id' => $unlock_id]) }}"
                                        data-href="{{ route('web.admin.mandala.unlock.approvement.refuse') }}"
                                        href="#"
                                        class="btn btn-danger btn-block btn-sm w-100 l14k">Recusar</a>
                                @endif







                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12">
                    <a data-payloads="{{ json_encode(['type' => 'doador', 'mandala_id' => $mandala->id]) }}"
                        data-href="{{ route('web.admin.mandala.participant.add.index') }}"
                        class="btn btn-secondary l14k">Adicionar</a>
                </div>

            </div>
        </div>
        <div class="tab-pane fade p-4" id="danation" role="tabpanel" aria-labelledby="danation-tab">
            <div class="row">
                @foreach ($mandala_donation as $item)
                    <div class="col-sm-12 col-sm-12 col-md-6 col-lg-3">

                        <div class="card p-2 shadow">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <div class="flex-grow-1 ms-2">
                                        <h5 class="my-0">{{ $item->user_full_name }}</h5>
                                        <p class="mb-0 txt-muted">{{ $item->user_code }}</p>
                                        <h3 class="mb-0 txt-muted"> Montante:
                                            {{ $item->currency_symbol . format_number($item->amount ?? 0) }}</h3>
                                        <a data-payloads="{{ json_encode(['id' => $item->transaction_id]) }}"
                                            data-id={{ $item->transaction_id }}
                                            data-href="{{ route('web.admin.finance.transaction.detail.index') }}"
                                            href="#"
                                            class="btn btn-dark btn-block btn-sm w-100 l14k pt-2 pb-2">Ver
                                            Detalhes</a>

                                    </div>
                                </h5>
                                <p class="card-text"></p>
                                @if ($item->paid == false)
                                    <a data-payloads="{{ json_encode(['mandala_donation_id' => $item->id]) }}"
                                        data-href="{{ route('web.admin.mandala.donate.approvement.accept') }}"
                                        href="#"
                                        class="btn btn-success btn-block btn-sm w-100 l14k">Aceitar</a>
                                    <a data-payloads="{{ json_encode(['mandala_donation_id' => $item->id]) }}"
                                        data-href="{{ route('web.admin.mandala.donate.approvement.refuse') }}"
                                        href="#"
                                        class="btn btn-danger btn-block btn-sm w-100 l14k">Recusar</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>








    </form>

</div> <!-- end card-body -->
</div>
