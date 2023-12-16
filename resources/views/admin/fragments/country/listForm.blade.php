<div class="card">
    <div class="card-header">
        <div class="card-title"><h5>{!! __("Paises") !!}<h5></div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.settings.geo.country.add.index') }}" data-id="-1" class="btn btn-secondary  mb-2 l14k"><i
                        class="fa fa-plus-circle me-2"></i> {{ __('Adicionar Pais') }}</a>
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">
                    
                </div>
            </div><!-- end col-->
        </div>

        <div class="table-responsive">
            <table class="table table_ table-centered w-100 dt-responsive">
                <thead class="">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Nome') }}</th>
                        <th>{{ __('Nome nativo') }}</th>
                        <th>{{ __('Codigo') }}</th>
                        <th>{{ __('Data/Hora de Registo') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($country ?? []), ($item = @$country[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->name }} </td>
                            <td> {!! $item->native_name !!} </td>
                            <td> {{ $item->code }}
                            </td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <div class="dropdown">
                                    <button class="btn btn-secondary  dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Op&ccedil;&otilde;es
                                    </button>
                                    <div class="dropdown-menu">
                                        <a data-href="{{ route('web.admin.settings.geo.country.update.index') }}"
                                            data-id='{{ $item->id }}' class="dropdown-item l14k"><i
                                                class="fa fa-edit"></i>Editar</a>
                                        <a data-href="{{ route('web.admin.settings.geo.country.remove.do') }}"
                                            data-id='{{ $item->id }}' class="dropdown-item l14k prompt"
                                            data-title="Remover"><i class="fa fa-trash"></i>Remover</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
