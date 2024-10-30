@extends('layouts.museo')
@section('content')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{route('front.index')}}">Inicio</a></li>
                    <li>Imagenes Históricas</li>
                </ol>
                <h2>Imagenes Históricas</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        @if ($imagenes_historicas)
            <!-- ======= Portfolio Section ======= -->
            <section id="portfolio" class="portfolio">
                <div class="container">

                    <div class="section-title">
                        <h2>{{ $imagenes_historicas->title }}</h2>
                        <p>{!! $imagenes_historicas->description !!}</p>
                    </div>

                    <div class="row portfolio-container">
                        <div class="row portfolio-container">

                            @foreach ($imagenes_historicas->getOrderedMedia() as $photo)
                                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                    <div class="portfolio-wrap">
                                        <img src="{{ $photo->getUrl() }}" class="img-fluid" alt="">
                                        <div class="portfolio-info">
                                            <h4>{{ $photo->getCustomProperty('title') }}</h4>
                                            {{-- <p>{{ $photo->getCustomProperty('description') }}</p> --}}
                                            <div class="portfolio-links">
                                                <a href="{{ $photo->getUrl() }}" data-gallery="portfolioGallery"
                                                    class="portfolio-lightbox"
                                                     data-desc-position="right"
                                                    title="{{ $photo->getCustomProperty('description') }}"><i
                                                        class="bx bx-plus"></i></a>
                                                {{-- <a href="portfolio-details.html" title="More Details"><i
                                            class="bx bx-link"></i></a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
            </section>
            <!-- End Portfolio Section -->
        @endif
        <div class="container">
            <div class="section-title">
                <h2>¡Envíanos tu foto y súmate a la historia de la Unidad Turística Chapadmalal !</h2>
                <p>
                La narrativa de este Monumento Histórico Nacional, se construye con los recuerdos de las personas que han visitado  el lugar. Cada postal, cada imagen, atesora una partecita de la historia de este espacio, donde cada visitante ha vivido innumerables momentos de alegría y felicidad. Por eso, te invitamos a que nos envíes  postales o fotografías tuyas, de tu familia o de amigos, que fijaron los momentos y experiencias en este bello complejo turístico a la vera del mar, a nuestras redes sociales, con alguna anécdota que dé cuenta de las situaciones y el instante  a las que hacen referencia   las imágenes.   Pretendemos atesorar estas memorias intangibles   de momentos ya vividos, para  ponerlas en valor, preservarlas y exponerlas a los visitantes. 
                </p>
                <p>
                Nos gustaría contar con tu apoyo…
                </p>
            </div>
        </div>
    </main>

@endsection
