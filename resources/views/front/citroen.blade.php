@extends('layouts.darc')
@section('content')
   


<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <br>
      <div class="row" style="background-color:#243782;">
        <div class="col-lg-4 text-center p-5">
          <img src="{{asset('assets/img/brand-citroen.png')}}" width="30%" alt="">
          <h6 class="pt-3 blanco">
            “¡Para todos, como para nadie!”
  
            <br>Citroën es una marca popular que tiene como objetivo hacer que la movilidad sea accesible para todos.
            <br>Con la comodidad y la simplicidad en el centro de la experiencia de nuestros clientes, ofrecemos
            vehículos, servicios y soluciones de movilidad innovadores que son atrevidos y sostenibles.
          </h6>
        </div>
        <div class="col-lg-8 text-center">
          <img src="{{asset('assets/img/brand-citroen.jpg')}}" width="100%" alt="">
        </div>
      </div>
  
  
  
      <div class="container">
  
        <div class="my-5 text-right">
          <h1 style="font-size:60px; color:#243782;" data-aos="fade-up"><b>D'ARC Citroën</b></h1>
        </div>
  
        <div class="row">
  
          <div class="col-lg-6">
            <img src="{{asset('assets/img/m-c-1.jpg')}}" width="100%" alt="">
            <br>
            <h1 style="font-weight: 500;"><br><a style="color:#292929;" href="https://darccitroen.com/"
                target="_blank">www.darccitroen.com</a><br><br></h1>
              <div class="member-img">
              <p>Conozca más sobre nuestras opciones de financiamiento y nuestros vehículos usados accediendo al siguiente enlace</p>
              <a href="https://darccitroen.com/" class="link-sitio text-center">Ingrese al sitio oficial</a>
            </div>
          </div>
          <div class="col-lg-6">
            <img src="{{asset('assets/img/m-c-2.jpg')}}" width="100%" alt="">
          </div>
  
        </div>
  
      </div>
  
  
  
  
  
    </section><!-- End About Section -->
  
  
  
@endsection
