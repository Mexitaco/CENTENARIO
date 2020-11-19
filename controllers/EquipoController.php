<?php 

include_once "../models/Equipo.php";
include_once "../auth/Session.php" ;
include_once "../auth/AuthSession.php";

if(AuthSession::getUsuario() == null){
    header('Location: ../views/login.php');
}

$sw;

if (isset($_GET['consulta'])) {
    $sw = 1;
}

if (isset($_GET["equipo"])) {
    $sw = 2;
}

switch ($sw) {
    
    case 1:
    
        if (isset($_GET['consulta'])) {

            $equipo = new Equipo();
            $response = $equipo->consultarEquipos();
            echo json_encode($response);

        }

    break;

    case 2:

        if(isset($_GET["equipo"])){

            if ($_GET["equipo"] == 'true') {
                
                if (isset($_POST['mod_equipo']) && $_POST['mod_equipo'] != "" && $_POST['mod_equipo'] != NULL ) {
                    
                    if ($_POST['mod_equipo'] == 'true') {
                
                        if (isset($_POST['nombre_equipo']) 
                            &&  $_POST['nombre_equipo'] != ""
                            && $_POST['nombre_equipo'] != NULL
                            && isset($_POST['nom_pas_equipo'])
                            && $_POST['nom_pas_equipo'] != ""
                            && $_POST['nom_pas_equipo'] != NULL
                        
                        ) {
                    
                            $equipo = new Equipo();
        
                            $nuevo_equipo = (string) $_POST['nombre_equipo'];
                            $nombre_equipo = (string) $_POST['nom_pas_equipo'];
                    
                            $equipo->setNombre_equipo($nombre_equipo);
                            $equipo->setNuevo_equipo($nuevo_equipo);
        
                            $respuesta = $equipo->actualizarEquipo();
                            echo json_encode($respuesta);
                        
                        } else {
                            http_response_code(424);
                            echo json_encode(["error" => true, "message" => "Valor no admitido"]);    
                        }
        
                    } else if($_POST['mod_equipo'] == 'false') {
                
                        if (isset($_POST['nombre_equipo']) && $_POST['nombre_equipo'] != "") {
                    
                            $equipo = new Equipo();
        
                            $nombre_equipo = (string) $_POST['nombre_equipo'];
                    
                            $equipo->setNombre_equipo($nombre_equipo);
                            
                            $response = $equipo->verificarEquipo();
                    
                            if ($response == true) {
                    
                                $equipo->setNombre_equipo($nombre_equipo);        
                                $respuesta = $equipo->crearEquipo();
                                echo json_encode($respuesta);
                    
                            } else {
                                http_response_code(409);
                                echo json_encode(["error" => true, "message" => "Ya existe un equipo con ese nombre"]);
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
                    http_response_code(424);
                    echo json_encode(["error" => true, "message" => "Parámetros no válidos"]);
                }
        
            } else {
                http_response_code(400);
                echo json_encode(["error" => true, "message" => "Hubo un error al procesar la solicitud"]);
            }
            
        } else {
            http_response_code(400);
            echo json_encode(["error" => true, "message" => "Error en la solitud"]);
        }

    break;

}
