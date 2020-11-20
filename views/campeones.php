<?php 
    //IMPORTAR VERIFICADORES DE ACCESO
    include_once "../auth/Session.php" ;
	include_once "../auth/AuthSession.php";
	include_once "../models/Equipo.php";

    if(AuthSession::getUsuario() == null){
        header('Location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="en-spa">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>LIGA DE FUTBOL</title>

	<?php 
		include_once "./components/js.html";   //CARGAR LOS JS
		include "components/css.html";   //CARGAR LOS CSS
	?>
	<script>
    
		const campeones = <?php  echo json_encode(Equipo::equipoCampeon()); ?>;
		
	</script>
	<script src="../assets/ajax/ganador.js"></script>

    <link rel="stylesheet" href="../assets/front/css/ganador.css">
</head>
<body>

<?php
	include_once "components/nav.php"; //IMPRIMIR NAVEGADOR
	include_once "components/loader.html"; //IMPRIMIR NAVEGADOR
?>

<main class="">
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
					<h1 class="cta-title"><strong>Historial de campeones</strong></h1>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.cta -->

	<section class="light-content services">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
                    <div class="trofeo-container">
                        <div class="lugar">
                            <div class="primero">
								<div class="estrella"></div>
								<div class="estrella2"></div>
								<div class="estrella3"></div>
								<div class="estrella4"></div>
							</div>
							<h4 id="nombre_primer_lugar"></h4>
							<p id="puntos_primer_lugar" class="bold">Pts: </p>
						</div>
						<div class="lugares">
							<div class="lugar2">
								<div class="segundo">
									<div class="estrella"></div>
									<div class="estrella2"></div>
									<div class="estrella3"></div>
									<div class="estrella4"></div>
								</div>
								<h4 id="nombre_segundo_lugar"></h4>
								<p id="puntos_segundo_lugar" class="bold">Pts: </p>
							</div>
							<div class="lugar3">
								<div class="tercero">
								<div class="estrella"></div>
								<div class="estrella2"></div>
								<div class="estrella3"></div>
								<div class="estrella4"></div>
								</div>
								<h4 id="nombre_tercer_lugar"></h4>
								<p id="puntos_tercer_lugar" class="bold">Pts: </p>
							</div>
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
