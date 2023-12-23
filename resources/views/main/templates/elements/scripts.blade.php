
  <!-- Vendor JS Files -->
           <script src="{{ url('public/dashboard/js/jquery-3.7.0.min.js') }}"></script>
           <script src="{{ url('public/dashboard/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('public/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ url('public/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ url('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('public/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ url('public/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ url('public/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('public/assets/js/main.js') }}"></script>     <script src="{{ url('public/essential/plugins/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.min.js') }}"></script>


  <script src="{{ url('public/essential/plugins/color-picker-huebee/huebee.js') }}"></script>
  <script src="{{ url('public/essential/plugins/Croppie/croppie.min.js') }}"></script>
  <script src="{{ url('public/essential/plugins/bootstrap-icon-picker/dist/js/bootstrapicon-iconpicker.min.js') }}"></script>
  <script src="{{ url('public/essential/plugins/pace/pace.min.js') }}"></script>
  <script src="{{ url('public/essential/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js') }}"></script>
  <script src="{{ url('public/essential/plugins/toast-master/js/jquery.toast.js') }}"></script>
  <script src="{{ url('public/essential/app/custom.js') }}"></script>
  <script src="{{ url('public/essential/app/webapi.js') }}"></script>
  <script src="{{ url('public/essential/app/inits.js') }}"></script>
  <script>
      $(function() {
          env.token = '{{ csrf_token() }}';
          var options = {
              root: "{{ route('web.public.index') }}",
          };
          app.init(options);
      })
  </script>

  @yield('scripts')
