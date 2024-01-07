<div class="card">
    <div class="card-header">
        <div class="card-title"><h5>Cursos<h5></div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.course.add.index') }}" data-id="-1" class="btn btn-primary mb-2 _link_"><i
                        class="mdi mdi-plus-circle me-2"></i> {{ __('Agregar Curso') }}</a>
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">

                </div>
            </div><!-- end col-->
        </div>

        <div class="table-responsive">
            <table class="table table_ table-sm table-centered w-100 dt-responsive nowrap" data-method="post">
                <thead class="table-light">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Nombre') }}</th>
                        <th>{{ __('Codigo') }}</th>
                        <th>{{ __('Fecha/hora de registro') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($course ?? []), ($item = @$course[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->code }}</td>
                            <td> {{ Flores\Tools::date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Op&ccedil;&otilde;es
                                    </button>
                                    <div class="dropdown-menu">
                                        <a data-href="{{route('web.admin.course.detail.index')}}" class="dropdown-item _link_" data-id='{{ $item->id }}' > <i
                                                class="fa fa-eye"></i>Detalhes</a>
                                        <a data-href="{{ route('web.admin.course.update.index') }}"  data-id='{{ $item->id }}' class="dropdown-item _link_"><i
                                                class="fa fa-edit"></i>Editar</a>
                                        <a data-href="{{ route('web.admin.course.remove.do') }}"
                                            data-id='{{ $item->id }}' class="dropdown-item _link_ prompt"
                                            data-title="Eliminar sector"><i class="fa fa-trash"></i>Eliminar</a>
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
