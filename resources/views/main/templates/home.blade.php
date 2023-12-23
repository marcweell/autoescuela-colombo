<!DOCTYPE html>
<html lang="en">

@include('main.templates.elements.head')

<body>

    @include('main.templates.elements.header')
    @include('main.templates.elements.hero')

  <main id="main">


    @yield('content')





  </main><!-- End #main -->

  @include('main.templates.elements.footer')
  @include('main.templates.elements.scripts')

  @include('loader')
  @include('modals')



</body>

</html>
