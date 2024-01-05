 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">

     <div class="container">
         <div class="row gy-3">
             <div class="col-lg-3 col-md-6 d-flex">
                 <i class="bi bi-geo-alt icon"></i>
                 <div>
                     <h4>Address</h4>
                     <p>
                         {{ nl2br(_info('company.address')) }}
                     </p>
                 </div>

             </div>

             <div class="col-lg-3 col-md-6 footer-links d-flex">
                 <i class="bi bi-telephone icon"></i>
                 <div>
                     <h4>Reservations</h4>
                     <p>
                         <strong>Phone:</strong> {{ _info('company.phone') }}<br>
                         <strong>Email:</strong> {{ _info('company.email') }}<br>
                     </p>
                 </div>
             </div>

             <div class="col-lg-3 col-md-6 footer-links d-flex">
                 <i class="bi bi-clock icon"></i>
                 <div>
                     <h4>Opening Hours</h4>
                     <p>
                         <strong>Mon-Sat: 11AM</strong> - 23PM<br>
                         Sunday: Closed
                     </p>
                 </div>
             </div>

             <div class="col-lg-3 col-md-6 footer-links">
                 <h4>Follow Us</h4>
                 <div class="social-links d-flex">
                     <a href="{{ _info('social.twitter', '#') }}" class="twitter"><i class="bi bi-twitter"></i></a>
                     <a href="{{ _info('social.facebook', '#') }}" class="facebook"><i class="bi bi-facebook"></i></a>
                     <a href="{{ _info('social.instagram', '#') }}" class="instagram"><i class="bi bi-instagram"></i></a>
                     <a href="{{ _info('social.linkedin', '#') }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                 </div>
             </div>

         </div>
     </div>

     <div class="container">
         <div class="copyright">
             &copy; Copyright <strong><span>{{ config("app.name") }}</span></strong>. All Rights Reserved
         </div>
         <div class="credits">
             <!-- All the links in the footer should remain intact. -->
             <!-- You can delete the links only if you purchased the pro version. -->
             <!-- Licensing information: https://bootstrapmade.com/license/ -->
             <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
             Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
         </div>
     </div>

 </footer><!-- End Footer -->
