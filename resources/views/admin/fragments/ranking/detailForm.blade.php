<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('RANKING') }}</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <ul>
                    <li><h2>{{ $ranking->name }}</h2></li>
                    <li><h5>Inicio: {{ tools()->date_convert($ranking->start_date,'d-m-Y') }}</h5></li>
                    <li><h5>Termino: {{ tools()->date_convert($ranking->end_date,'d-m-Y') }}</h5></li>
                </ul> 
            </div>
            <div class="col-md-6 mb-3">
                
            </div>
            <div class="col-md-12 mb-3">
                {!! $ranking->description !!}
            </div>


            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table_ table-centered w-100 dt-responsive">
                        <thead class="">
                            <tr>
                                <th style="width: 20px;">
                                    #
                                </th>
                                <th>{{ __('Usuario') }}</th>
                                <th>{{ __('Pontuacao Total') }}</th>
                                <th>{{ __('Maior cadastro de pessoas diretas') }}</th>
                                <th>{{ __('Mais pessoas da sua equipe completando ciclos e avançando níveis') }}</th>
                                <th>{{ __('Ciclou primeiro nas Fases') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0, $n = 1; $i < count($ranking_user ?? []), ($item = @$ranking_user[$i]); $i++, $n++)
                                <tr>
                                    <td> {{ $n }} </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src='{{ tools()->photo($item->user_profile_picture) }}'
                                                        class="rounded-circle avatar-xs" alt="friend">
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h5 class="my-0">{{ $item->user_full_name }}</h5>
                                                    <p class="mb-0 txt-muted">{{ $item->user_code }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td> {{ $item->punctuation }} </td>
                                    <td> {{ $item->punctuation_critaria_refering }} </td>
                                    <td> {{ $item->punctuation_critaria_more_circle_level }} </td>
                                    <td> {{ $item->punctuation_critaria_first_circle_level }} </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div> <!-- end card-body -->
</div>