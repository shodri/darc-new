@extends('layouts.darc')
@section('content')
<style>
.card {
    border: none;
    border-radius: 8px;
    overflow: hidden;
}

.card-img-top {
    border-bottom: 1px solid #e9ecef;
    height: 200px;
    object-fit: cover;
}

.meta-item a {
    color: #6c757d;
    font-size: 0.8em;
}

.meta-item a:hover {
    text-decoration: underline;
}

.card-title {
    font-size: 1.25rem;
}

.card-text {
    font-size: 0.9rem;
    color: #495057;
}
</style>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($banners as $index => $banner)
            <li data-target="#myCarousel" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($banners as $index => $banner)
            @php
                $imageXL = $banner->getMedia('banners')->firstWhere('custom_properties.type', 'xl');
                $imageXS = $banner->getMedia('banners')->firstWhere('custom_properties.type', 'xs');
            @endphp
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}"
                style="background-image: url('{{ $imageXL ? $imageXL->getUrl() : 'default-xl-image.jpg' }}'); 
                       background-repeat: no-repeat; 
                       background-size: cover; 
                       background-position: center; 
                       height: 100vh;">
                
                @if($imageXS)
                    <img class="d-sm-none w-100" src="{{ $imageXS->getUrl() }}" alt="Banner XS">
                @endif
                
                <div class="container-fluid">
                    <div class="carousel-caption">
                        <h1></span>{{ $banner->title }}</h1>
                        <p class="">{{ $banner->subtitle }}</p>
                        <p><a class="cta-btnh scrollto" href="{{ $banner->href }}" role="button"><b>{{ $banner->text_button }}</b></a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <img src="{{ asset('assets/img/logo.png')}}" width="300" alt="">
                        <h3 class="pt-3">
                            <b>56 años de trayectoria<br>en el mercado automotor.<br></b>
                        </h3>

                        <p class="py-3">Somos una empresa con más de 56 años en el mercado<br>orientado a satisfacer las
                            expectativas
                            del público más exigente.<br><br>
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-in">
                <div class="text-center">
                    <h3>La más amplia gama de modelos y servicios</h3>
                    <p> Dentro de las líneas que comercializamos, armamos con vos el plan de financiación<br>que más te
                        convenga
                        para que pueda disfrutar tu nuevo auto de la manera más simple.</p>
                    <a class="cta-btn" href="{{ route('contacto')}}">¡Dejanos tu consulta!</a>
                </div>

            </div>
        </section>
        <!-- End Cta Section -->
        <!-- ======= Team Section ======= -->
        <section>
            <div class="container" data-aos="fade-up">


                <div class="row mt-5 row-cols-2">

                    <div class="col d-flex align-items-stretch">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/empresa.jpg')}}" width="100%" alt="">
                            <h1 class="mt-3">Grupo <span style="font-weight:700">D'arc</span></h1>
                            <p>Somos una empresa con más de 56 años en el mercado orientado a satisfacer las expectativas
                                del público
                                más exigente .
                                <br><a href="{{ route('empresa')}}">Ver detalles</a>
                        </div>
                    </div>

                    <div class="col d-flex align-items-stretch">
                        <div class="member-img">
                            <img src="{{ asset('assets/img/servicios.jpg')}}" width="100%" alt="">
                            <h1 class="mt-3">Nuestros <span style="font-weight:700">Servicios</span></h1>
                            <p>Creados y diseñados para el cliente, nuestros servicios te proporcionarán la tranquilidad, en
                                todo
                                momento, de forma eficaz.
                                <br><a href="{{ route('servicios')}}">Ver detalles</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ======= End Team Section ======= -->

        @if(!$recentPosts->isEmpty())
        <!-- ======= Recent Posts Section ======= -->
        <section>
            <div class="container" data-aos="fade-up">
        
                <div class="my-3 text-center">
                    <h1><b>Últimas Novedades</b></h1><br>
                </div>
        
                <div class="row mt-5">
                    @foreach($recentPosts as $post)
                    <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                        <div class="card shadow-sm">
                            <div class="member-img">
                                <img src="{{ $post->getFirstMediaUrl('main_image', 'webp') }}" class="card-img-top" alt="{{ $post->title }}">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h3 class="card-title"><b>{{ $post->title }}</b></h3>
                                <div class="meta-top">
                                    <ul class="meta-list d-flex justify-content-start align-items-center flex-wrap p-0">
                                        <li class="meta-item d-flex align-items-center mr-3">
                                            <i class="bi bi-person mr-1"></i>
                                            <a href="{{ route('author.show', $post->user->id) }}">{{ $post->user->name }}</a>
                                        </li>
                                        <li class="meta-item d-flex align-items-center">
                                            <i class="bi bi-clock mr-1"></i>
                                            <a href="{{ route('post', $post->id) }}">
                                                <time datetime="{{ $post->created_at }}">{{ $post->created_at->format('M j, Y') }}</time>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <p class="card-text">{!! htmlspecialchars_decode($post->excerpt, ENT_QUOTES) !!}</p>
                                <a href="{{ route('post', $post->id) }}" class="btn btn-primary mt-auto" style="background:#25446e!important;border-color:#25446e!important;">Leer más</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ======= Recent Posts Section ======= -->
        @endif

<!-- JavaScript para Swipe -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.getElementById('myCarousel');
        var touchStartX = 0;
        var touchEndX = 0;

        myCarousel.addEventListener('touchstart', function(event) {
            touchStartX = event.changedTouches[0].screenX;
        });

        myCarousel.addEventListener('touchend', function(event) {
            touchEndX = event.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            if (touchEndX < touchStartX) {
                // Swipe left
                $('#myCarousel').carousel('next');
            }
            if (touchEndX > touchStartX) {
                // Swipe right
                $('#myCarousel').carousel('prev');
            }
        }
    });
</script>
    @stop
