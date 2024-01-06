<div class="card">
    <div class="card-header">
        <div class="card-title"><h5>{!! __("conteudo") !!}<h5></div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.survey.survey.add.index') }}" data-id="-1"
                    class="btn btn-primary mb-2 _link_"><i class="mdi mdi-plus-circle me-2"></i>
                    {{ __('Agregar Examen') }}</a>
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">

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
                        <th>{{ __('Titulo') }}</th>
                        <th>{{ __('Idioma') }}</th>
                        <th>{{ __('Curso') }}</th>
                        <th>{{ __('Inicio') }}</th>
                        <th>{{ __('Termino') }}</th>
                        <th>{{ __('Data/Hora de Registo') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($survey ?? []), ($item = @$survey[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->language_name }} </td>
                            <td> {{ $item->course_name }} </td>
                            <td> {{ Flores\Tools::date_convert($item->start_date, 'd-m-Y') }} </td>
                            <td> {{ Flores\Tools::date_convert($item->end_date, 'd-m-Y') }} </td>
                            <td> {{ Flores\Tools::date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Op&ccedil;&otilde;es
                                    </button>
                                    <div class="dropdown-menu">
                                        <a data-href="{{ route('web.admin.survey.survey.print') }}"
                                            class="dropdown-item _link_" data-id='{{ $item->id }}'> <i
                                                class="fa fa-print"></i>Imprimir</a>
                                        <a data-href="{{ route('web.admin.survey.survey.question.add.index') }}"
                                            data-id='{{ $item->id }}' class="dropdown-item _link_"><i
                                                class="fa fa-question"></i>Agregar Pergunta</a>
                                        <a data-href="{{ route('web.admin.survey.survey.answer.add.index') }}"
                                            data-id='{{ $item->id }}' class="dropdown-item _link_"><i
                                                class="fa fa-reply"></i>Agregar Resposta</a>
                                        <a data-href="{{ route('web.admin.survey.survey.update.index') }}"
                                            data-id='{{ $item->id }}' class="dropdown-item _link_"><i
                                                class="fa fa-edit"></i>Editar</a>
                                        <a data-href="{{ route('web.admin.survey.survey.remove.do') }}"
                                            data-id='{{ $item->id }}' class="dropdown-item _link_ prompt"
                                            data-title="Remover sector"><i class="fa fa-trash"></i>Remover</a>
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
