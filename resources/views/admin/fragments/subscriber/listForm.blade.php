<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.subscriber.add.index') }}" data-id="-1" class="btn btn-secondary mb-2 l14k"><i
                        class="fa fa-plus-circle me-2"></i> {{ __('Adicionar Subscritor') }}</a>
                <a data-href="{{ route('web.admin.bulk_message.email.compose.index') }}" data-id="-1" class="btn btn-secondary mb-2 l14k"><i
                                class="fa fa-envelope me-2"></i> {{ __('Compor Mensagem') }}</a>
            </div>
            <div class="col-sm-7">
                
            </div><!-- end col-->
        </div>

        <div class="table-responsive">
            <table class="table table_ table-centered w-100 dt-responsive">
                <thead class="">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Email') }}</th> 
                        <th>{{ __('Data/Hora de Registo') }}</th>
                        <th style="width: 85px;"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($subscriber ?? []), ($item = @$subscriber[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->email }} </td> 
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <a data-href="{{ route('web.admin.subscriber.update.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-secondary btn-sm l14k"><i
                                        class="fa fa-edit"></i></a>
                                <a data-href="{{ route('web.admin.subscriber.remove.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-secondary btn-sm l14k prompt"
                                    data-title="Remover Subscritor"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
