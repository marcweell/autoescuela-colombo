<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.page.message.compose.index') }}" data-id="-1" class="btn btn-primary mb-2 _link_"><i
                                class="fa fa-envelope me-2"></i> {{ __('Compor Mensagem para Todos') }}</a>
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
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Assunto') }}</th>
                        <th>{{ __('Data/Hora de Registo') }}</th>
                        <th style="width: 85px;"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($message ?? []), ($item = @$message[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->email }} </td>
                            <td> {{ $item->subject }} </td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <a data-href="{{ route('web.admin.page.message.reply.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-secondary btn-sm _link_"><i
                                        class="fa fa-reply"></i></a>
                                        <a data-href="{{ route('web.admin.page.message.detail.index') }}"
                                            data-id='{{ $item->id }}' class="btn btn-secondary btn-sm _link_"><i
                                                class="fa fa-eye"></i></a>
                                <a data-href="{{ route('web.admin.page.message.remove.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-secondary btn-sm _link_ prompt"
                                    data-title="Remover Subscritor"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
