<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h5>{!! __('Menús de página') !!}<h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.page.site_menu.add.index') }}" data-id="-1"
                    class="btn btn-primary mb-2 _link_"><i class="mdi mdi-plus-circle me-2"></i>
                    {{ __('Agregar Menu') }}</a>
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">
                    <button type="button" class="btn btn-light mb-2 me-1">{{ __('Importar') }}</button>
                    <button type="button" class="btn btn-light mb-2">{{ __('Exportar') }}</button>
                </div>
            </div><!-- end col-->
        </div>

        <div class="table-responsive--">
            <table class="table table_ table-sm table-smtable-centered w-100 dt-responsive nowrap"
                id="products-datatable">
                <thead class="table-light">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Nombre') }}</th>
                        <th>{{ __('Icone') }}</th>
                        <th>{{ __('URI') }}</th>
                        <th>{{ __('Rota') }}</th>
                        <th>{{ __('Preferir') }}</th>
                        <th>{{ __('Fecha/hora de registro') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($site_menu ?? []), ($item = @$site_menu[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->name }} </td>
                            <td> <i class="{{ $item->icon_class }} pe-2"></i> {{ $item->icon_class }} </td>
                            <td> {{ $item->uri }} </td>
                            <td> {{ $item->route }} </td>
                            <td> {{ $item->prefer }} </td>
                            <td> {{ Flores\Tools::date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <div class="d-inline-flex">
                                    <a data-href="{{ route('web.admin.page.site_menu.update.index') }}"
                                        data-id='{{ $item->id }}' class="btn btn-primary _link_ mx-1"><i
                                            class="fa fa-edit"></i></a>
                                    <a data-href="{{ route('web.admin.page.site_menu.remove.do') }}"
                                        data-id='{{ $item->id }}' class="btn btn-primary _link_ prompt mx-1"
                                        data-title="Remover Menu"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
