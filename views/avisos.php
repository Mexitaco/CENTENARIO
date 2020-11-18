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
<html lang="en-spa">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>LIGA DE FUTBOL</title>

	<?php 
		include_once "./components/js.html";   //CARGAR LOS JS
		include "components/css.html";   //CARGAR LOS CSS
	?>

	<script src="../assets/ajax/avisos.js"></script>

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
					<h1 class="cta-title"><strong>Avisos</strong></h1>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.cta -->

	<section class="light-content services">
		<div class="container">
		<div class="row">
				<div class="col-xs-12">
					<div class="form-inline" style="margin: 0 0 50px 20px;">
						<label class="bold" for="nuevo-aviso">Nuevo aviso </label>
						<button type="button" class="new-equipo btn btn-primary btn-lg" data-toggle="modal" 
							title="Crear equipo" id="nuevo-aviso" data-target="#mod-avisos" style="margin-left: 45px;">
							Abrir
						</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table id="tablaAvisos" class="table" cellspacing="2" width="100%">
							<thead>
								<tr>
								    <th style="color:#FFFFFF">ID</th>
									<th style="color:#FFFFFF">Titulo</th>
									<th style="color:#FFFFFF">Mensaje</th>
									<th style="color:#FFFFFF">Modificar</th>
									<th style="color:#FFFFFF">Eliminar</th>
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
<div class="modal fade" id="mod-avisos" tabindex="-1" role="dialog" aria-labelledby="title_modal_aviso">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="title_modal_aviso"></h4>
			</div>
			<div class="modal-body">
				<form class="form-avisos">
					<div class="form-group">
						<input type="text" class="form-control hid" id="id_aviso" name="id_aviso" value="" required>
						<input type="text" class="form-control hid" id="mod_aviso" name="mod_aviso" value="" required>
						<label class="bold" for="titulo">Título</label>
						<input type="text" class="form-control" id="titulo" name="titulo" value="" required>
					</div>
					<div class="form-group">
						<label class="bold" for="titulo">Mensaje</label>
						<textarea id="mensaje" name="mensaje" class="form-control" value="" rows="3" required></textarea>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary btn-lg btn-enviar-aviso">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

</body>
</html>
