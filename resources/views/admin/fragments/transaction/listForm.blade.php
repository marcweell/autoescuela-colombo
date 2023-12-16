@php
    $cols = ['counter', 'user','code', 'amount',  'status', 'created_at', 'action'];
    $cols = json_encode($cols);
    $apiUrl = route('web.admin.finance.transaction.index');
    $dataKey = 'user';
@endphp
  


<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h5>{!! __('Transacoes') !!}<h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">

                </div>
            </div><!-- end col-->
        </div>

        <div class="table-responsive">
            <table class="table table_sourced table-centered w-100 dt-responsive"  data-method="POST" data-key="{{ $dataKey }}" data-url="{{ $apiUrl }}" data-cols="{{ $cols }}">
                <thead class="">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Usuario') }}</th>
                        <th>{{ __('Codigo') }}</th>
                        <th>{{ __('Montante') }}</th>
                        <th>{{ __('Estado') }}</th>
                        <th>{{ __('Data/Hora') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($transaction ?? []), ($item = @$transaction[$i]); $i++, $n++)
                        <tr>

                            <td> {{ $n }} </td>
                            <td>
                                <div class="d-flex">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src='{{ tools()->photo($item->user_profile_picture) }}'
                                                class="rounded-circle avatar-xs" alt="friend">
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h5 class="my-0">{{ $item->user_full_name }}</h5>
                                            <p class="mb-0 txt-muted">{{ $item->user_code }}</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td> {{ $item->code }} </td>
                            <td> {{ $item->currency_symbol . format_number($item->amount ?? 0) }} </td>
                            <td> {!! $item->status == 'completed'
                                ? '<span class="badge text-light bg-success text-light">' . $item->status . '</span>'
                                : '<span class="badge text-light bg-warning text-light">' . $item->status . '</span>' !!} </td>
                            <td> {{ tools()->date_convert($item->created_at, 'd-m-y') }} </td>
                            <td class="table-action">

                                <a data-href="{{ route('web.admin.finance.transaction.detail.index') }}"
                                    class="btn btn-secondary l14k" data-id='{{ $item->id }}'> <i
                                        class="fa fa-eye"></i></a>
                                <a data-href="{{ route('web.admin.finance.transaction.remove.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-secondary l14k prompt"
                                    data-title="Remover Transacao"><i class="fa fa-trash"></i></a>
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

                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
