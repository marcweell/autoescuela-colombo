<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h5>{!! __('Usuarios') !!}<h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.user.add.index') }}" data-id="-1"
                    class="btn btn-primary mb-2 _link_"><i class="mdi mdi-plus-circle me-2"></i>
                    {{ __('Agregar Usuario') }}</a>
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">

                </div>
            </div><!-- end col-->
        </div>

        <div class="table-responsive---">
            <table class="table table_ table-sm table-smtable-centered w-100 dt-responsive nowrap"
                id="products-datatable">
                <thead class="table-light">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Usuario') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Teléfono') }}</th>
                        <th>{{ __('Tipo') }}</th>
                        <th>{{ __('Fecha/hora de registro') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($user ?? []), ($item = @$user[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td>

                                <div class="d-flex">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src='{{ Flores\Tools::photo($item->photo) }}'
                                                class="rounded-circle avatar-xs" alt="friend">
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h5 class="my-0">{{ implode([$item->name, ' ', $item->last_name]) }}</h5>
                                            <p class="mb-0 txt-muted">{{ $item->code }}</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $item->email }}
                            </td>
                            <td> {{ "({$item->idd})" . $item->phone }}</td>
                            <td>
                                {{ $item->type }}
                            </td>
                            <td> {{ Flores\Tools::date_convert($item->created_at) }} </td>
                            <td class="table-action">

                                @if ($item->type == 'user' and $item->approved == false)

                                <a data-href="{{ route('web.admin.user.approve.do') }}"
                                data-id='{{ $item->id }}' class="btn btn-success _link_ prompt" data-title="Aprobar registro de alumno"><i
                                    class="fa fa-check"></i></a>
                                @endif


                                <a data-href="{{ route('web.admin.user.export.do') }}"
                                data-id='{{ $item->id }}' class="btn btn-primary _link_"><i
                                    class="fa fa-print"></i></a>
                                <a data-href="{{ route('web.admin.user.detail.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-primary _link_"><i
                                        class="fa fa-eye"></i></a>
                                <a data-href="{{ route('web.admin.user.update.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-primary _link_"><i
                                        class="fa fa-edit"></i></a>
                                <a data-href="{{ route('web.admin.user.remove.do') }}" data-id='{{ $item->id }}'
                                    class="btn btn-primary _link_ prompt" data-title="Eliminar usuario"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
