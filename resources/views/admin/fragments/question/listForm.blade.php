<div class="card">
    <div class="card-header">
        <div class="card-title"><h5>{!! __("conteudo") !!}<h5></div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.question.add.index') }}" data-id="-1" class="btn btn-primary  mb-2 _link_"><i
                        class="mdi mdi-plus-circle me-2"></i> {{ __('Agregar Preguntas') }}</a>
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">
                    <!--button type="button" class="btn btn-light mb-2 me-1">{{ __('Importar') }}</button>
                    <button type="button" class="btn btn-light mb-2">{{ __('Exportar') }}</button-->
                </div>
            </div><!-- end col-->
        </div>

        <div class="table-responsive---">
            <table class="table table_ table-centered w-100 dt-responsive-- nowrap">
                <thead class="table-light">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Titulo') }}</th>
                        <th>{{ __('Curso') }}</th>
                        <th>{{ __('Fecha/hora de registro') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($role ?? []), ($item = @$role[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $item->id }} </td>
                            <td> {{ $item->question }} </td>
                            <td> {{ $item->course_namej }} </td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <a data-href="{{ route('web.admin.question.update.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-primary  _link_"><i
                                        class="fa fa-edit"></i></a>
                                <a data-href="{{ route('web.admin.question.remove.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-primary  _link_ prompt"
                                    data-title="Eliminar Preguntas"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
