<div class="card">
    <div class="card-header">
        <div class="card-title"><h5>{!! __("conteudo") !!}<h5></div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">
                    <button type="button" class="btn btn-light mb-2">{{ __('Exportar') }}</button>
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
                        <th>{{ __('Usuario') }}</th>
                        <th>{{ __('IP') }}</th>
                        <th>{{ __('Navegador') }}</th>
                        <th>{{ __('Dispositivo') }}</th>
                        <th>{{ __('User Agent') }}</th>
                        <th>{{ __('Éxito') }}</th>
                        <th>{{ __('Fecha/hora de registro') }}</th>
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($session_history ?? []), ($item = @$session_history[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td>
                                <div class="d-flex">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src='{{ Flores\Tools::photo($item->user_photo) }}' class="rounded-circle avatar-xs"
                                                alt="friend">
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h5 class="my-0">{{ $item->user_full_name }}</h5>
                                            <p class="mb-0 txt-muted">{{ $item->user_code }}</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td> {{ $item->ip }}</td>
                            <td> {{ $item->browser }}</td>
                            <td> {{ $item->device }}</td>
                            <td> {{ $item->user_agent }}</td>
                            <td> {!! ($item->success)?"<i class='fa fa-check text-success'></i>":"<i class='fa fa-times text-danger'></i>" !!}</td>
                            <td> {{ Flores\Tools::date_convert($item->created_at) }} </td>
                            <td class="table-action">
                                <a href="javascript:void(0);" class="btn btn-primary"> <i class="fa fa-eye"></i></a>
                                <a data-href="{{ route('web.admin.auditory.session_history.remove.do') }}" data-id='{{ $item->id }}' class="btn btn-primary _link_ prompt" data-title="Remover Pais"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
