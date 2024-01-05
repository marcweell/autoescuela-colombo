
           <!-- Essential javascripts for application to work-->
           <script src="{{ url('public/dashboard/js/jquery-3.7.0.min.js') }}"></script>
           <script src="{{ url('public/dashboard/js/bootstrap.min.js') }}"></script>
           <script src="{{ url('public/dashboard/js/main.js') }}"></script>
           <script src="{{ url('public/essential/plugins/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.min.js') }}">
           </script>

           <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

           <script src="{{ url('public/essential/plugins/color-picker-huebee/huebee.js') }}"></script>
           <script src="{{ url('public/essential/plugins/Croppie/croppie.min.js') }}"></script>
           <script src="{{ url('public/essential/plugins/bootstrap-icon-picker/dist/js/bootstrapicon-iconpicker.min.js') }}">
           </script>
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
                       init: [{
                           url: location.href
                       }]
                   };
                   app.init(options);


                   function lic() {
                       setTimeout(function() {
                           app.listenner.listen("clickEvents");
                           lic();
                       }, 500);
                   };

                   lic();


               })
           </script>

           @yield('scripts')
