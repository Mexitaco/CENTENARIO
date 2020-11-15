<?php 
    //IMPORTAR VERIFICADORES DE ACCESO
    include_once "../auth/Session.php" ;
	include_once "../auth/AuthSession.php";
	include_once "../models/Pago.php";
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

	<script type="text/javascript">

	/*
		ESTE ES EL ARREGLO QUE VA A CARGAR TODA LA INFO DE LAS TABLAS AL DATA TABLE,
		PERO ANTES USUAMOS EL MÉTODO CONSULTAR PARA TRAER LA INFORMACIÓN Y CONVERTIRLA
		EN UN OBJETO JSON PARA QUE EL DATA TABLE PUEDA MOSTRARLO
	*/
	var arregloDT = <?php echo json_encode(Pago::consultar()); ?>;
	console.log(arregloDT);

	</script>

	<script src="../assets/ajax/pagos.js"></script>

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
					<h1 class="cta-title"><strong>Ingresos</strong></h1>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.cta -->

	<section class="light-content services">
		<div class="container">
			<div class="row">
				<div class="col-xs-12" style="padding: 0 40px;">
					<div class="elejir-equipo">
						<label for="equipos" class="bold"> Elije un Equipo:</label>
						<select id="equipos" class="form-control" name="entradalista1" style="color:#000000; width: 50%;">
							<option value="0" selected="selected">Seleccione un equipo</option>
						
							<?php

								$equipos = implode(Equipo::consultarNombreEquipo());
								echo $equipos;

							?>

						</select>
						<!-- Button modal -->
						<button type="button" class="btn btn-primary hid" data-toggle="modal" id="mod" data-target="#myModal" style="margin-left: 15px;">
							Nuevo
						</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<table id="tablaFinanzas" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="color:#FFFFFF";>Equipo</th>
								<th style="color:#FFFFFF";>Fecha de pago</th>
								<th style="color:#FFFFFF";>Abono</th>
								<th style="color:#FFFFFF";>Total</th>
								<th style="color:#FFFFFF";>Restante</th>
							</tr>
						</thead>
						<tbody>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Añadir abono</h4>
			</div>
			<div class="modal-body">
				<form class="form-pagos">
					<div class="form-group">
						<label for="abono">Abono</label>
						<input type="number" class="form-control input-lg" id="abono" name="abono" min="1" max="7000" placeholder="Ejemplo: 100" required>
					</div>
					<div class="form-group">
						<input type="number" id="equipo" name="equipo" class="equipo" style="display: none;">
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary btn-lg">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

</body>
</html>
