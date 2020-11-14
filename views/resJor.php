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
	<section class="light-content services">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="jornada-consulta">
						<div class="table-responsive">
							<table id="tablaJornada" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th style="color:#FFFFFF";>Local</th>
										<th style="color:#FFFFFF";>Goles</th>
										<th style="color:#FFFFFF";>Tarjetas A.</th>
										<th style="color:#FFFFFF";>Tarjetas R.</th>
										<th style="color:#FFFFFF";>Visitante</th>
										<th style="color:#FFFFFF";>Goles</th>
										<th style="color:#FFFFFF";>Tarjetas A.</th>
										<th style="color:#FFFFFF";>Tarjetas R.</th>
										<th style="color:#FFFFFF";>Horario</th>
										<th style="color:#FFFFFF";>Cancha</th>
										<th style="color:#FFFFFF";>Resultado: </th>
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