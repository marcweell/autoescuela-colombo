@php
    $quote = [
        [
            'actor' => 'Harold S. Geneen',
            'message' => 'Toda curso tem duas estruturas organizacionais: a formal está escrita nos gráficos; o outro é o relacionamento cotidiano dos homens e mulheres da organização.',
        ],
        [
            'actor' => 'Ginni Rometty',
            'message' => 'A única maneira de sobreviver é se transformar continuamente em outra coisa. É essa ideia de transformação contínua que faz de você uma curso de inovação.',
        ],
        [
            'actor' => 'J. Paul Getty',
            'message' => 'Trabalhar para uma grande curso é como entrar em um trem. Você está indo a sessenta milhas por hora ou o trem está indo a sessenta milhas por hora e você está parado?',
        ],
        [
            'actor' => 'Jeff Bezos',
            'message' => 'Uma marca para uma curso é como uma reputação para uma pessoa. Você ganha reputação tentando fazer bem as coisas difíceis.',
        ],
        [
            'actor' => 'Anne M. Mulcahy',
            'message' => 'Os funcionários são o maior ativo de uma curso - eles são sua vantagem competitiva. Você quer atrair e reter os melhores; dar-lhes encorajamento, estímulo e fazê-los sentir-se parte integrante da missão da curso.',
        ],
        [
            'actor' => 'Sam Walton',
            'message' => 'Existe apenas um chefe. O consumidor. E ele pode demitir todos na curso, do presidente para baixo, simplesmente gastando seu dinheiro em outro lugar.',
        ],
    ];
    
    shuffle($quote);
      
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('public/assets/images/favicon.ico') }} ">

    <!-- App css -->
    <link href="{{ url('public/assets/css/icons.min.css') }} " rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets/css/app.min.css') }} " rel="stylesheet" type="text/css" id="app-style" />

</head>

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand text-center text-lg-start">
                        <a href="index.html" class="logo-dark">
                            <span><img src="{{ url('public/assets/images/logo-dark.png') }} " alt=""
                                    height="18"></span>
                        </a>
                        <a href="index.html" class="logo-light">
                            <span><img src="{{ url('public/assets/images/logo.png') }} " alt=""
                                    height="18"></span>
                        </a>
                    </div>

                    <!-- title-->
                    <h4 class="mt-0">Entrar</h4>
                    <p class="text-muted mb-4">Digite seu endereço de e-mail/nome e usuario e senha para aceder a sua
                        conta.</p>

                    <!-- form -->
                    <form action="{{ route('web.account.auth.login') }}" method="post" class="form_ parent-load">
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">{{ __('Usuario') }}</label>
                            <input class="form-control" type="text" name="user" id="emailaddress" required=""
                                placeholder="">
                        </div>
                        <div class="mb-3">
                            <a href="pages-recoverpw-2.html" class="text-muted float-end"><small>Esqueceu sua
                                    senha?</small></a>
                            <label for="password" class="form-label">{{ __('Senha') }}</label>
                            <input class="form-control" type="password" name="password" required=""  id="password"
                                placeholder="">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">Lembrar Sessao</label>
                            </div>
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary chl_loader" type="submit"><i class="mdi mdi-login"></i>
                                Autenticar </button>
                        </div>
                        <!-- social-->
                        <div class="text-center mt-4">
                            <p class="text-muted font-16">Sign in with</p>
                            <ul class="social-list list-inline mt-3">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                            class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);"
                                        class="social-list-item border-primary text-primary"><i
                                            class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                            class="mdi mdi-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);"
                                        class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-github"></i></a>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Não tem uma conta? <a href="pages-register-2.html"
                                class="text-muted ms-1"><b>Cadastre-se</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">Sua curso nas suas mãos!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i>{{ $quote[0]["message"] }}<i
                        class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    {{ $quote[0]["actor"] }}
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- bundle -->
    <script src="{{ url('public/assets/js/vendor.min.js') }} "></script>
    <script src="{{ url('public/assets/js/app.min.js') }} "></script>
    <script src="{{ url('public/assets/app/custom.js') }}"></script>
    <script src="{{ url('public/assets/app/webapi.js') }}"></script>
    <script src="{{ url('public/assets/app/inits.js') }}"></script>
    <script>
        $(function() {
            env.token = '{{csrf_token() }}';
            app.init();
        })
    </script>

</body>

</html>
