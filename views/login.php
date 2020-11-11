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
</head>

<style>

	.login{
		display: flex;
    	width: 100%;
	}

	.fondo {
		background-image: url("../assets/front/images/includes/motivacion.jpg");
		background-size: cover;
		background-position: center center;
		height: 100vh;
		width: 60%;
		background-repeat: no-repeat;
	}

	.filtro {
		background-color: rgba(0,0,0,0.4);
		width: 100%;
    	height: 100%;
    	box-shadow: inset 0px 0px 120px rgb(0 0 0 / 85%);
	}

	h1{
		margin: 0;
		padding: 0;
	}

	.filtro h1 {
		width: inherit;
    	height: inherit;
		color: #ffff;
		text-transform: uppercase;
		font-size: 5rem;
		font-weight: 300;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.login-form {
		width: 40%;
		height: 100vh;
		display: flex;
		justify-content: center;
		align-items: center;
		flex-direction: column;
		box-shadow: 0 0, inset 1rem 0rem 1.5rem rgb(0 0 0 / 22%);
	}

	.login-form > * {
		margin: 15px 0;
	}

	.bold {
		font-weight: bold;
	}
</style>

<body>

<?php
	include_once "components/loader.html";
?>

<div class="login">
	<div class="fondo"><div class="filtro"><h1>Centenario</h1></div></div>
	<div class="login-form">
		<h3 class="h3 bold">Inicio de Sesión</h3>
		<form class="formlogin">
			<div class="form-group">
				<label class="bold">Usuario</label>
				<input required type="text" name="usuario" class="form-control" placeholder="">
			</div>
			<div class="form-group">
				<label class="bold">Contraseña</label>
				<input required type="password" name="password" class="form-control" placeholder="">
			</div>
			<input type="hidden" name="iniciarSesion" value="1">
			<div class="login-buttons">
				<button type="submit" class="btn btn-success btn-block btn-lg">
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