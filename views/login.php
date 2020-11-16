<?php
    // include_once "../auth/Session.php";
    include_once "../auth/AuthSession.php";

    if(isset($_GET["cerrar_session"])){
        AuthSession::cerrarSession();
    }

    if(AuthSession::getUsuario() != null){
        header('Location: index.php');
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Login</title>
	<?php 
		include "components/css.html";   //CARGAR LOS CSS
		include_once "./components/js.html";   //CARGAR LOS JS
    ?>
	<script type="text/javascript" src="../assets/ajax/login.js"></script>
	<link rel="stylesheet" href="../assets/front/css/login.css">
</head>

<body>

<?php
	include_once "components/loader.html";
?>

<div class="login">
	<div class="fondo">
		<div class="filtro">
			<!-- <h1>Centenario</h1> -->
			<div class="animacion">
				<div class="size-animacion">
					<div class="balon">
						<div class="balon-girando"></div>
					</div>
					<div class="alas"></div>
					<div class="cinta"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="login-form">
		<h3 class="h3 bold">Inicio de Sesión</h3>
		<form class="formlogin">
			<div class="form-group">
				<label class="bold"><i class="fas fa-user bg-login"></i> Usuario</label>
				<input required type="text" name="usuario" class="form-control" placeholder="">
			</div>
			<div class="form-group">
				<label class="bold"><i class="fas fa-unlock bg-login"></i> Contraseña</label>
				<input required type="password" name="password" class="form-control" placeholder="">
			</div>
			<input type="hidden" name="iniciarSesion" value="1">
			<div class="login-buttons">
				<button type="submit" class="btn btn-cen btn-lg">
					Enviar
				</button>
			</div>
		</form>
	</div>	
</div>
<script src="../assets/front/js/jquery-1.10.2.min.js"></script>
<script src="../assets/front/js/loader.js"></script>
</body>
</html>