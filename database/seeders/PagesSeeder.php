<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'title' => 'Empresa',
                'url' => 'empresa',
                'section' => '1',
                'content' => '   <!--%%_start_%%-->
                                    <main id="main">

                                    <!-- ======= About Section ======= -->
                                    <section id="about" class="about">
                                        <br>
                                        <div class="row" style="background-color:#243782;">
                                        <div class="col-lg-4 text-center p-5">
                                            <br><img src="https://darcautos.org/assets/img/logo-blanco.png" width="160">
                                            <h6 class="pt-3 blanco">
                                            Somos una empresa<br>con más de 56 años en el mercado<br>orientada a satisfacer las expectativas<br>del
                                            público más exigente.
                                            </h6>
                                        </div>
                                        <div class="col-lg-8 text-center">
                                            <img src="https://darcautos.org/assets/img/empresa.jpg" width="100%" alt="">
                                        </div>
                                        </div>



                                        <div class="container">

                                        <div class="my-5 text-right">
                                            <h1 style="font-size:60px; color:#243782;"><b>Grupo D\'</b></h1>
                                        </div>

                                        <div class="row">

                                            <div class="col-lg-6">
                                            <h3>57 años en el mercado,<br>orientados a satisfacer las expectativas<br>del público más exigente </h3>
                                            <p><br> Nuestra principal actividad es la venta de vehículos 0 km de las marcas representadas y su posterior
                                                servicio postventa.
                                            </p><p>Contamos con personal especializado en el rubro automotriz en todas las áreas, lo que garantiza una
                                                excelente atención a nuestros clientes tanto particulares como empresas.

                                            </p><p>Usted encontrará en nuestras concesionarias oficiales vas a encontrar una la más amplia gama de modelos 0 KM y Usados. Dentro
                                                de las líneas que comercializamos, armamos con vos el plan de financiación que más te convenga para que
                                                puedas disfrutar tu nuevo auto de la manera más simple.

                                            </p></div>
                                            <div class="col-lg-6">
                                            <img src="https://darcautos.org/assets/img/empresa2.jpg" width="100%" alt="" data-aos="fade-up" class="aos-init aos-animate">
                                            </div>

                                        </div>



                                        <hr>

                                        <div class="row mt-4">

                                            <div class="col-lg-4">
                                            <h1 style="font-size:40px; color:#243782;"><b>Misión</b></h1>
                                            <p><br>Satisfacer las necesidades del mercado a través de la comercialización de vehículos y un servicio
                                                integral de postventa, buscando la mejora continúa de la empresa y del personal.</p>
                                            </div>
                                            <div class="col-lg-4">
                                            <h1 style="font-size:40px; color:#243782;"><b>Visión</b></h1>
                                            <p><br>Lograr ser la empresa líder de comercialización de vehículos de primera calidad y prestación de
                                                servicios de postventa.</p>
                                            </div>
                                            <div class="col-lg-4">
                                            <h1 style="font-size:40px; color:#243782;"><b>Valores</b></h1>
                                            <p><br>Excelencia | Integridad | Servicio al cliente | Mejora continua | Confiabilidad | Rentabilidad |
                                                Desarrollo personal y profesional</p>
                                            </div>
                                            <div class="col-lg-12">
                                            <h1 style="font-size:40px; color:#243782;" class="text-center"><b>Responsabilidad </b></h1>
                                            <p><br>
                                                El triunfo del Grupo Darc ha sido consecuencia de su enfoque en la planificación a largo plazo y en la
                                                adopción de medidas responsables. Por ende, como parte esencial de su estrategia, la empresa ha incorporado
                                                la sostenibilidad ambiental y social en todos los aspectos de su cadena de valor, así como la
                                                responsabilidad hacia sus productos y un compromiso sólido con la preservación de los recursos.</p>
                                            </div>

                                        </div>





                                    </div></section><!-- End About Section -->

                                    <!--%%_end_%%-->'
            ],
            [
                'title' => 'Servicios',
                'url' => 'servicios',
                'section' => '1',
                'content' => '<!--%%_start_%%-->            
                                <main id="main">

                                    <!-- ======= About Section ======= -->
                                    <section id="about" class="about">
                                        <br>
                                        <div class="row" style="background-color:#243782;">
                                        <div class="col-lg-4 text-center p-5">
                                        <br><img src="%_site_url_%/assets/img/logo-blanco.png" width="160"><h1 class="blanco">Servicios</h1>
                                            <h6 class="pt-3 blanco">
                                            Creados y diseñados para vos. Nuestros servicios te van a dar la tranquilidad y el acompañamiento que necesitás ya que están a cargo de nuestro staff de especialistas preparados para solucionar cualquier imprevisto de forma eficaz.
                                            </h6>
                                        </div>
                                        <div class="col-lg-8 text-center">
                                        <img src="%_site_url_%/assets/img/servicios.jpg" width="100%" alt="">
                                        </div>
                                        </div>

                                    
                                    
                                    <div class="container">

                                        <div class="my-5">
                                        <h1 style="font-size:60px; color:#243782;"><b>Postventa</b></h1>
                                        </div>

                                        <div class="row">

                                        <div class="col-lg-6">
                                        <h3>Cuidá tu auto en nuestros talleres. </h3>
                                        <p><br>Nuestros asesores son especialistas en tu vehículo y lo van a cuidar de la mejor forma.</p>
                                        <p>Nuestro equipo de Postventa está a tu disposición. No dudes en ponerte en contacto con nosotros.</p>
                                        <p>Seguimos evolucionando para que tu vehículo tenga la mejor atención.Los mantenimientos programados son los servicios pautados y recomendados por la marca para mantener tu auto en excelentes condiciones.</p>
                                        
                                        </div>
                                        <div class="col-lg-6">
                                        <img src="%_site_url_%/assets/img/F-serv1.jpg" width="100%" alt=""data-aos="fade-up" >
                                        </div>
                                        
                                        </div>
                                        
                                        <div class="my-5 text-right">
                                        <h1 style="font-size:60px; color:#243782;" ><b>Accesorios</b></h1>
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-6">
                                        <img src="%_site_url_%/assets/img/F-serv2.jpg" width="100%" alt=""data-aos="fade-up">
                                        </div>

                                        <div class="col-lg-6">
                                        <h3>Personalizá tu vehículo<br>con la amplia gama de accesorios originales  </h3>
                                        <p><br>Te ofrecemos una amplia gama de accesorios originales de cada marca especialmente diseñados para que tu vehículo se adapte aún más a tus necesidades. 
                                        Nuestros accesorios originales fueron creados por los ingenieros que diseñaron y fabricaron tu vehículo, es por eso que cuentan con los más altos estándares de calidad, seguridad y durabilidad.
                                        <p>
                                        </div>
                                        
                                        </div>
                                        
                                        <div class="my-5">
                                        <h1 style="font-size:60px; color:#243782;" ><b>Services Oficiales </b></h1>
                                        </div>

                                        <div class="row">

                                        <div class="col-lg-6">
                                        <h3>Mantenimiento de alta gama. </h3>
                                        <p><br>Experimentá la excelencia en nuestros talleres gracias a la proximidad y la experiencia de nuestros asesores de servicio  y técnicos especialmente capacitados para cuidar de tu vehículo.  </p>
                                        <p>Para garantizar el mejor mantenimiento de tu auto, te ofrecemos operaciones de mantenimiento con los recambios y mano de obra todo incluido.</p>
                                        </div>
                                        <div class="col-lg-6">
                                        <img src="%_site_url_%/assets/img/F-serv3.jpg" width="100%" alt="" data-aos="fade-up">
                                        </div>
                                        
                                        </div>

                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    </section><!-- End About Section -->
                                <!--%%_end_%%-->'
            ],


        ];


        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
