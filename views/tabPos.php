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

<script type="text/javascript">
    var arregloDT = <?php echo json_encode(Equipos::consultarTablaPos()); ?>;
    console.log(arregloDT);
</script>

<script src="../assets/ajax/equipos.js"></script>

</head>
<body>
<?php
    include_once "components/nav.php"; //IMPRIMIR NAVEGADOR
?>
<main class="tab-pos">
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
					<h1 class="cta-title"><strong>Tabla de Posiciones</strong></h1>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.cta -->

    <section class="top-estadisticas">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <b>
                        <p>
                            PJ: Partidos Jugados &nbsp; &nbsp;|&nbsp; &nbsp;
                            PG: Partidos Ganados &nbsp; &nbsp;|&nbsp; &nbsp;
                            PE: Partidos Empatados &nbsp; &nbsp;|&nbsp; &nbsp;
                            PP: Partidos Perdidos &nbsp; &nbsp;|&nbsp; &nbsp;
                            GF: Goles a favor &nbsp; &nbsp; &nbsp;|&nbsp; &nbsp;
                            GC: Goles en contra &nbsp; &nbsp; &nbsp;|&nbsp; &nbsp;
                            +/-: Diferencia de Goles&nbsp; &nbsp;|&nbsp; &nbsp;
                            PT: Puntos Totales &nbsp; &nbsp;|&nbsp; &nbsp;
                        </p>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="posiciones-consulta">
                        <div class="table-responsive">
                            <table id="tablaPosiciones" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="color:#FFFFFF";>Posición</th>
                                        <th style="color:#FFFFFF";>Equipos</th>
                                        <th style="color:#FFFFFF";>PJ</th>
                                        <th style="color:#FFFFFF";>PG</th>
                                        <th style="color:#FFFFFF";>PE</th>
                                        <th style="color:#FFFFFF";>PP</th>
                                        <th style="color:#FFFFFF";>GF</th>
                                        <th style="color:#FFFFFF";>GC</th>
                                        <th style="color:#FFFFFF";>+/-</th>
                                        <th style="color:#FFFFFF";>PT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
    
<?php
    include_once "components/footer.php"; //IMPRIMIR FOOTER
?>

</body>
</html>