@extends('layouts.museo')
@section('content')


<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php">Inicio</a></li>
                <li>Archivo</li>
            </ol>
            <h2>Archivo</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->

    {{-- <section id="about" class="about">
        <div class="container">
            <div class="section-title">

                <br>
                <h2>Archivo</h2>
                <p>
                    El archivo del museo reúne los documentos, cartas, notas oficiales, mapas, planos, fotografías,
                    ligados a la historia de la Unidad Turística Chapadmalal. Los fondos documentales sobre los que
                    estamos trabajando a partir del Proyecto Impactar versan sobre tres tópicos bien diferenciados: la
                    historia de la construcción del complejo y las funciones y destinos que vivió en función de los
                    vaivenes políticos; la relación con la Fundación Eva Perón, y la abultada producción de material que
                    surge del contacto con los viajeros, que pasaron por el complejo a lo largo de su septuagenaria
                    historia. El trabajo que nos ocupa comprende el escaneado, catalogación y resguardo de todo el
                    material con la finalidad de su utilidad para investigadores y visitantes, en el convencimiento de
                    la importancia de los archivos y sus diversos sentidos, tanto tradicionales como evidentes o
                    inesperados.
                </p>
                <br>
            </div>
            <div class="col-lg-12">
                <img src="assets/img/archivo.jpg" class="img-fluid" alt="">
            </div>
            <div class="section-title">
                <br>
                <br>
                <h2>Sin memoria atesorada no hay archivo; sin archivo no hay historia; sin historia no hay futuro.</h2>

            </div>
        </div>
    </section> --}}

    <!-- ======= End About Section ======= -->

          <!-- ======= actividades Section ======= -->
          <section id="actividades" class="actividades">
            <div class="container">
                <div class="section-title">
                    <h2>Archivo</h2>
                </div>
                <div class="row">
                    <div class="col-lg-6 pt-4 pt-lg-0 content">
                        <h3>Catálogo Trajes de España </h3>
                        <p class="fst-italic">
                           Colección Maria Eva Duarte de Perón
                        </p>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                            in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum
                        </p>
                        <br>
                        <p>
                            <div class="pricing text-center">
                                <div class="pricing-item featured"><a href="#" class="buy-btn">Descargar Catálogo</a></div>
                            </div>
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{asset('assets/img/catalogo.png')}}" alt="">
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <img src="assets/img/archivo.jpg" class="img-fluid" alt="">

                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content">
                        <h3>Archivos del Museo</h3>
                        <p class="fst-italic">
                            El archivo del museo reúne los documentos, cartas, notas oficiales, mapas, planos, fotografías, ligados a la historia de la Unidad Turística Chapadmalal. 
                        </p>
                        <p>
                            Los fondos documentales sobre los que estamos trabajando a partir del Proyecto Impactar versan sobre tres tópicos bien diferenciados: la historia de la construcción del complejo y las funciones y destinos que vivió en función de los vaivenes políticos; la relación con la Fundación Eva Perón, y la abultada producción de material que surge del contacto con los viajeros, que pasaron por el complejo a lo largo de su septuagenaria historia. El trabajo que nos ocupa comprende el escaneado, catalogación y resguardo de todo el material con la finalidad de su utilidad para investigadores y visitantes, en el convencimiento de la importancia de los archivos y sus diversos sentidos, tanto tradicionales como evidentes o inesperados.
                        </p>
                    </div>

                </div>

            </div>
        </section><!-- End actividades Section -->


</main><!-- End #main -->
@endsection