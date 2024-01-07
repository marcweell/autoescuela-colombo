<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.page.partner.add.index') }}" data-id="-1" class="btn btn-primary mb-2 _link_"><i
                        class="fa fa-plus-circle me-2"></i> {{ __('Agregar Parceiro') }}</a>
            </div>
            <div class="col-sm-7">

            </div><!-- end col-->
        </div>

        <div class="table-responsive---">
            <table class="table table_ table-centered w-100 dt-responsive nowrap" id="products-datatable">
                <thead class="table-light">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Nombre') }}</th>
                        <th>{{ __('Codigo') }}</th>
                        <th>{{ __('Fecha/hora de registro') }}</th>
                        <th style="width: 85px;"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($partner ?? []), ($item = @$partner[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->code }}
                            </td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i></a>
                                <a data-href="{{ route('web.admin.page.partner.update.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-primary btn-sm _link_"><i
                                        class="fa fa-edit"></i></a>
                                <a data-href="{{ route('web.admin.page.partner.remove.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-primary btn-sm _link_ prompt"
                                    data-title="Eliminar Parceiro"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
