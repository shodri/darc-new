@extends('layouts.darc')
@section('content')
    <main id="main">
        <br><br>
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Recursos humanos</h2>
                    <p>Trabajá con nosotros</p>
                </div>

                @include('components.success-error')

                <div class='row'>
                    <div class='col-md-4'><br>
                        <h1 class="life">Recursos Humanos</h1>

                        <p>Si buscás crecer a nivel profesional, sentís que tenés potencial y muchas ganas de sumarte a una
                            empresa en constante evolución, vos también podés formar parte de nuestro equipo.</p>

                        <p>Brindamos la posibilidad de que dejes tus datos personales y experiencia laboral, los cuales
                            pasarán a integrar nuestra base de datos de Recursos Humanos.</p>

                        <p>Esta información será de uso confidencial y estará disponible para futuras búsquedas en las áreas
                            a las que te postules.</p>

                        <br><br>
                    </div>
                    <div class='col-md-8'><br><br>

                        <!--FORM DE CONTACTO -->
                        <form action="{{ route('curriculum.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    Nombre completo<br>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    Edad<br>
                                    <input type="number" class="form-control" name="age" value="{{ old('age') }}">
                                </div>
                                <div class="col-md-6">
                                    Fecha de Nacimiento<br>
                                    <input type="date" class="form-control" name="birthdate"
                                        value="{{ old('birthdate') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    DNI<br>
                                    <input type="text" class="form-control" name="dni" value="{{ old('dni') }}">
                                </div>
                                <div class="col-md-6">
                                    E-mail<br>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    Dirección<br>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    Teléfono<br>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <br>Subir un CV <font color='red'>(max 4Mb)</font><br>
                                    <input type="file" name="cv" id="file" style='width:100%'>
                                </div>
                            </div>

                            {{-- <div class='row'>
                                <div class="col-md-12" style="padding-top:15px;">
                                    <div class="g-recaptcha" data-sitekey="your-site-key"></div>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-12"><br>
                                    <input class="btn btn-md btn-primary" type="submit" name="submit" value='Submit CV'>
                                </div>
                            </div>

                            <br><br><br>
                        </form>
                    </div>

                </div>

            </div>

            </div>
        </section><!-- End Contact Section -->
    @endsection
