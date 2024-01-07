<div class="card">
    <div class="card-header">
        <div class="card-title"><h5>{!! __("conteudo") !!}<h5></div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.user.role.add.index') }}" data-id="-1" class="btn btn-primary  mb-2 _link_"><i
                        class="mdi mdi-plus-circle me-2"></i> {{ __('Agregar Grupo de Usuarios') }}</a>
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">
                    <!--button type="button" class="btn btn-light mb-2 me-1">{{ __('Importar') }}</button>
                    <button type="button" class="btn btn-light mb-2">{{ __('Exportar') }}</button-->
                </div>
            </div><!-- end col-->
        </div>

        <div class="table-responsive">
            <table class="table table_ table-centered w-100 dt-responsive-- nowrap">
                <thead class="table-light">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Nome') }}</th>
                        <th>{{ __('Codigo') }}</th>
                        <th>{{ __('Descricao') }}</th>
                        <th>{{ __('Fecha/hora de registro') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($role ?? []), ($item = @$role[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->code }}
                            </td>
                            <td> {{ $item->description }}
                            </td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <a  data-href="{{ route('web.admin.user.role.role_permission.index') }}"
                                data-id='{{ $item->id }}' class="btn btn-primary  _link_" class="btn btn-primary  _link_"> <i class="fa fa-shield-alt"></i></a>
                                <a data-href="{{ route('web.admin.user.role.update.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-primary  _link_"><i
                                        class="fa fa-edit"></i></a>
                                <a data-href="{{ route('web.admin.user.role.remove.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-primary  _link_ prompt"
                                    data-title="Eliminar Grupo de Usuarios"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
