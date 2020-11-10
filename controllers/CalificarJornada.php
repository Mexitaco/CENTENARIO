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

