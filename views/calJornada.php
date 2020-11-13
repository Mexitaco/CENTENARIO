<?php 
    //IMPORTAR VERIFICADORES DE ACCESO
    include_once "../auth/Session.php" ;
	include_once "../auth/AuthSession.php";
	include_once "../models/CalificarJornada.php";
	

    if(AuthSession::getUsuario() == null){
        header('Location: login.php');
    }

    if (isset($_GET['id']) && isset($_GET['el'])  && isset($_GET['ev'])) {

		$id = $_GET['id'];
		$idLocal = $_GET['el'];
		$idVisitante = $_GET['ev'];

		$calJornada = new CalificarJornada();

    }
    
?>

<!DOCTYPE html>
<html lang="en-spa">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>LIGA DE FUTBOL</title>

	<?php 
		include "components/css.html";   //CARGAR LOS CSS
		include_once "./components/js.html";   //CARGAR LOS JS
	?>

	<link rel="stylesheet" href="../assets/front/css/calJornada.css">

	<script type="text/javascript">

	var resPartido = <?php echo json_encode(CalificarJornada::partido($id)); ?>;
	console.log(resPartido);

	</script>	

</head>
<body>

<?php
	include_once "components/nav.php"; //IMPRIMIR NAVEGADOR
	include_once "components/loader.html";
?>

<main class="calJornada-section">
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
		<div class="container" style="padding: 0;">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<h1 class="cta-title"><strong>Calificar partido</strong></h1>
					</div>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container  style="padding: 0;"-->
	</section> <!-- /.cta -->

	<section class="light-content services">
		<div class="container" style="padding: 0;">
			<div class="row">
				<div class="col-xs-5">
					<div class="text-center calJorTitulo">
						<h1 class="bold" id="nombreEquipoLocal"></h1>
					</div>
				</div>
				<div class="col-xs-2">
					<div class="text-center calJorTitulo">
						<h4 class="bold" id="cancha" style="margin: 15px 0 0 0;"></h4>
						<h4 class="bold" id="horario" style="margin: 15px 0 0 0;"></h4>
					</div>
				</div>
				<div class="col-xs-5">
					<div class="text-center calJorTitulo">
						<h1 class="bold" id="nombreEquipoVisitante"></h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-calJornada">
						<form class="form-calificar-jornada">
							<div class="row">
								<div class="col-xs-5">
									<input type="text" name="idJornada" value="<?php echo $id; ?>" class="hid">
									<input type="text" name="idLocal" value="<?php echo $idLocal; ?>" class="hid">
									<div class="new-anotador-local">
										<div class="inclinar-1">
											<div class="form-group">
												<label for="goles_local" class="bold">Goles</label><i style="margin-left: 15px" class="fas fa-futbol"></i>
												<select id="goles_local" class="form-control" name="select_goles_local[]" style="">
													<option value="0" selected="selected">Seleccione un jugador</option>
													<?php 
														$calJornada->jugador($idLocal);
													?>
												</select>
											</div>
											<button id="new-goles-local" type="button" class="btn btn-more more-info fas fa-plus"></button>
										</div>
									</div>
									<div class="new-goles-local"></div>
									<div class="new-amolestado-amarillo-local">
										<div class="inclinar-1">
											<div class="form-group">
												<label for="tAmarillas_local" class="bold">Tarjetas <span class="tAmarillas">&nbsp;&nbsp;</span></label>
												<select id="tAmarillas_local" class="form-control" name="select_amarillas_local[]" style="">
													<option value="0" selected="selected">Seleccione un jugador</option>
													<?php 
														$calJornada->jugador($idLocal);
													?>
												</select>
											</div>
											<button id="new-tarAma-local" type="button" class="btn btn-more more-info fas fa-plus"></button>
										</div>
									</div>	
									<div class="new-tarAma-local"></div>
									<div class="new-amolestado-roja-local">
										<div class="inclinar-1">
											<div class="form-group">
												<label for="tRojas_local" class="bold">Tarjetas <span class="tRojas">&nbsp;&nbsp;</span></label>
												<select id="tRojas_local" class="form-control" name="select_rojas_local[]" style="">
													<option value="0" selected="selected">Seleccione un jugador</option>
													<?php 
														$calJornada->jugador($idLocal);
													?>
												</select>
											</div>
											<button id="new-tarRoj-local" type="button" class="btn btn-more more-info fas fa-plus"></button>
										</div>
									</div>
									<div class="new-tarRoj-local"></div>
								</div>
								<div class="col-xs-2">
									<div class="text-center">
										<h1 class="bold" >VS</h1>
									</div>
								</div>
								<div class="col-xs-5">
								<input type="text" name="idVisitante" value="<?php echo $idVisitante; ?>" class="hid">
									<div class="new-anotador-visitante">
										<div class="inclinar-2">
											<button id="new-goles-visitante" type="button" class="btn btn-more more-info fas fa-plus"></button>
											<div class="form-group">
												<label for="goles_visitante" class="bold">Goles</label><i style="margin-left: 15px" class="fas fa-futbol"></i>
												<select id="goles_visitante" class="form-control" name="select_goles_visitante[]" style="">
													<option value="0" selected="selected">Seleccione un jugador</option>
													<?php 
														$calJornada->jugador($idVisitante);
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="new-goles-visitante"></div>
									<div class="new-amolestado-amarillo-visitante">
										<div class="inclinar-2">
											<button id="new-tarAma-visitante" type="button" class="btn btn-more more-info fas fa-plus"></button>
											<div class="form-group">
												<label for="tAmarillas_visitante" class="bold">Tarjetas <span class="tAmarillas">&nbsp;&nbsp;</span></label>
												<select id="tAmarillas_visitante" class="form-control" name="select_amarillas_visitante[]" style="">
													<option value="0" selected="selected">Seleccione un jugador</option>
													<?php 
														$calJornada->jugador($idVisitante);
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="new-tarAma-visitante"></div>
									<div class="new-amolestado-roja-visitante">
										<div class="inclinar-2">
											<button id="new-tarRoj-visitante" type="button" class="btn btn-more more-info fas fa-plus"></button>
											<div class="form-group">
												<label for="tRojas_visitante" class="bold">Tarjetas <span class="tRojas">&nbsp;&nbsp;</span></label>
												<select id="tRojas_visitante" class="form-control" name="select_rojas_visitante[]" style="">
													<option value="0" selected="selected">Seleccione un jugador</option>
													<?php 
														$calJornada->jugador($idVisitante);
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="new-tarRoj-visitante"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<div class="text-center save-calJ">
										<buttton type="submit" class="btn btn-more enviarTodo">Enviar <i style="margin-left: 10px" class="fas fa-save"></i></buttton>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
	include_once "components/footer.php"; //IMPRIMIR FOOTER
?>
<script src="../assets/ajax/caljornada.js"></script>
</body>
</html>
