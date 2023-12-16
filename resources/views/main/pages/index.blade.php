@extends('main.templates.main')

@section('content')
    <div class="intro1 section-padding"
        style="background: url('{{ url('public/assets/img/192s0_1080.jpg') }}'); background-size: cover;min-height: 100vh; background-repeat: no-repeat;background-position: center bottom;">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-xl-6 col-lg-6 col-12">
                    <div class="intro-content  my-5">
                        <h5 style="font-size: 15pt">{{ __('Há quanto tempo seus sonhos têm ficado no papel?') }}</h5>
                        <h1 class="mb-3" style="font-size: 50pt;">{!! __("Aprenda como ir <span class='text-warning'>dos 50 aos 200 mil</span> reais em 90 dias!") !!}</h1>
                        <h6 style="font-size: 22pt; font-weight: 400;">
                            {{ __('Descubra o que é o financiamento coletivo 2.0 e como seus projetos, causas e sonhos engavetados podem se tornar realidade em 2024.') }}
                        </h6>

                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-12 p-0">
                    <div class="intro-slider p-0">
                        <div class="slider-item- p-0">
                            <img data-src="{{ url('public/assets/images/BACKGROUND/T1.png') }}" class="w-100 lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="create-sell bg-light  section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section-title arrow-bg text-center">
                        <h1>{!! __("<span class='text-primary'>O que é</span> Financiamento Coletivo?") !!}</h1>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">

                @php

                    $cont = [['definição', 'Crowdfunding, ou financiamento coletivo, é uma estratégia moderna que permite que projetos, ideias e causas ganhem vida através de contribuições financeiras feitas por um grande número de pessoas.'], ['mecanismo', 'Em vez de buscar um único grande investidor, a necessidade financeira é dividida entre uma comunidade, tornando o apoio mais democrático.'], ['plataformas', 'Existem diversas plataformas online, como Vakinha, Kickstarter e Catarse, que facilitam esse processo, conectando projetos a possíveis apoiadores.'], ['diversidade', 'Esta modalidade viabiliza uma variedade de iniciativas, desde inovações tecnológicas a produções artísticas e causas sociais']];

                @endphp


                @foreach ($cont as $item)
                    <div class="col-xl-6 col-lg-6 col-md-6 px-5">
                        <h4 class="grad-title shadow border-radius-10 mb-4  text-uppercase">{{ $item[0] }}</h4>
                        <div class="card card-body shadow border-radius-30 text-center">
                            <h6>{{ $item[1] }}</h6>
                        </div>
                    </div>
                @endforeach

                <div class="col-12 px-5 mt-4">
                    <h4 class="grad-title-1 shadow border-radius-10 mb-4  text-uppercase">{{ __('evolução') }}</h4>
                    <div class="card card-body shadow border-radius-30 bg-dark text-center">
                        <h6 class="text-white">
                            {{ __('A próxima etapa do financiamento coletivo que veremos a seguir com o modelo de Crowdfunding 2.0 idealizado pela BeHappyWorld, amplia o financiamento coletivo tradicional. Aqui, os doadores também recebem apoio criando um espaço onde sonhos são tanto apoiados quanto recompensados. A inovação que transforma o modo de realizar sonhos.') }}
                        </h6>
                    </div>
                </div>
            </div>

        </div>
    </div>





    <div class="create-sell bg-light  section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section-title arrow-bg text-center">
                        <h1>Crowdfunding 2.0</h1>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">

                <div class="col-xl-6 col-lg-6 col-md-6 px-5">
                    <a name="crowdf"></a>
					
                    <h3 class="mb-3">{!! __("Imagine um mundo <span class='text-warning'> onde todos prosperam,</span> juntos...") !!}
                        <span class="arrow-bg d-block" style="width: 52%"></span>
                    </h3>

                    <div class="text-justify">
                        <h6 class="mb-3">{!! __(
                            "Um mundo onde a comunidade se une para garantir que todos <span class='text-warning'>alcancem seus sonhos</span> e aspirações",
                        ) !!}</h6>
                        <h6 class="mb-3">{!! __(
                            "Um lugar onde <span class='text-warning'>a tecnologia é usada para unir as pessoas</span> em um objetivo comum: a verdadeira liberdade financeira e pessoal.",
                        ) !!}</h6>
                        <h6 class="mb-3">{!! __("Um sistema que quebra o status quo e redefine o que é possível.") !!}</h6>
                    </div>

                </div>


                <div class="col-xl-6 col-lg-6 col-md-6">
                    <img  data-src="{{ url('public/assets/images/BACKGROUND/png-2.png') }}" alt="" class="img-fluid lazy">
                </div>

            </div>

        </div>
    </div>






    <div class="create-sell bg-light  section-padding">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-xl-6 col-lg-6 col-md-6">
                    <img data-src="{{ url('public/assets/images/BACKGROUND/png-3.png') }}" alt="" class="img-fluid lazy">

                </div>


                <div class="col-xl-6 col-lg-6 col-md-6 px-5">
                    <a name="crowdf"></a>
                    <h3 class="mb-3">{!! __("Bem-vindo a <span class='text-warning'>BeHappyWorld</span>: sua jornada começa aqui.") !!}
                        <span class="arrow-bg d-block" style="width: 52%"></span>
                    </h3>
                    <div class="text-justify">
                        <h6 class="mb-3">{!! __(
                            "Na <span class='text-danger'>BeHappyWorld</span>, acreditamos que todos merecem uma chance de reescrever sua história. Aqui, você não é apenas um número.",
                        ) !!}</h6>
                        <h6 class="mb-3">
                            {{ __('Você é parte de uma comunidade que se apoia, se financia e cresce junta.') }}</h6>
                        <h6 class="mb-3">
                            {{ __('Usando a mais recente tecnologia, criamos um ecossistema onde todos tem a oportunidade de prosperar e viver seus sonhos.') }}
                        </h6>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="create-sell bg-light  section-padding">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-8">
                    <div class="row">

                        <div class="col-12">
                            <h2 class="mb-3">
                                {!! __(
                                    "Foi criada uma <span class='text-primary'>jornada gamificada,</span> ou seja, simples como um jogo, com passo a passo e etapas para avançar, <span class='text-warning'>onde de maneira simples de entender</span> e aplicar qualquer pessoa possa fazer parte do movimento.",
                                ) !!}
                            </h2>
                        </div>


                        @php
                            $con = [['fa fa-list', 'Cadastre-se através de um link de convite', 'Dessa forma você se torna um membro da comunidade.'], ['fas fa-donate', 'Faça sua primeira doação', '25% do valor para quem te indicou e 75% para um recebedor disponível.'], ['fa fa-sack-dollar', 'Espalhe prosperidade', 'Indique dois novos membros, assim que eles doarem você se torna um construtor.'], ['fa fa-hand-holding-usd', 'Receba recompensas e avance', 'Finalize fases após receber 4 doações e avance de fase.']];

                        @endphp

                        @foreach ($con as $item)
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="card shadow border-radius-30">
                                    <div class="card-body">
                                        <h1 class="text-center text-danger"><i class="{{ $item[0] }}"></i></h1>
                                        <h5 class="text-center">{{ $item[1] }}</h5>
                                        <p class="text-center">{{ $item[2] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>

                <div class="col-md-4"
                    style="
                background-image: url('{{ url('public/assets/images/BACKGROUND/png-1.png') }}');
                background-size: 180%;
                background-repeat: no-repeat;
                background-position: -119px -43px;
                min-height: 700px;">
                </div>

            </div>

        </div>
    </div>






    <div class="create-sell bg-light  section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section-title arrow-bg text-center text-uppercase mb-2">
                        <h1>{{ __('fases') }}</h1>
                    </div>

                    <div class="section-title text-center">
                        <h6>{{ __('Ajude o próximo, receba recompensas e transforme a sua realidade em nossa comunidade através do avanço das fases.') }}
                        </h6>
                    </div>

                </div>
            </div>
            <div class="row align-items-center">
                @foreach ($plan as $item)
                    <div class="col-xl-2 col-lg-2 col-md-4">
                        <div class="card shadow">
                            <div class="card-body text-center  p-2">
                                <img data-src="{{ tools()->photo($item->icon) }}" alt="" class="img-fluid lazy">
                                <h6 class="mt-3 text-primary p-0 mb-0">
                                    {{ $item->currency_symbol . format_number($item->price ?? 0) }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>





    <div class="create-sell bg-light  section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section-title arrow-bg text-center text-uppercase mb-2">
                        <h1>{{ __('Nossos Números') }}</h1>
                    </div>

                    <div class="section-title text-center">
                        <h6>{{ __('Veja abaixo um pouco dos números que comprovam o que o Crowdfunding 2.0 já fez em pouco tempo.') }}
                            <h6>
                    </div>

                </div>
            </div>
            <div class="row align-items-center container">

                <div class="col-md-4">
                    <div class="card shadow border-radius-30">
                        <div class="card-body text-center">
                            <h3 class="text-primary">{{ tools()->num($count_participant, 0, ',', '.') }}</h3>
                            <h6 class="mt-3 text-primary p-0 mb-0">{{ __('Membros ativos') }}</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow border-radius-30">
                        <div class="card-body text-center">
                            <h1>+R${{ tools()->num($total_donate, 0, ',', '.') }}</h1>
                            <h4 class="mt-3 p-0 mb-0">{{ __('Doações efetuadas') }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow border-radius-30">
                        <div class="card-body text-center">
                            <h3 class="text-primary">{{ tools()->num($count_mandala, 0, ',', '.') }}</h3>
                            <h6 class="mt-3 text-primary p-0 mb-0">{{ __('Fases ativas') }}</h6>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>







    <div class="create-sell bg-light  section-padding">
        <div class="container">


            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section-title arrow-bg text-center mb-2">
                        <h2>{{ __('Depoimentos') }}</h2>
                        <a name="tstm"></a>
                    </div>
                    <div class="section-title text-center">
                        <h6>{{ __('Veja o que os membros da BehappyWorld estão falando sobre a comunidade e suas realizações.') }}
                            <h6>
                    </div>
                </div>
            </div>





            <div class="container slider">
            
                @foreach ($testimony as $item)
                <div class="p-4">
                    <div class="card border-radius-30">
                        <div class="card-body p-0 shadow">

                            <div class="bg-warning  text-justify rounded-top">
                                <!--h3 class="text-white pt-5">Aprendiz</h3-->
                                <p class="text-white text-center pt-2"
                                    style="position: relative; top: 42px; padding: 15px;">
                                    <i class="fas fa-quote-left pe-2"></i>
                                    {{ $item->message }}
                                </p>
                                <img class="rounded-circle shadow mb-4"
                                    src="{{ tools()->photo($item->user_profile_picture) }}" alt="avatar"
                                    style="width: 100px; position: relative; bottom: -62px; margin: 0 auto; background: #fff;  " />

                            </div>
                            <div class="bg-white pt-5">



                                <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                    @for ($i = 0; $i < $item->points; $i++)
                                        <li><i class="fas fa-star fa-sm"></i></li>
                                    @endfor
                                </ul>
                                <h5 class="px-3 text-dark text-center">{{ $item->user_full_name }}</h5>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach



            </div>












        </div>
    </div>





    <div class="create-sell bg-light  section-padding">
        <div class="container">


            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section-title arrow-bg text-center mb-2">
                        <h2>{{ __('Futuro') }}</h2>
                    </div>
                    <div class="section-title text-center">
                        <h6>{{ __('Descubra os principais objetivos filantrópicos da comunidade conforme o avanço dos membros') }}
                            <h6>
                    </div>
                </div>
            </div>


            <!-- alteracao roadmap  03.11.2023 julio  -->
            <div class="row justify-content-center">
                <img class='lazy' data-src="{{ url('public/assets/images/BACKGROUND/ROADMAP.png') }}" />
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {



            $(".slider").slick({
                // normal options...
                infinite: true,
                slidesToShow: 1,
                dots: true,
                infinite: true,
                autoplay:true,
                autoplaySpeed: 3000


            });
        });
    </script>
@endsection
