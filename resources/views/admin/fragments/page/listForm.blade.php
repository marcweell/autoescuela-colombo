
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h5>{!! __('Páginas') !!}<h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.page.add.index') }}" data-id="-1"
                    class="btn btn-secondary  mb-2 _link_"><i class="fa fa-plus-circle me-2"></i>
                    {{ __('Agregar página') }}</a>
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
                        <th>{{ __('Data/Hora de Registo') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($page ?? []), ($item = @$page[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <a data-href="{{ route('web.admin.page.update.index') }}"
                                    data-id='{{ $item->id }}' class="btn btn-secondary btn-sm _link_"><i
                                        class="fa fa-edit"></i></a>
                                <a data-href="{{ route('web.admin.page.remove.do') }}" data-id='{{ $item->id }}'
                                    class="btn btn-secondary btn-sm _link_ prompt" data-title="Eliminar página"><i
                                        class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->

