<div class="card">
    <div class="card-header">
        <div class="card-title w-100">
            <h5>{{ __("Indicados") }}
            <hr class="d-block d-md-none">
            <div class="float-end">
                <span class="text-muted">{{ __("Indicados ativos") }}: {{ $qualif->ativos }} - </span>{!! $qualif->qualificado == true ?"<span class='badge bg-success text-white'>QUALIFICADO</span>":"<span class='badge bg-danger text-white'>NAO QUALIFICADO</span>" !!}
            </div>
        </h5>
        </div>
    </div>

    

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table_ table-centered w-100 dt-responsive">
                <thead class="">
                    <tr>
                        <th style="width: 20px;">
                            #
                        </th>
                        <th>{{ __('Usuario') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Ativo') }}</th>
                        <th>{{ __('Data/Hora') }}</th>
                        <th><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($invited_user ?? []), ($item = @$invited_user[$i]); $i++, $n++)
                        <tr>
                            <td> {{ $n }} </td>
                            <td>
                                <div class="d-flex">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 ms-2">
                                            <h5 class="my-0">{{ $item->full_name }}</h5>
                                            <p class="mb-0 txt-muted">{{ $item->code }}</p>
                                        </div>
                                    </div>
                            </td>
                            <td> {{ $item->email }}
                            </td> 
                            <td>{!! isLegal($item->id)?"<i class='fa fa-check'></i>":"<i class='fa fa-times'></i>" !!}</td>
                            <td> {{ tools()->date_convert($item->created_at) }} </td>
                            <td>
                                @if (!empty($item->social_media))
                                <a href="https://wa.me/{{ $item->social_media->profile_id }}" class="btn btn-success"><i
                                    class="fa fa-paper-plane"></i> {{ __("Mandar Mensagem") }}</a>
                                @endif
                            
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
