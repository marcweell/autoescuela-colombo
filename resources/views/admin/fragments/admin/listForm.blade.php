<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h5>{!! __('Administradores') !!}<h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.admin.add.index') }}" data-id="-1"
                    class="btn btn-secondary  mb-2 l14k"><i class="fa fa-plus-circle me-2"></i>
                    {{ __('Adicionar Administrador') }}</a>
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
                        <th>{{ __('Administrador') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Telefone') }}</th>
                        <th>{{ __('Grupo') }}</th>
                        <th>{{ __('Data/Hora de Registo') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($admin ?? []), ($item = @$admin[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td>

                                <div class="d-flex">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src='{{ tools()->photo($item->profile_picture) }}'
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
                                {{ $item->role_name }}
                            </td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <div class="dropdown">
                                    <button class="btn btn-secondary  dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Op&ccedil;&otilde;es
                                    </button>
                                    <div class="dropdown-menu">
                                        <a data-href="{{ route('web.admin.admin.detail.index') }}"
                                            class="dropdown-item l14k" data-id='{{ $item->id }}'> <i
                                                class="fa fa-eye"></i>Detalhes</a>
                                        <a data-href="{{ route('web.admin.admin.update.index') }}"
                                            data-id='{{ $item->id }}' class="dropdown-item l14k"><i
                                                class="fa fa-edit"></i>Editar</a>
                                        <a data-href="{{ route('web.admin.admin.remove.do') }}"
                                            data-id='{{ $item->id }}' class="dropdown-item l14k prompt"
                                            data-title="Remover Administrador"><i class="fa fa-trash"></i>Remover</a>
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
