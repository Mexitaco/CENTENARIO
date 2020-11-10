<?php 
    //IMPORTAR VERIFICADORES DE ACCESO
    include_once "../auth/Session.php" ;
    include_once "../auth/AuthSession.php";

    if(AuthSession::getUsuario() == null){
        header('Location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="es-spa">
    <head>
        <title>LIGA DE FUTBOL</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />

        <?php 
            include_once "./components/js.html";   //CARGAR LOS JS
            include "components/css.html";   //CARGAR LOS CSS
        ?>

    </head>
    <body>
        <?php
            include_once "components/nav.php"; //IMPRIMIR NAVEGADOR
        ?>
        <main>
            <!-- AQUÍ VA EL CONTENIDO DEL MENÚ PRINCIPAL -->
            <section id="homeIntro" class="parallax first-widget">
                <div class="parallax-overlay">
                    <div class="container home-intro-content">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>El talento gana partidos, pero el trabajo en equipo y la inteligencia ganas campeonatos </h2>
                            </div> <!-- /.col-md-12 -->
                        </div> <!-- /.row -->
                    </div> <!-- /.container -->
                </div> <!-- /.parallax-overlay -->
            </section> <!-- /#homeIntro -->

            <section class="cta clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="cta-title"><strong>Avisos</strong></h1>
                        </div> <!-- /.col-md-12 -->
                    </div> <!-- /.row -->
                </div> <!-- /.container -->
            </section> <!-- /.cta -->

            <section class="light-content services">
                <div class="container">
                    <div class="row">

                        <div class="col-md-4 col-sm-4">
                            <div class="service-box-wrap">
                                <div class="service-icon-wrap">
                                </div> <!-- /.service-icon-wrap -->
                                <div class="service-cnt-wrap">
                                    <h3 class="service-title">¿Cada cuándo habrá nuevos avisos?</h3>
                                    <p>Serán los mismos días que se llevaban a cabo las juntas, miércoles para las ligas juveniles y viernes para las ligas mayores.</p>
                                </div> <!-- /.service-cnt-wrap -->
                            </div> <!-- /.service-box-wrap -->
                        </div> <!-- /.col-md-4 -->

                        <div class="col-md-4 col-sm-4">
                            <div class="service-box-wrap">
                                <div class="service-icon-wrap">
                                </div> <!-- /.service-icon-wrap -->
                                <div class="service-cnt-wrap">
                                    <h3 class="service-title">¿Cada cuándo se actualizará la tabla de ligas?</h3>
                                    <p>Cada 15 días en sábado a las 7:00 PM las ligas juveniles y en Domingo a las 7:00 PM las ligas mayores.</p>
                                </div> <!-- /.service-cnt-wrap -->
                            </div> <!-- /.service-box-wrap -->
                        </div> <!-- /.col-md-4 -->

                        <div class="col-md-4 col-sm-4">
                            <div class="service-box-wrap">
                                <div class="service-icon-wrap">
                                </div> <!-- /.service-icon-wrap -->
                                <div class="service-cnt-wrap">
                                    <h3 class="service-title">¿Los pagos de arbitraje como se realizarán?</h3>
                                    <p>Sera depositando a mi cuenta bancaria con el fin de evitar el constante contacto con las manos y el dinero.</p>
                                </div> <!-- /.service-cnt-wrap -->
                            </div> <!-- /.service-box-wrap -->
                        </div> <!-- /.col-md-4 -->
                    </div>
                </div>
            </section>
        </main>

        <?php
            include_once "components/footer.php"; //IMPRIMIR FOOTER
        ?>

    </body>
</html>