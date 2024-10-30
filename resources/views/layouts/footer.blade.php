

    <!-- ======= Footer ======= -->
    <div class="container">

        <section id="team" class="team">

            <div class="my-3 text-center">
                <h1><b><br>Nuestras Marcas</b></h1><br>
            </div>

            <div class="row  row-cols-3">

                <div class="col d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100" style="background-color:#009de0;">
                        <div class="member-img">
                            <img src="assets/img/portfolio/a-p.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href="peugeot.php">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300" style="background-color:#000;">
                        <div class="member-img">
                            <img src="assets/img/portfolio/a-c.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href="citroen.php">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300" style="background-color:#000;">
                        <div class="member-img">
                            <img src="assets/img/portfolio/a-ds.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href="ds.php">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </div>

    </main><!-- End #main -->


    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-2 col-md-1">
                        <img src="{{ asset('assets/img/logo-blanco.png')}}" width="160">
                    </div>

                    <div class="col-lg-6 col-md-6 footer-links">
                        <h4 class="pt-1">Concesionarios Oficiales</h4>
                        <i class="bx bx-chevron-right"></i> <b>Peugeot | Citroen | DS</b><br>
                        <i class="bx bx-chevron-right"></i> Nuestra Empresa | Servicios | Contáctenos
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h4>Redes Sociales</h4>
                            <div class="social-links mt-3">
                                <a href="https://www.facebook.com/darcautos" class="fab fa-facebook"
                                    target="_blank"></i></a>
                                <a href="https://www.instagram.com/grupodarc/" class="fab fa-instagram"
                                    target="_blank"></i></a>
                                <a href="https://www.youtube.com/@Darcautos" class="fab fa-youtube"
                                    target="_blank"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>


    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    // add padding top to show content behind navbar
                    document.getElementById("header").style.backgroundColor = "rgba(255, 255, 255, 0.8)";
                } else {
                    // remove padding top from body
                    document.getElementById("header").style.backgroundColor = "transparent";
                }
            });
        });
        // DOMContentLoaded  end
    </script>

</body>

</html>
