<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.page.services.add.index') }}" data-id="-1" class="btn btn-primary mb-2 _link_"><i
                        class="fa fa-plus-circle me-2"></i> {{ __('Agregar Servicios') }}</a>
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
                        <th>{{ __('Icone') }}</th>
                        <th>{{ __('Data/Hora de Registo') }}</th>
                        <th style="width: 85px;"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($services ?? []), ($item = @$services[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->name }} </td>
                            <td><i class="{{ $item->icon }}"></i></td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <a data-href="{{ route('web.admin.page.services.update.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-secondary btn-sm _link_"><i
                                        class="fa fa-edit"></i></a>
                                <a data-href="{{ route('web.admin.page.services.remove.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-secondary btn-sm _link_ prompt"
                                    data-title="Remover Servicios"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
