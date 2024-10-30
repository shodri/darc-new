@extends('layouts.darc')
@section('content')


<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <br>
      <div class="row" style="background-color:#243782;">
        <div class="col-lg-4 text-center p-5">
          <img src="{{asset('assets/img/brand-ds.png')}}" width="30%" alt="">
          <h6 class="pt-3 blanco">
            Una marca francesa nacida en París, pretende encarnar el saber hacer francés en materia de automóviles de
            lujo. Impulsada por un espíritu de vanguardia y basándose en la herencia excepcional del DS de 1955, la marca
            combina refinamiento y tecnología en cada una de sus creaciones.
          </h6>
        </div>
        <div class="col-lg-8 text-center">
          <img src="{{asset('assets/img/brand-ds.jpg')}}" width="100%" alt="">
        </div>
      </div>
  
  
  
      <div class="container">
  
        <div class="my-5 text-right">
          <h1 style="font-size:60px; color:#243782;" data-aos="fade-up"><b>D'ARC DS</b></h1>
        </div>
  
        <div class="row">
  
          <div class="col-lg-6">
            <img src="assets/img/m-d-1.jpg" width="100%" alt="">
            <br>
            <h1 style="font-weight: 500;"><br><a style="color:#292929;" href="https://dsstorenunez.com.ar/"
                target="_blank">www.dsstorenunez.com.ar</a><br><br></h1>
            <div class="member-img">
              <p>Conozca más sobre nuestras opciones de financiamiento y nuestros vehículos usados accediendo al siguiente enlace</p>
              <a href="https://dsstorenunez.com.ar/" class="link-sitio text-center">Ingrese al sitio oficial</a>
            </div>
          </div>
          <div class="col-lg-6">
            <img src="{{asset('assets/img/m-d-2.jpg')}}" width="100%" alt="">
          </div>
  
        </div>
  
      </div>
  
  
  
  
  
    </section><!-- End About Section -->
  
  
@endsection
