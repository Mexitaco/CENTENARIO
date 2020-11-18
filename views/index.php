<?php 
    //IMPORTAR VERIFICADORES DE ACCESO
    include_once "../auth/Session.php" ;
    include_once "../auth/AuthSession.php";
    include_once "../models/Aviso.php";

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

                    <?php

                        $avisos = implode("", Aviso::mostrarAvisos());
                        echo $avisos;
                    
                    ?>
                      
                    </div>
                </div>
            </section>
        </main>

        <?php
            include_once "components/footer.php"; //IMPRIMIR FOOTER
        ?>

    </body>
</html>