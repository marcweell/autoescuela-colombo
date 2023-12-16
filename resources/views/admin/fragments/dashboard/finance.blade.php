<div class="row">
    <div class="col-12 mb-3">

        <div class="card">
            <form action="" class="form_">
                <input type="hidden" name="init" value="1">

                <div class="card-body row">

                    <div class="col-md-12">
                        <div class="form-input pt-3">
                            <div class="form-label">Nome de Usuario</div>
                            <select name="user" class="selet-2" style="width: 100%"></select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-input pt-3">
                            <div class="form-label">Data Inicial</div>
                            <input type="date" name="start_date" class="form-control"
                                value="{{ $request->get('start_date') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-input pt-3">
                            <div class="form-label">Data Final</div>
                            <input type="date" name="end_date" class="form-control"
                                value="{{ $request->get('end_date') }}">
                        </div>
                    </div>

                    <div class="col-md-12 pt-2">
                        <button class="btn btn-primary float-end"><i class="fa fa-search"></i> Filtrar</button>
                    </div>


                </div>





            </form>
        </div>





    </div>
    @foreach ($content as $item)
        <div class="col-xl-4 col-md-4 col-sm-6">
            <div class="stat-widget d-flex align-items-center">
                <div class="widget-content">
                    <h6>{{ $item['title'] }}</h6>
                    <p>{{ $item['count'] }}</p>
                </div>
                <div class="widget-arrow">
                    <a class="text-info mb-0 border p-3" href="#"><span><i class="fa fa-external-link"></i></span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach


</div>

<div class="row">

    <div class="col-12">
        <h4 class="mt-4">Tenha uma visão geral do seu progresso!</h4>
    </div> 

    <div class="col-lg-4">

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

    <div class="col-lg-4">

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
                                                src="{{ tools()->photo($item->icon) }}" class="bw">
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


    <div class="col-lg-12">


        <div class="row">


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


            <div class="col-lg-8" dir="ltr">
                <canvas id="chart"></canvas>
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
    _ChartJs.hBar("#companyChart", {!! getSummary($company) !!}, "{!! __('Ultimas Empresas Cadastradas') !!}");
     
</script>
























</div>

<script>
    $('.selet-2').select2({
        ajax: {
            url: "{{ route('web.app.api.user') }}",
            dataType: 'json',
            processResults: function(data) {
                return {
                    results: $.map(data.data, function(item) {
                        return {
                            text: item.name,
                            id: item.name,
                        }
                    })
                };
            }
        }
    })
</script>
