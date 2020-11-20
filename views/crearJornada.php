<?php 
    //IMPORTAR VERIFICADORES DE ACCESO
    include_once "../auth/Session.php" ;
	include_once "../auth/AuthSession.php";
	include_once "../models/Jornada.php";

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

</head>
<body>

<?php
	include_once "components/nav.php"; //IMPRIMIR NAVEGADOR
	include_once "components/loader.html";
?>

<main class="finanzas-section">
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
					<h1 class="cta-title"><strong>Opciones</strong></h1>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.cta -->

	<section class="light-content services" style="margin: 50px 0;">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<form class="form-jornada">
						<div class="text-center">
							<input type="text" class="form-control" name="jornada" value="jornada" style="display: none;">
							<button type="submit" class="btn btn-primary btn-lg">Reiniciar liga</button>
						</div>
					</form>
				</div>
				<!-- <div class="col-xs-6">
					<div class="text-center">
						<form class="form-terminar-jornada">
							<input type="text" class="form-control" name="terminar" value="terminar" style="display: none;">
							<button type="submit" class="btn btn-danger btn-lg">Terminar liga</button>
						</form>
					</div>
				</div> -->
			</div>
		</div>
	</section>
</main>

<?php
	include_once "components/footer.php"; //IMPRIMIR FOOTER
?>
<script src="../assets/ajax/jornada.js"></script>
</body>
</html>
