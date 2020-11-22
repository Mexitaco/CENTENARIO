<?php 
    //IMPORTAR VERIFICADORES DE ACCESO
    include_once "../auth/Session.php" ;
	include_once "../auth/AuthSession.php";
	include_once "../models/Integrante.php";

    if(AuthSession::getUsuario() == null){
        header('Location: login.php');
    }

    if (isset($_GET['id'])) {
		$id = $_GET['id'];
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
        var idt = <?php  echo $id; ?>;
        console.log(idt);
    </script>

	<script src="../assets/ajax/integrantes.js"></script>

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
					<h1 class="cta-title"><strong>Jugadores</strong></h1>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.cta -->

	<section class="light-content services">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive" style="margin-bottom: 30px;">
						<table id="tablaIntegrantes" class="table" cellspacing="2" width="100%">
							<thead>
								<tr>
								    <th style="color:#FFFFFF">Total</th>
									<th style="color:#FFFFFF">Nombre</th>
									<th style="color:#FFFFFF">Número de camisa</th>
									<th style="color:#FFFFFF">Modificar</th>
									<!-- <th style="color:#FFFFFF">Eliminar</th> -->
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
<div class="modal fade" id="mod-integrante" tabindex="-1" role="dialog" aria-labelledby="title_modal_integrante">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="title_modal_integrante">Actualizar jugador</h4>
			</div>
			<div class="modal-body">
				<form class="form-integrantes">
					<div class="form-group">
                        <input type="text" class="form-control hid" id="id_inte" name="id_inte" required>
                        <input type="text" class="form-control hid" id="id_equipo" name="id_equipo" value="<?php echo $id; ?>"  required>
						<label class="bold" for="titulo">Nombre</label>
						<input type="text" class="form-control" id="nom_inte" name="nom_inte" required>
					</div>
					<div class="form-group">
						<label class="bold" for="titulo">Número de camisa</label>
						<input type="number" min="1" class="form-control" id="num_camisa" name="num_camisa" required>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary btn-lg btn-enviar-inte">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

</body>
</html>
