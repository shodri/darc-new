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
            <span class="d-lg-none"><img src="{{ asset('assets/img/menu-open.png')}}" width="20" class="mx-3"
                    onclick="openNav()"> </span>
            <a href="/"><img src="{{ asset('assets/img/logo.png')}}" width="240"></a>




            <div id="mySidenav" class="sidenav" style="width:0%;">
                <div class="container-fluid">

                    <span class="d-none d-lg-inline"><a href="javascript:void(0)" onclick="closeNav()"><img
                                src="assets/img/menu-close.png" width="20" class="mx-5"></a></span>
                    <span class="d-lg-none"><a href="javascript:void(0)" onclick="closeNav()"><img
                                src="assets/img/menu-close.png" width="20" class="mx-3"></a></span>


                    <a href="/"><img src="assets/img/logo.png" width="240"></a>
                    <div class="row">
                        <div class="col-md-12" style="padding:50px;">

                            <a class="mainmenu" href="empresa.php">Empresa</a>

                            <div class="panel-group" id="accordion">
                                <div class="panel">
                                    <a class="mainmenu" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseMarcas">Marcas</a>
                                    <div id="collapseMarcas" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <a class="itemmenu" href="citroen.php">Citroën</a>
                                            <a class="itemmenu" href="peugeot.php">Peugeot</a>
                                            <a class="itemmenu" href="ds.php">DS</a>
                                        </div>
                                    </div>
                                </div>

                                <a class="mainmenu" href="servicios.php">Servicios</a>
                                <a class="mainmenu" href="rrhh.php">Recursos Humanos</a>
                                <a class="mainmenu" href="sucursales.php">Sucursales</a>

                                <a class="mainmenu" href="contacto.php">Contáctenos</a>

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