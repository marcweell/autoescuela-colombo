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

        </div>
      </section><!-- End Breadcrumbs -->

      @yield('content')




  </main><!-- End #main -->

  @include('main.templates.elements.footer')
  @include('main.templates.elements.scripts')

  @include('loader')
  @include('modals')



</body>

</html>
