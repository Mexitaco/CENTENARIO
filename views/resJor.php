<?php 
    //IMPORTAR VERIFICADORES DE ACCESO
    include_once "../auth/Session.php" ;
    include_once "../auth/AuthSession.php";
	include_once "../models/Jornada.php";

    if(AuthSession::getUsuario() == null){
        header('Location: login.php');
    }

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
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
		var arregloDT = <?php echo json_encode(Jornada::consultaVerMas($id)); ?>;
		console.log(arregloDT);
	</script>

	<script src="../assets/ajax/jornada.js"></script>

</head>
<body>

<?php
	include_once "components/nav.php"; //IMPRIMIR NAVEGADOR
	include_once "components/loader.html";
?>

<main>
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
                    <h1 class="cta-title"><strong>Resultado del partido </strong></h1>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section> <!-- /.cta -->
	<!-- AQUÍ VA EL CONTENIDO DEL MENÚ PRINCIPAL -->
	<section class="light-content services" style="margin-bottom: 50px;">
		<div class="container">

			<div class="row">
				<div class="col-xs-12">						
					<table>
						<thead>
							<tr>
								<th style="color:#FFFFFF";>Local</th>
								<th style="color:#FFFFFF";>Goles</th>
								<th style="color:#FFFFFF";>Tarjetas A.</th>
								<th style="color:#FFFFFF";>Tarjetas R.</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th id="local_nombre"></th>
								<th id="local_goles"></th>
								<th id="local_tarAma"></th>
								<th id="local_tarRoj"></th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<div class="text-center">
						<p id="goles" class="bold"></p>
						<p id="cancha" class="bold"></p>
						<p id="num_jornada" class="bold"></p>
						<p id="equipo_ganador" class="bold">: </p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<table>
						<thead>
							<tr>
								<th style="color:#FFFFFF";>Visitante</th>
								<th style="color:#FFFFFF";>Goles</th>
								<th style="color:#FFFFFF";>Tarjetas A.</th>
								<th style="color:#FFFFFF";>Tarjetas R.</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th id="visitante_nombre"></th>
								<th id="visitante_goles"></th>
								<th id="visitante_tarAma"></th>
								<th id="visitante_tarRoj"></th>
							</tr>
						</tbody>
					</table>
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