<div class="card">
    <div class="card-header">
        <div class="card-title"><h5>Depoimentos<h5></div>
    </div>
    <div class="card-body"> 
        <div class="table-responsive">
            <table class="table table_ table-centered w-100 dt-responsive">
                <thead class="">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Pontos') }}</th> 
                        <th>{{ __('Mensagem') }}</th>
                        <th>{{ __('Data/Hora de Registo') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($testimony ?? []), ($item = @$testimony[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->points }} </td> 
                            <td> {{ $item->message }} </td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action d-flex"> 
                                @if ($item->active == true)

                                <a data-payloads="{{ json_encode(['active'=>0]) }}"  data-href="{{ route('web.admin.testimony.update.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-danger  l14k mx-1"><i
                                        class="fa fa-times"></i> Privar</a>

                                @else
                                <a data-payloads="{{ json_encode(['active'=>1]) }}"  data-href="{{ route('web.admin.testimony.update.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-dark  l14k mx-1"><i
                                        class="fa fa-check"></i> Publicar</a>


                                    
                                @endif


                                <a data-href="{{ route('web.admin.testimony.remove.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-secondary  l14k prompt mx-1"
                                    data-title="Remover Depoimento"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
