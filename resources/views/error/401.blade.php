
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Meta -->
    <meta
      name="description"
      content="Responsive Bootstrap4 Dashboard Template"
    />
    <meta name="author" content="ParkerThemes" />
    <link rel="shortcut icon" href="{{ url('public/dashboard-assets/img/fav.png') }}" />

    <!-- Title -->
    <title>Le Meilleur Admin Template - 404 - Error Page</title>

    <!-- *************
			************ Common Css Files *************
		************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{ url('public/dashboard-assets/css/bootstrap.min.css') }}" />

    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{ url('public/dashboard-assets/fonts/style.css') }}" />

    <!-- Main css -->
    <link rel="stylesheet" href="{{ url('public/dashboard-assets/css/main.css') }}" />

    <!-- *************
			************ Vendor Css Files *************
		************ --> 
  </head>

  <body class="error-page">
    <div id="particles-js"></div>
    <div class="countdown-bg"></div>

    <div class="error-screen">
      <h1>401</h1>
      <h4 class="text-uppercase mt-3">Nao possui autorizacao para aceder a este conteudo</h4>
      <p class="mt-3 mb-3">Tente atualizar a pagina ou contacte o <a href="{{ route("web.public.contact.index") }}" class="text-info"><b>Suporte</b></a></p>
      <a href="{{ url('/') }}" class="btn stripes-btn">Voltar a Pagina Inicial</a>
    </div>
 
  </body>
</html>
