 <!-- bundle -->
 <script src="{{ url('public/assets/js/vendor.min.js') }}"></script>

 <!-- third party js -->
 <script src="{{ url('public/assets/js/vendor/apexcharts.min.js') }}"></script>
 <script src="{{ url('public/assets/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
 <script src="{{ url('public/assets/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
 <!-- third party js ends -->
 

 <script src="{{ url('public/assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
 <script src="{{ url('public/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
 <script src="{{ url('public/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
 <script src="{{ url('public/assets/js/vendor/dataTables.responsive.min.js') }}"></script>

 <script src="{{ url('public/assets/js/app-modern.min.js') }}"></script>
 <script src="{{ url('public/assets/app/custom.js') }}"></script>
 <script src="{{ url('public/assets/app/webapi.js') }}"></script>
 <script src="{{ url('public/assets/app/inits.js') }}"></script>
 <script src="{{ url('public/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js') }}"></script>
 <script src="{{ url('public/assets/plugins/pace/pace.min.js') }}"></script>

 <script>
     $(function() {

        env.token = '{{csrf_token() }}';
         var options = {
                 root: "{{ route('web.index') }}",
                 init: [{
                     url:location.href// window.location.origin + window.location.pathname
                 }]
             };
         app.init(options); 
     })
 </script>

 @yield('scripts')
