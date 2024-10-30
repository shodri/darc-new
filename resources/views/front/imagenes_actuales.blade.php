@extends('layouts.museo')
@section('content')

    <main id="main">


        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{ route('front.index') }}">Inicio</a></li>
                    <li>Imagenes Actuales</li>
                </ol>
                <h2>Imagenes Actuales</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        @if ($imagenes_actuales)
            <!-- ======= Portfolio Section ======= -->
            <section id="portfolio" class="portfolio">
                <div class="container">

                    <div class="section-title">
                        <h2>{{ $imagenes_actuales->title }}</h2>
                        <p>{!! $imagenes_actuales->description !!}</p>
                    </div>

                    <div class="row portfolio-container">
                        <div class="row portfolio-container">

                            @foreach ($imagenes_actuales->getOrderedMedia() as $photo)
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
    </main>

@endsection
