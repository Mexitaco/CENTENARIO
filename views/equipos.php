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

	<script type="text/javascript">

	/*
		ESTE ES EL ARREGLO QUE VA A CARGAR TODA LA INFO DE LAS TABLAS AL DATA TABLE,
		PERO ANTES USUAMOS EL MÉTODO CONSULTAR PARA TRAER LA INFORMACIÓN Y CONVERTIRLA
		EN UN OBJETO JSON PARA QUE EL DATA TABLE PUEDA MOSTRARLO
	*/
	var arregloDT;

	</script>

	<script src="../assets/ajax/equipos.js"></script>
</head>
<body>

<?php
	include_once "components/nav.php"; //IMPRIMIR NAVEGADOR
	include_once "components/loader.html"; //IMPRIMIR NAVEGADOR
?>

<main class="equipos-consulta">
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
					<h1 class="cta-title"><strong>Equipos</strong></h1>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.cta -->

	<section class="light-content services">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-inline" style="margin: 0 0 50px 20px;">
						<label class="bold" for="nuevo-equipo">Nuevo Equipo </label>
						<button type="button" class="new-equipo btn btn-primary btn-lg" data-toggle="modal" 
							title="Crear equipo" id="nuevo-equipo" data-target="#modEquipo" style="margin-left: 45px;">
							Abrir
						</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table id="equipo-consulta" class="table" cellspacing="2" width="100%">
							<thead>
								<tr>
									<th style="color:#FFFFFF";>Equipo</th>
									<th style="color:#FFFFFF";>Partidos ganados</th>
									<th style="color:#FFFFFF";>Partidos perdidos</th>
									<th style="color:#FFFFFF";>Partidos empatados</th>
									<th style="color:#FFFFFF";>Modificar</th>
									<th style="color:#FFFFFF";>Historial</th>
									<th style="color:#FFFFFF";>Jugadores</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
	include_once "components/footer.php"; //IMPRIMIR FOOTER
?>

<!-- Modal -->
<div class="modal fade" id="modEquipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title bold" id="myModalLabel">Equipo   <small>Recuerde que sólo pueden existir 14 equipos activos</small></h4>
			</div>
			<div class="modal-body">
				<form class="form-equipo">
					<div class="form-group">
					<label id="title_modal_equipo" class="bold" for=""></label>
						<input id="nombre_equipo" name="nombre_equipo" value="" type="text" class="form-control">
						<input type="text" class="form-control hid" name="nom_pas_equipo" value="" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control hid mod_equipo" name="mod_equipo" value="" required>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary btn-lg mod_equipo">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

</body>
</html>
