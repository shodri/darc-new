@extends('layouts.darc')
@section('content')
   
<main id="main">
    <br><br>
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>Contacto</h2>
            <p>Contactanos</p>
          </div>

          @include('components.success-error')
  
          <div class="row mt-5">
  
            <div class="col-lg-4">
              <div class="info">
                <div class="address">
                  <i class="fas fa-map-marker-alt" style="background-color:black;color:white;"></i>
                  <h4 ><a  href="{{ route('sucursales')}}" style="color:black;">Sucursales</a></h4>
                  <!-- <p>A108 Adam Street, New York, NY 535022</p> -->
                </div>
  
                <div class="email">
                  <i class="fas fa-envelope" style="background-color:black;color:white;"></i>
                  <h4>Email:</h4>
                  <p>info@darc.com.ar</p>
                </div>
  
                <div class="phone mt-3">
                  <i class="fas fa-phone" style="background-color:black;color:white;"></i>
                  <h4>Teléfono:</h4>
                  <p>+549 11 55488 55</p>
                </div>
  
              </div>
  
            </div>
  
            <div class="col-lg-8 mt-5 mt-lg-0">
  
              <form action="{{route('contacto.store')}}" method="post" role="form" class="php-email-form" >
                @csrf
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nombre completo" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="5" placeholder="Mensaje" required></textarea>
                </div>
                {{-- <div class="my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Su mensaje ha sido envíado correctamente</div>
                </div> --}}
                <div class="text-center"><button type="submit">Enviar Mensaje</button></div>
              </form>
  
            </div>
  
          </div>
  
        </div>
      </section><!-- End Contact Section -->
@endsection
