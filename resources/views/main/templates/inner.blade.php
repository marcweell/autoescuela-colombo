<!DOCTYPE html>
<html lang="en">

@include('main.templates.elements.head')

<body>

    @include('main.templates.elements.header')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

          <ol>
            <li><a href="{{ route('web.public.index') }}"><i class="fa fa-home"></i></a></li>
            <li>{{ $page_title }}</li>
          </ol>
          <h2>{{ $page_title }}</h2>

        </div>
      </section><!-- End Breadcrumbs -->

      <section class="inner-page">
        <div class="container">
            @yield('content')
        </div>
      </section>




  </main><!-- End #main -->

  @include('main.templates.elements.footer')
  @include('main.templates.elements.scripts')

  @include('loader')
  @include('modals')



</body>

</html>
