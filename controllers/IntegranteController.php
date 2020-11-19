<?php 
include_once "../models/Integrante.php";
include_once "../auth/Session.php" ;
include_once "../auth/AuthSession.php";

if(AuthSession::getUsuario() == null){
    header('Location: ../views/login.php');
}

$sw;


if(isset($_GET["consulta"])){
    $sw = 1;
}

if(isset($_GET["integrante"])) {
    //echo 'eliminar';
    $sw = 2;
}

switch ($sw) {

    case 1:

        if(isset($_GET["consulta"])){

            $integrante = new Integrante();
            $id = $_GET['id'];
            $response = $integrante->consultarIntegrantes($id);
            
            echo json_encode( $response);
        }

    break;
    
    case 2:
        
        if (isset($_GET["integrante"])) {

            if($_GET["integrante"] != NULL && $_GET["integrante"] != "" && $_GET["integrante"] == "true") {

                if (
                    isset($_POST['id_inte']) &&
                    isset($_POST['nom_inte']) &&
                    isset($_POST['num_camisa']) &&
                    isset($_POST['id_equipo']) &&
                    $_POST['id_inte'] != "" &&
                    $_POST['nom_inte'] != "" &&
                    $_POST['num_camisa'] != "" &&
                    $_POST['id_equipo'] != "" &&
                    $_POST['id_inte'] != NULL &&
                    $_POST['nom_inte'] != NULL &&
                    $_POST['num_camisa'] != NULL &&
                    $_POST['id_equipo'] != NULL
                ) {
                    
                    $id = (int) $_POST['id_inte'];
                    $nombre = (string) $_POST['nom_inte'];
                    $camisa = (int) $_POST['num_camisa'];
                    $id_equipo = (int) $_POST['id_equipo'];

                    $integrante = new Integrante();

                    $flag_camisa = $integrante->verificarCamisa($id_equipo, $camisa);

                    if ($flag_camisa == true) {

                        $integrante->setId($id);
                        $integrante->setNombre_integrante($nombre);
                        $integrante->setNum_camisa($camisa);
                    
                        $response = $integrante->actualizarIntegrante();

                        echo json_encode($response);

                    } else {
                        http_response_code(424);
                        echo json_encode(["error" => true, "message" => "Ya existe un jugador con ese número de camisa"]); 
                    }

                } else {
                    http_response_code(424);
                    echo json_encode(["error" => true, "message" => "Valor no admitido"]);    
                }

            } else {
                http_response_code(424);
                echo json_encode(["error" => true, "message" => "Parámetros no válidos"]);
            }

        } else {
            http_response_code(400);
            echo json_encode(["error" => true, "message" => "Error en la solitud"]);
        }

        break;

}

