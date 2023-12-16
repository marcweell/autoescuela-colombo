<div class="card">

    <div class="card-header">
        <div class="card-title">
            <h5>{!! __('Transacoes') !!}<h5>
        </div>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Doações recebidas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Doações feitas</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade p-4" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table_ table-centered w-100 dt-responsive">
                                <thead class="">
                                    <tr>
                                        <th style="width: 20px;" class="d-none d-md-table-cell">
                                            #
                                        </th> 
                                        <th>{{ __('Montante') }}</th>
                                        <th class="d-none d-md-table-cell">{{ __('Data de Pagamento') }}</th>
                                        <th class="d-none d-md-table-cell">{{ __('Estado') }}</th>
                                        <th class="d-none d-md-table-cell">{{ __('Data/Hora de Registo') }}</th>
                                        <th><i class='fa fa-cog'></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0, $n = 1; $i < count($transaction ?? []), ($item = @$transaction[$i]); $i++, $n++)
                                        @if ($item->type !== 'debt')
                                            @continue
                                        @endif


                                        <tr>

                                            <td class="d-none d-md-table-cell"> {{ $n }} </td> 
                                            <td> {{ $item->currency_symbol . format_number($item->amount ?? 0) }} ({{ convertCoin($item->currency_code,"USD",$item->amount,"USD") }})</td>
                                            <td class="d-none d-md-table-cell"> {{ tools()->date_convert($item->payment_date, 'd/m/Y') }} </td>
                                            <td class="d-none d-md-table-cell"> {!! $item->status == 'completed'
                                                ? '<span class="badge text-light bg-success text-light">' . $item->status . '</span>'
                                                : '<span class="badge text-light bg-warning text-light">' . $item->status . '</span>' !!} </td>
                                            <td class="d-none d-md-table-cell"> {{ tools()->date_convert($item->created_at) }} </td>
                                            <td class="table-action">

                                                <a data-href="{{ route('web.app.transaction.detail.index') }}"
                                                    class="btn btn-dark l14k" data-id='{{ $item->id }}'> <i
                                                        class="fa fa-eye"></i></a>
                                                @if (!empty($item->mandala_donate_id) and $item->type == 'credit' and $item->status == 'unclaimed')
                                                    <a data-id="-1"
                                                        data-payloads="{{ json_encode(['mandala_donation_id' => $item->mandala_donate_id]) }}"
                                                        data-href="{{ route('web.app.mandala.donate.approvement.accept') }}"
                                                        href="#" class="btn btn-success l14k prompt"
                                                        data-title="Aceitar Pagamento"><i class="fa fa-check"></i></a>
                                                    <a data-id="-1"
                                                        data-payloads="{{ json_encode(['mandala_donation_id' => $item->mandala_donate_id]) }}"
                                                        data-href="{{ route('web.app.mandala.donate.approvement.refuse') }}"
                                                        href="#" class="btn btn-danger l14k prompt"
                                                        data-title="Recusar Pagamento"><i class="fa fa-times"></i></a>
                                                @endif

                                                @if (!empty($item->mandala_unlock_id) and $item->type == 'credit' and $item->status == 'unclaimed')
                                                    <a data-id="-1"
                                                        data-payloads="{{ json_encode(['mandala_unlock_id' => $item->mandala_unlock_id]) }}"
                                                        data-href="{{ route('web.app.mandala.unlock.approvement.accept') }}"
                                                        href="#" class="btn btn-success l14k prompt"
                                                        data-title="Aceitar Pagamento"><i class="fa fa-check"></i></a>
                                                    <a data-id="-1"
                                                        data-payloads="{{ json_encode(['mandala_unlock_id' => $item->mandala_unlock_id]) }}"
                                                        data-href="{{ route('web.app.mandala.donate.approvement.refuse') }}"
                                                        href="#" class="btn btn-danger l14k prompt"
                                                        data-title="Recusar Pagamento"><i class="fa fa-times"></i></a>
                                                @endif


                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade p-4 show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
<div class="col-12">


    <div class="table-responsive">
        <table class="table table_ table-centered w-100 dt-responsive">
            <thead class="">
                <tr>
                    <th style="width: 20px;" class="d-none d-md-table-cell">
                        #
                    </th> 
                    <th>{{ __('Montante') }}</th>
                    <th class="d-none d-md-table-cell">{{ __('Data de Pagamento') }}</th>
                    <th class="d-none d-md-table-cell">{{ __('Estado') }}</th>
                    <th class="d-none d-md-table-cell">{{ __('Data/Hora de Registo') }}</th>
                    <th><i class='fa fa-cog'></i></th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0, $n = 1; $i < count($transaction ?? []), ($item = @$transaction[$i]); $i++, $n++)
                    @if ($item->type !== 'credit')
                        @continue
                    @endif


                    <tr>

                        <td class="d-none d-md-table-cell"> {{ $n }} </td> 
                        <td> {{ $item->currency_symbol . format_number($item->amount ?? 0) }}  ({{ convertCoin($item->currency_code,"USD",$item->amount,"USD") }})</td>
                        <td class="d-none d-md-table-cell"> {{ tools()->date_convert($item->payment_date, 'd/m/Y') }} </td>
                        <td class="d-none d-md-table-cell"> {!! $item->status == 'completed'
                            ? '<span class="badge text-light bg-success text-light">' . $item->status . '</span>'
                            : '<span class="badge text-light bg-warning text-light">' . $item->status . '</span>' !!} </td>
                        <td class="d-none d-md-table-cell"> {{ tools()->date_convert($item->created_at) }} </td>
                        <td class="table-action">

                            <a data-href="{{ route('web.app.transaction.detail.index') }}"
                                class="btn btn-dark l14k" data-id='{{ $item->id }}'> <i
                                    class="fa fa-eye"></i></a>
                            @if (!empty($item->mandala_donate_id) and $item->type == 'credit' and $item->status == 'unclaimed')
                                <a data-id="-1"
                                    data-payloads="{{ json_encode(['mandala_donation_id' => $item->mandala_donate_id]) }}"
                                    data-href="{{ route('web.app.mandala.donate.approvement.accept') }}"
                                    href="#" class="btn btn-success l14k prompt"
                                    data-title="Aceitar Pagamento"><i class="fa fa-check"></i></a>
                                <a data-id="-1"
                                    data-payloads="{{ json_encode(['mandala_donation_id' => $item->mandala_donate_id]) }}"
                                    data-href="{{ route('web.app.mandala.donate.approvement.refuse') }}"
                                    href="#" class="btn btn-danger l14k prompt"
                                    data-title="Recusar Pagamento"><i class="fa fa-times"></i></a>
                            @endif

                            @if (!empty($item->mandala_unlock_id) and $item->type == 'credit' and $item->status == 'unclaimed')
                                <a data-id="-1"
                                    data-payloads="{{ json_encode(['mandala_unlock_id' => $item->mandala_unlock_id]) }}"
                                    data-href="{{ route('web.app.mandala.unlock.approvement.accept') }}"
                                    href="#" class="btn btn-success l14k prompt"
                                    data-title="Aceitar Pagamento"><i class="fa fa-check"></i></a>
                                <a data-id="-1"
                                    data-payloads="{{ json_encode(['mandala_unlock_id' => $item->mandala_unlock_id]) }}"
                                    data-href="{{ route('web.app.mandala.unlock.approvement.refuse') }}"
                                    href="#" class="btn btn-danger l14k prompt"
                                    data-title="Recusar Pagamento"><i class="fa fa-times"></i></a>
                            @endif


                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>





</div>
                </div>
            </div>




        </div>








        </form>

    </div> <!-- end card-body -->
</div>
