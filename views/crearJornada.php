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

	<script src="../assets/ajax/jornada.js"></script>

</head>
<body>

<?php
	include_once "components/nav.php"; //IMPRIMIR NAVEGADOR
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
					<h1 class="cta-title"><strong>Ingresos</strong></h1>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.cta -->

	<section class="light-content services">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<form action="" class="form-jornada">
						<input type="text" name="jornada" value="jornada" style="display: none;">
						<button class="btn btn-primary btn-lg">Crear Jornada</button>
					</form>
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
