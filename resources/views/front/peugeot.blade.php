@extends('layouts.darc')
@section('content')
   

<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <br>
      <div class="row" style="background-color:#243782;">
        <div class="col-lg-4 text-center p-5">
          <img src="{{asset('assets/img/brand-peugeot.png')}}" width="30%" alt="">
          <h6 class="pt-3 blanco">
            Presente en casi 160 países con más de 10.000 puntos de contacto, Peugeot es la única marca del mundo que
            ofrece una oferta de movilidad completa (coches, scooters, bicicletas) junto con una amplia gama de servicios.
          </h6>
        </div>
        <div class="col-lg-8 text-center">
          <img src="{{asset('assets/img/brand-peugeot.jpg')}}" width="100%" alt="">
        </div>
      </div>
  
  
  
      <div class="container">
  
        <div class="my-5 text-right">
          <h1 style="font-size:60px; color:#243782;" data-aos="fade-up"><b>D'ARC Peugeot</b></h1>
        </div>
  
        <div class="row">
  
          <div class="col-lg-6">
            <img src="{{asset('assets/img/m-p-1.jpg')}}" width="100%" alt="">
            <br>
            <h1 style="font-weight: 500;"><br><a style="color:#292929;" href="https://darcpeugeot.com/"
                target="_blank">www.darcpeugeot.com</a><br><br>
            </h1>
            <div class="member-img">
              <p>Conozca más sobre nuestras opciones de financiamiento y nuestros vehículos usados accediendo al siguiente enlace</p>
              <a href="https://darcpeugeot.com/" class="link-sitio text-center">Ingrese al sitio oficial</a>
            </div>
          </div>
          <div class="col-lg-6">
            <img src="{{asset('assets/img/m-p-2.jpg')}}" width="100%" alt="">
          </div>
  
        </div>
  
      </div>
  
  
  
  
  
    </section><!-- End About Section -->
  
  
  
@endsection
