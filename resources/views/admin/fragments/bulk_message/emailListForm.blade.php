<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.bulk_message.email.compose.index') }}" class="btn btn-primary mb-2 _link_"><i
                        class="fa fa-plus-circle me-2"></i> {{ __('Agregar Pais') }}</a>
            </div>
            <div class="col-sm-7">

            </div><!-- end col-->
        </div>

        <div class="table-responsive">
            <table class="table table_ table-centered w-100 dt-responsive nowrap" id="products-datatable">
                <thead class="table-light">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Nombre') }}</th>
                        <th>{{ __('Codigo') }}</th>
                        <th>{{ __('Empresa') }}</th>
                        <th>{{ __('Banco') }}</th>
                        <th>{{ __('Numero de Conta') }}</th>
                        <th>{{ __('Tipo de Conta') }}</th>
                        <th>{{ __('Moneda') }}</th>
                        <th>{{ __('Fecha/hora de registro') }}</th>
                        <th style="width: 85px;"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($bank_account ?? []), ($item = @$bank_account[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->code }} </td>
                            <td> {{ $item->company_name }} </td>
                            <td> {{ $item->bank_name }} </td>
                            <td> {{ $item->currency_name }} </td>
                            <td> {{ $item->bank_account_type_name }} </td>
                            <td> {{ $item->numero_conta }} </td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i></a>
                                <a data-href="{{ route('web.admin.finance.bank_account.update.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-primary btn-sm _link_"><i
                                        class="fa fa-edit"></i></a>
                                <a data-href="{{ route('web.admin.finance.bank_account.remove.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-primary btn-sm _link_ prompt"
                                    data-title="Eliminar Conteudo"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
