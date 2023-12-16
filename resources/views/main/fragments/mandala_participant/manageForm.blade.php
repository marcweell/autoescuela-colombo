 <div class="card">

     <div class="card-body">
         <h4 class="header-title"
             style="{{ empty($mandala->hex_color) ? '' : 'color: ' . $mandala->hex_color . '!important;' }}">
             <img style="width: 130px;margin: 10px;" src="{{ tools()->photo($mandala->plan_icon) }}" alt=""><span
                 style="font-size: 34pt;">{{ $mandala->name }}</span>
             <small class="d-block" style="color: #bfbcbc;">ID: {{ $mandala->code }}</small>
         </h4>

         <button data-id="{{ $mandala->id }}" class="btn btn-lg btn-dark m-3 l14k"
             data-href="{{ route('web.app.mandala.participant.manage.tree.index') }}"><i class="fa fa-tree"></i>{{ __("Visao da Matriz") }}</button>

         @if (empty($beneficiary->id) ? null : $beneficiary->id == Auth::user()->id)
             <button data-id="{{ $mandala->id }}" class="btn btn-lg btn-dark m-3 l14k"
                 data-href="{{ route('web.app.mandala.update.index') }}"><i class="fa fa-edit"></i> {{ __("Editar matriz") }}</button>
         @endif

         <ul class="nav nav-tabs" id="myTab" role="tablist">
             <li class="nav-item" role="presentation">
                 <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                     type="button" role="tab" aria-controls="home" aria-selected="true">{{ __("Recebedor") }}</button>
             </li>
             <li class="nav-item" role="presentation">
                 <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                     role="tab" aria-controls="profile" aria-selected="false">{{ __("Construtor") }}</button>
             </li>
             <li class="nav-item" role="presentation">
                 <button class="nav-link" id="doador-tab" data-bs-toggle="tab" data-bs-target="#doador" type="button"
                     role="tab" aria-controls="doador" aria-selected="false">{{ __("Doadores") }}</button>
             </li>
             <li class="nav-item" role="presentation">
                 <button class="nav-link" id="danation-tab" data-bs-toggle="tab" data-bs-target="#danation"
                     type="button" role="tab" aria-controls="danation" aria-selected="false">{{ __("Doacoes") }}</button>
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

                             <div class="card p-2 _link_" data-id="{{ $item->id }}" data-href="##">
                                <h1 class="text-center" style="  font-size: 80px; "><i class='fa fa-hand-holding-usd' alt="card image cap"></i></h1>
                                <div class="card-body p-0">
                                     <h5 class="card-title">
                                         <div class="flex-grow-1 ms-2">
                                             <h5 class="my-0 ">{{ $item->user_full_name }}</h5>
                                             <p class="mb-0 txt-muted">{{ $item->user_code }}</p>
                                         </div>
                                     </h5>
                                     <p class="card-text"></p>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>


             </div>
             <div class="tab-pane fade p-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                 <div class="row">
                     @foreach ($mandala_participant as $item)
                         @if ($item->type !== 'construtor')
                             @continue;
                         @endif
                         <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">

                             <div class="card p-2 shadow _link_" data-id="{{ $item->id }}" data-href="##">
                                <h1 class="text-center" style="  font-size: 80px; "><i class='fa fa-user-tie' alt="card image cap"></i></h1>
                                <div class="card-body p-0">
                                     <h5 class="card-title">
                                         <div class="flex-grow-1 ms-2">
                                             <h5 class="my-0">{{ $item->user_full_name }}</h5>
                                             <p class="mb-0 txt-muted">{{ $item->user_code }}</p>
                                         </div>
                                     </h5>
                                     <p class="card-text"></p>

                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>

             <div class="tab-pane fade p-4" id="doador" role="tabpanel" aria-labelledby="doador-tab">
                 <div class="row">
                     @foreach ($mandala_participant as $item)
                         @if ($item->type !== 'doador')
                             @continue;
                         @endif







                         <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">

                             <div class="card p-2 shadow"
                                 style="border: 4px solid {{ in_array($item->id, $paids) ? 'green' : 'red' }};">
                                 <h1 class="text-center" style="  font-size: 80px; "><i class='fa fa-users' alt="card image cap"></i></h1>
                                 <div class="card-body p-0">
                                     <h5 class="card-title">
                                         <div class="flex-grow-1 ms-2">
                                             <h5 class="my-0">{{ $item->user_full_name }}</h5>
                                             <p class="mb-0 txt-muted">{{ $item->user_code }}
                                             </p>
                                         </div>
                                     </h5>
                                     <p class="card-text"></p>
                                     @if (
                                         $item->user_id == Auth::user()->id and
                                             !in_array($item->id, $paids) and
                                             ($item->user_type == 'admin' or in_array($item->id, $unlockeds)))
                                         <a data-id="-1"
                                             data-payloads="{{ json_encode(['mandala_participant_id' => $item->id]) }}"
                                             data-href="{{ route('web.app.mandala.donate.add.index') }}"
                                             href="#" class="btn btn-dark btn-block btn-sm w-100 l14k prompt">{{ __("Carregar Doacao") }}</a>
                                     @endif


                                     @if (($item->user_id == Auth::user()->id) and !in_array($item->id, $unlocks) and !in_array($item->id, $unlockeds) and ($item->user_type !== 'admin'))
                                         <a data-id="-1"
                                             data-payloads="{{ json_encode(['mandala_participant_id' => $item->id]) }}"
                                             data-href="{{ route('web.app.mandala.unlock.add.index') }}"
                                             href="#" class="btn btn-dark btn-block btn-sm w-100 l14k prompt">{{ __("Carregar Doacao a Indicador") }}</a>
                                     @elseif(in_array($item->id, $unlocks) and $item->user_type !== 'admin')
                                        <h2 class="text-warning d-block">{{ __("Aguardando Confirmacao de Indicador") }}</h2>
                                     @endif



                                     @if (
                                         !in_array($item->id, $paids) and  ($beneficiary->user_id == Auth::user()->id or $item->user_inviter_id == Auth::user()->id))
                                         <a data-id="{{ $item->id }}"
                                             data-href="{{ route('web.app.mandala.participant.remove.do') }}"
                                             href="#" class="btn btn-danger btn-block btn-sm w-100 l14k prompt">{{ __("Remover Doador") }}</a>
                                     @endif
                                 </div>
                             </div>
                         </div>
                     @endforeach

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
                                            <h1 class="text-center" style="  font-size: 80px; "><i class='fa fa-donate' alt="card image cap"></i></h1>
                                            <p class="mb-0 txt-muted  text-center">{{ $item->user_code }}</p>
                                             <h5 class="mb-0 txt-muted text-center"> {{ $item->currency_symbol . format_number($item->amount ?? 0) }}</h5>
                                             <a data-payloads="{{ json_encode(['id' => $item->transaction_id]) }}"
                                                 data-id={{ $item->transaction_id }}
                                                 data-href="{{ route('web.app.transaction.detail.index') }}"
                                                 href="#"
                                                 class="btn btn-dark btn-block btn-sm w-100 l14k pt-2 pb-2">
                                                 {{ __("Ver Detalhes") }}
                                             </a>

                                         </div>
                                     </h5>
                                     <p class="card-text"></p>
                                     @if ($item->paid == false and $beneficiary->user_id == Auth::user()->id)
                                         <a data-id="-1"
                                             data-payloads="{{ json_encode(['mandala_donation_id' => $item->id]) }}"
                                             data-href="{{ route('web.app.mandala.donate.approvement.accept') }}"
                                             href="#" class="btn btn-success btn-block btn-sm w-100 l14k prompt"
                                             data-title="Aceitar Pagamento">{{ __("Aceitar") }}</a>
                                         <a data-id="-1"
                                             data-payloads="{{ json_encode(['mandala_donation_id' => $item->id]) }}"
                                             data-href="{{ route('web.app.mandala.donate.approvement.refuse') }}"
                                             href="#" class="btn btn-danger btn-block btn-sm w-100 l14k prompt"
                                             data-title="Recusar Pagamento">{{ __("Recusar") }}</a>
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
