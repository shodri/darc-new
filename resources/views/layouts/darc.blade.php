<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>GRUPO D'ARC</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            background-image: url("assets/img/internal-menu.jpg");
            background-size: cover;
            overflow-x: hidden;
            transition: 0s;
            padding-top: 15px;
        }

        @media (max-width: 767.98px) {
            .sidenav {
                padding-top: 30px;
            }
        }

        .sidenav .mainmenu {
            font-family: "Encode Sans Semi Condensed", sans-serif;
            font-weight: 400;
            padding: 5px;
            text-decoration: none;
            border-top: 1px solid black;
            font-size: 20px;
            color: #000000;
            line-height: 40px;
            display: block;
            transition: 0.3s;
            width: 250px;
        }

        .sidenav .mainmenu:hover {
            color: #000;
        }

        .sidenav .itemmenu {
            font-family: "Encode Sans Semi Condensed", sans-serif;
            font-weight: 400;
            padding: 4px;
            text-decoration: none;
            font-size: 18px;
            color: #000000;
            display: block;
            transition: 0.3s;
            margin-left: 20px;
        }

        .carousel-indicators li {

            width: 30px;
            height: 8px;
            background-color: #000;
        }

        .blanco {
            color: #fff;
        }

        .link-sitio {
            transition: color 0.3s;
            margin: 2px;
            border-radius: 4px;
            width: 90%;
            line-height: 34px;
            background: #25446e;
            display: inline-block;
            transition: ease-in-out 0.3s;
            color: #fff;
            font-size: 14px;
            font-weight: 800;
        }

        .link-sitio:hover {
            color: #fff;
            background: #06173e;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container-fluid">

            <span class="d-none d-lg-inline"><img src="{{ asset('assets/img/menu-open.png')}}" width="20" class="mx-5"
                    onclick="openNav()"> </span>
            <span class="d-lg-none"><img src="assets/img/menu-open.png" width="20" class="mx-3"
                    onclick="openNav()"> </span>
            <a href="/"><img src="{{ asset('assets/img/logo.png')}}" width="240"></a>




            <div id="mySidenav" class="sidenav" style="width:0%;">
                <div class="container-fluid">

                    <span class="d-none d-lg-inline"><a href="javascript:void(0)" onclick="closeNav()"><img
                                src="{{ asset('assets/img/menu-close.png')}}" width="20" class="mx-5"></a></span>
                    <span class="d-lg-none"><a href="javascript:void(0)" onclick="closeNav()"><img
                                src="{{ asset('assets/img/menu-close.png')}}" width="20" class="mx-3"></a></span>


                    <a href="/"><img src="{{ asset('assets/img/logo.png')}}" width="240"></a>
                    <div class="row">
                        <div class="col-md-12" style="padding:50px;">

                            <a class="mainmenu" href="{{route('empresa')}}">Empresa</a>

                            <div class="panel-group" id="accordion">
                                <div class="panel">
                                    <a class="mainmenu" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseMarcas">Marcas</a>
                                    <div id="collapseMarcas" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <a class="itemmenu" href="{{route('citroen')}}">Citroën</a>
                                            <a class="itemmenu" href="{{route('peugeot')}}">Peugeot</a>
                                            <a class="itemmenu" href="{{route('ds')}}">DS</a>
                                        </div>
                                    </div>
                                </div>

                                <a class="mainmenu" href="{{route('servicios')}}">Servicios</a>
                                <a class="mainmenu" href="{{route('recursos-humanos')}}">Recursos Humanos</a>
                                <a class="mainmenu" href="{{route('sucursales')}}">Sucursales</a>
                                <a class="mainmenu" href="{{route('blog')}}">Novedades</a>

                                <a class="mainmenu" href="{{route('contacto')}}">Contáctenos</a>

                                <a class="mainmenu" href="#"></a>


                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </header><!-- End Header -->

    <style>
        #logo {
            position: absolute;
            width: 100%;
            opacity: 0;
            position: relative;
            animation-name: example;
            animation-duration: 3s;
            animation-fill-mode: forwards;
        }


        @keyframes example {
            from {
                left: -100px;
                top: 0px;
                opacity: 0;
            }

            to {
                left: 0px;
                top: 0px;
                opacity: 1;
            }
        }
    </style>

    @yield('content')


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
                            <img src="{{ asset('assets/img/portfolio/a-p.jpg')}}" class="img-fluid" alt="">
                            <div class="social">
                                <a href="{{route('peugeot')}}">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300" style="background-color:#000;">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/portfolio/a-c.jpg')}}" class="img-fluid" alt="">
                            <div class="social">
                                <a href="{{route('citroen')}}">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300" style="background-color:#000;">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/portfolio/a-ds.jpg')}}" class="img-fluid" alt="">
                            <div class="social">
                                <a href="{{route('ds')}}">Ver detalles</a>
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
            AOS.init(); // Inicializar AOS después de que el DOM esté listo

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
