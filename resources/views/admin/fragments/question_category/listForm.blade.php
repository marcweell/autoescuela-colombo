<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h5>{!! __('Categoría de pregunta') !!}<h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.question.category.add.index') }}" data-id="-1"
                    class="btn btn-secondary  mb-2 _link_"><i class="fa fa-plus-circle me-2"></i>
                    {{ __('Agregar Categoría de pregunta') }}</a>
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
                        <th>{{ __('Nombre') }}</th>
                        <th>{{ __('Color') }}</th>
                        <th>{{ __('Icona') }}</th>
                        <th>{{ __('Activo') }}</th>
                        <th>{{ __('Fecha/hora de registro') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($question_category ?? []), ($item = @$question_category[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td
                                style="{{ empty($item->icon_hex_color) ? '' : 'background: ' . $item->icon_hex_color . ';' }}">
                            </td>
                            <td>
                                <img height="30px" src="{{ tools()->file($item->icon_file) }}" alt="">
                            </td>
                            <td> {!! $item->active == true
                                ? '<i class="fa fa-check text-success"></i>'
                                : '<i class="fa fa-times text-danger"></i>' !!} </td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <a data-href="{{ route('web.admin.question.category.update.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-secondary btn-sm _link_"><i
                                        class="fa fa-edit"></i></a>
                                <a data-href="{{ route('web.admin.question.category.remove.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-secondary btn-sm _link_ prompt"
                                    data-title="Eliminar Categoría de pregunta"><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
