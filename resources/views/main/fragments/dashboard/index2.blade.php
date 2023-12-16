<div
    style="background-repeat: no-repeat;min-height: 80vh;background-image:url('{{ url('public/assets/img/dashboard.png') }}');background-size: contain;padding: 0 !important;background-position-y: center;background-position-x: center;">
    <div class="row">

        @if (isDate($deadline->expires))
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center text-white"
                        style="background: linear-gradient(45deg, var(--bs-danger), #5b1515);font-weight: 600;">
                        Restam <span id="deadline_hour">0</span> horas, <span id="deadline_minute">0</span> minutos e
                        <span id="deadline_second">0</span> segundos<br>
                        Faça reentrada nas fases anteriores para que sua conta não seja desqualificada! 
                        <div class="d-block">
                            <h2 class="text-center text-white">Integre-se nas seguintes fases:</h2>
                            <ul class="d-inline-flex text-center">
                                @foreach ($deadline->inactives as $item)
                                    
                                <li>
                                    <img src="{{ tools()->photo($item->icon) }}" class="bg-white shadow border rounded-circle mx-1 p-2" width="60px">
                                </li> 

                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        @endif

        @if (isDate($advance->expires))
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center text-white"
                        style="background: linear-gradient(45deg, var(--bs-danger), #5b1515);font-weight: 600;">
                        Restam <span id="advance_hour">0</span> horas, <span id="advance_minute">0</span> minutos e
                        <span id="advance_second">0</span> segundos<br>
                        Avance para o plano {{ $advance->plan->name }} para que sua conta não seja desqualificada! 
                 
                    </div>
                    
                </div>
            </div>
        @endif


        <div class="col-12">
            <img data-src="{{ url('public/assets/images/Banner topo - Meu Painel logo original.png') }}" alt=""
                class="w-100 lazy">
        </div>


        <div class="col-12">
            <h4 class="mt-4">Tenha uma visão geral do seu progresso!</h4>
        </div>
        <div class="col-lg-8">

            <div class="row">

                <div class="col-lg-6">

                    <a data-href="{{ route('web.app.mandala.invite.index') }}" class="l14k">



                        <div class="stat-widget d-flex align-items-center">
                            <div class="widget-content">
                                <p>{{ __('Indicados Diretos') }}</p>
                                <h3>{{ count($indicados ?? []) }}</h3>
                            </div>
                            <div class="widget-arrow">
                                <h1 class="text-warning mb-0"><span><i class="fa fa-user-plus"></i></span>
                                </h1>
                            </div>
                        </div>

                    </a>

                </div>

                <div class="col-lg-6">

                    <div class="stat-widget d-flex align-items-center">
                        <div class="widget-content">
                            <p>{{ __('Total na rede') }}</p>
                            <h3>{{ $total_indicados }}</h3>
                        </div>
                        <div class="widget-arrow">
                            <h1 class="text-warning mb-0"><span><i class="fa fa-users"></i></span>
                            </h1>
                        </div>
                    </div>

                </div>


                <div class="col-lg-12">


                    <div class="row">

                        <div class="col-lg-4">
                            <div class="row">


                                <div class="col-12">
                                    <div class="card border-radius-30">
                                        <div class="card-body">
                                            <p class="d-block">{{ __('Fases Ativas') }}</p>
                                            <ul>
                                                @foreach ($mandala as $item)
                                                    @if (!empty($item->mandala_id))
                                                        <li class="d-inline-block">
                                                            <a data-href="{{ route('web.app.mandala.participant.manage.tree.index') }}"
                                                                data-id='{{ $item->mandala_id }}' class="m-1 l14k">
                                                                <img style="height: auto;width:50px"
                                                                    src="{{ tools()->photo($item->plan_icon) }}"
                                                                    alt="">
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li class="d-inline-block">
                                                            <a href="#" class="m-1 l14k">
                                                                <img style="height: auto;width:50px"
                                                                    src="{{ tools()->photo($item->icon) }}"
                                                                    class="bw">
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="card">
                                <div class="slider">
                                    <div>


                                        <div class="card-body bg-dark" style="max-height: 275px;overflow-y: auto;">
                                            <h4 class="text-center text-white mb-4 pb-5">{{ __('Ganhos Totais') }}</h4>
                                            <h3 class="text-center text-success">{{ 'R$ ' . tools()->num($ganhos) }}
                                            </h3>
                                            <h1 class="text-center text-success"><i class="fa fa-coins"></i></h1>
                                        </div>

                                    </div>
                                    <div>
                                        <div class="card-body" style="max-height: 275px;overflow-y: auto;">
                                            <h4 class="header-title">Ciclos Completados</h4>
                                            <table class="table table-sm table-hover">

                                                @foreach ($mandala_ as $item)
                                                    <tr>
                                                        <td width='10%' class=""><img
                                                                class="p-0 m-0"style="height: auto;width:20px"
                                                                src="{{ tools()->photo($item->icon) }}" alt="">
                                                        </td>
                                                        <td width='70%'>
                                                            <h5> {{ $item->name }}</h5>
                                                        </td>
                                                        <td class="text-warning">{{ $item->cicle }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>


                                    </div>
                                </div>


                            </div>
                        </div>





                        <div class="col-lg-4">
                            <div class="row">

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">


                                            @if (Auth::user()->type == 'admin' || empty($donate) == false || Auth::user()->level > 1)
                                                <label for="name"
                                                    class="form-label">{{ __('Link de referencia') }}</label>
                                                <div class="input-group">
                                                    <input value="{{ $link }}" class="form-control">
                                                    <div class="input-group-append">
                                                        <button id="copyl" role="button"
                                                            data-content="{{ $link }}" class="btn btn-dark"
                                                            type="button"><i class="fa fa-copy"></i></button>
                                                    </div>
                                                </div>
                                            @endif

                                        </div> <!-- end card-body -->
                                    </div>


                                </div>


                            </div>
                        </div>








                    </div>
















                </div>


            </div>





        </div>





        <div class="col-lg-4">
            <div class="row">

                <div class="col-xl-12">
                    <div class="card border-radius-30">
                        <div class="card-header pb-0 mb-0">
                            <h4>RANKING</h4>
                        </div>

                        <div class="card-body">

                            @if (empty($ranking_user))
                                <div class="alert alert-warning rounded-0">
                                    <h6>Nenhum ranking foi encontrado!</h6>
                                </div>
                            @endif


                            <div class="table-responsive--">

                                @if (!empty($ranking_user))
                                    <style>
                                        .podium__item {}

                                        .podium__rank {
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            font-size: 35px;
                                            color: #fff;
                                            -webkit-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
                                            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;

                                        }

                                        .podium__city {
                                            text-align: center;
                                            padding: 0 .5rem;
                                        }

                                        .podium__number {
                                            width: 27px;
                                            height: 75px;
                                        }

                                        .podium .first {
                                            min-height: 150px;
                                            background: rgb(255, 172, 37);
                                            background:
                                                linear-gradient(333deg,
                                                    rgba(255, 172, 37, 1) 0%,
                                                    rgba(254, 207, 51, 1) 13%,
                                                    rgba(254, 224, 51, 1) 53%,
                                                    rgba(255, 172, 37, 1) 100%);
                                        }

                                        .podium .second {
                                            min-height: 100px;
                                            background: #a2a2ac;
                                            background: linear-gradient(333deg, rgb(217 209 198) 0%, rgb(231 225 215) 13%, rgb(217 209 198) 53%, rgb(154 146 133) 100%);
                                        }

                                        .podium .third {
                                            min-height: 50px;
                                            background: #c27d16;
                                            background: linear-gradient(333deg, rgb(226 165 66) 0%, rgb(188 125 32) 13%, rgb(194 125 22) 53%, rgba(255, 172, 37, 1) 100%);
                                        }
                                    </style>

                                    <div class="podium row d-flex align-items-end">
                                        <div class="podium__item col-4">
                                            <p class="podium__city text-center ">
                                                <img data-src='{{ tools()->photo(isset($ranking_user[1]) ? $ranking_user[1]->user_profile_picture : '#') }}'
                                                    class="rounded-circle avatar-xs shadow lazy" alt="friend">
                                            <h6 class="d-block text-center">
                                                {{ isset($ranking_user[1]) ? $ranking_user[1]->user_code : '' }}</h6>
                                            </p>
                                            <div class="podium__rank second">2</div>
                                        </div>
                                        <div class="podium__item col-4">
                                            <p class="podium__city text-center ">
                                                <img data-src='{{ tools()->photo(isset($ranking_user[0]) ? $ranking_user[0]->user_profile_picture : '#') }}'
                                                    class="rounded-circle avatar-xs shadow lazy" alt="friend">
                                            <h6 class="d-block text-center">
                                                {{ isset($ranking_user[0]) ? $ranking_user[0]->user_code : '' }}</h6>
                                            </p>
                                            <div class="podium__rank first">
                                                <svg class="podium__number" viewBox="0 0 27.476 75.03"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g transform="matrix(1, 0, 0, 1, 214.957736, -43.117417)">
                                                        <path class="st8"
                                                            d="M -198.928 43.419 C -200.528 47.919 -203.528 51.819 -207.828 55.219 C -210.528 57.319 -213.028 58.819 -215.428 60.019 L -215.428 72.819 C -210.328 70.619 -205.628 67.819 -201.628 64.119 L -201.628 117.219 L -187.528 117.219 L -187.528 43.419 L -198.928 43.419 L -198.928 43.419 Z"
                                                            style="fill: #000;" />
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="podium__item col-4">
                                            <p class="podium__city text-center ">
                                                <img data-src='{{ tools()->photo(isset($ranking_user[2]) ? $ranking_user[2]->user_profile_picture : '#') }}'
                                                    class="rounded-circle avatar-xs shadow lazy" alt="friend">
                                            <h6 class="d-block text-center">
                                                {{ isset($ranking_user[2]) ? $ranking_user[2]->user_code : '' }}</h6>
                                            </p>
                                            <div class="podium__rank third">3</div>
                                        </div>
                                    </div>
                                @endif

                                <table class="table table-md w-100">
                                    <tbody>
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <button data-href="{{ route('web.app.ranking.index') }}"
                                                    class="btn btn-primary border-radius-30 l14k">Acessar ranking
                                                    completo</button>
                                            </td>
                                        </tr>
                                        @php
                                            $n = 2;
                                        @endphp

                                        @foreach ([] as $i => $item)
                                            @if ($i < 3)
                                                @continue;
                                            @endif
                                            @php
                                                $n++;
                                            @endphp
                                            <tr class="border-bottom">
                                                <td>{{ $n }} </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img src='{{ tools()->photo($item->user_profile_picture) }}'
                                                                    class="rounded-circle avatar-xs" alt="friend">
                                                            </div>
                                                            <div class="flex-grow-1 ms-2">
                                                                <p class="mb-0 txt-muted">{{ $item->user_code }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> {{ $item->punctuation }} (Pontos)</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>








                        </div>
                    </div>
                </div>

            </div>
        </div>





    </div>


</div>


<script>
    $("#copyl").click(function() {
        let text = this.getAttribute("data-content");


        navigator.clipboard.writeText(text)
            .then(function() {
                output.notify('{{ __('Link Copiado para area de transferencia') }}');
            })
            .catch(function(err) {
                output.notify(err.getMessage());
            });
    });


    $(".slider").slick({
        // normal options...
        infinite: true,
        slidesToShow: 1,
        dots: true,
    });
</script>

@if (isDate($deadline->expires))
    @php
        $timezone = new DateTimeZone('America/Sao_Paulo');
        $datetimeSaoPaulo = new DateTime($deadline->expires, $timezone);

    @endphp


    <script>
        function converterhourParaminutes(offsetinhour) {
            return offsetinhour * 60;
        }
        var expires = new Date("{{ $datetimeSaoPaulo->format('Y-m-d H:i:s P') }}"); 

        setInterval(function() {
            let now = new Date();
            var diff = expires - now;
            var seconds = Math.floor(diff / 1000);
            var hour = Math.floor(seconds / 3600);
            var minutes = Math.floor((seconds % 3600) / 60);
            var second = seconds % 60;

            $("#deadline_hour").html(parseInt(hour).toFixed());
            $("#deadline_minute").html(parseInt(minutes).toFixed());
            $("#deadline_second").html(parseInt(second).toFixed());

        }, 1000);
    </script>
@endif

@if (isDate($advance->expires))
    @php
        $_timezone = new DateTimeZone('America/Sao_Paulo');
        $_datetimeSaoPaulo = new DateTime($advance->expires, $_timezone);

    @endphp


    <script>
        function _converterhourParaminutes(offsetinhour) {
            return offsetinhour * 60;
        }
        var _expires = new Date("{{ $_datetimeSaoPaulo->format('Y-m-d H:i:s P') }}"); 
        
        setInterval(function() {
            let _now = new Date();
            var _diff = _expires - _now;
            var _seconds = Math.floor(_diff / 1000);
            var _hour = Math.floor(_seconds / 3600);
            var _minutes = Math.floor((_seconds % 3600) / 60);
            var _second = _seconds % 60;

            $("#advance_hour").html(parseInt(_hour).toFixed());
            $("#advance_minute").html(parseInt(_minutes).toFixed());
            $("#advance_second").html(parseInt(_second).toFixed());

        }, 1000);
    </script>
@endif
