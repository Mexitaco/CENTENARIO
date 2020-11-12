<?php 
    //IMPORTAR VERIFICADORES DE ACCESO
    include_once "../auth/Session.php" ;
    include_once "../auth/AuthSession.php";
	include_once "../models/Equipos.php";

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
                <div class="row">
                    <div class="col-md-12">
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.parallax-overlay -->
    </section> <!-- /#homeIntro -->

    <section class="cta clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="cta-title"><strong>Estadísticas de la Ligas</strong></h1>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section> <!-- /.cta -->

    <section class="top-estadisticas">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h4>Top 5 Goleadores</h4>
                    <table>
                        <thead>
                            <tr>
                                <th style="color:#FFFFFF";>Equipo</th>
                                <th style="color:#FFFFFF";>Número</th>
                                <th style="color:#FFFFFF";>Goles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $topGol = implode(Equipos::consultarTopGol());
                                echo $topGol;

                            ?>
                       </tbody>
                    </table>
                </div>
            </div>
            <div style="margin: 30px 0;"></div>
            <div class="row">
                <div class="col-xs-12">
                    <h4>Top 5 tarjetas amarillas</h4>
                    <table>
                        <thead>
                            <tr>
                                <th style="color:#FFFFFF";>Equipo</th>
                                <th style="color:#FFFFFF";>Número</th>
                                <th style="color:#FFFFFF";>Faltas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $topAma = implode(Equipos::consultarTopTarAma());
                                echo $topAma;

                            ?>
                       </tbody>
                    </table>
                </div>
            </div>
            <div style="margin: 30px 0;"></div>
            <div class="row">
                <div class="col-xs-12">
                    <h4>Top 5 tarjetas rojas</h4>
                    <table>
                        <thead>
                            <tr>
                                <th style="color:#FFFFFF";>Equipo</th>
                                <th style="color:#FFFFFF";>Número</th>
                                <th style="color:#FFFFFF";>Faltas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $topRoj = implode(Equipos::consultarTopTarRoj());
                                echo $topRoj;

                            ?>
                       </tbody>
                    </table>
                </div>
            </div>
            <div style="margin: 30px 0;"></div>
        </div>
    </section>
</main>
    
<?php
    include_once "components/footer.php"; //IMPRIMIR FOOTER
?>

</body>
</html>
    