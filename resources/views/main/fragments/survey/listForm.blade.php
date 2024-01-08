<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h5>{!! __('conteudo') !!}<h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">

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
                        <th>{{ __('Titulo') }}</th>
                        <th>{{ __('Inicio') }}</th>
                        <th>{{ __('Termino') }}</th>
                        <th>{{ __('Fecha/hora de registro') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($survey ?? []), ($item = @$survey[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ Flores\Tools::date_convert($item->start_date, 'd-m-Y') }} </td>
                            <td> {{ Flores\Tools::date_convert($item->end_date, 'd-m-Y') }} </td>
                            <td> {{ Flores\Tools::date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <a data-href="{{ route('web.app.survey.survey.print') }}"
                                    class="btn btn-primary  _link_" data-id='{{ $item->id }}'> <i
                                        class="fa fa-print"></i>Imprimir</a>
                                <a data-href="{{ route('web.app.survey.survey.answer.add.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-warning _link_"><i
                                        class="fa fa-reply"></i>Agregar Respuesta</a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
