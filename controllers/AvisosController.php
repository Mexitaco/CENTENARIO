<?php 
include_once "../models/Aviso.php";

$sw;

if(isset($_GET["eliminar"])) {
    //echo 'eliminar';
    $sw = 1;
}


if(isset($_GET["aviso"])) {
    //echo 'aviso';

    $sw = 2;
}

switch ($sw) {
    case 1:
        if(isset($_GET["eliminar"])){

            if ($_GET["eliminar"] != "" && $_GET["eliminar"] != NULL && $_GET["eliminar"] == 'true') {
        
                if (isset($_GET["id"]) && $_GET["id"] != "" && $_GET["id"] != NULL) {
        
                    $avisos = new Aviso();
        
                    $id = (int) $_GET["id"];
        
                    $avisos->setId($id);
        
                    $response = $avisos->delete();
        
                    echo json_encode($response);
        
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
            echo json_encode(["error" => true, "message" => "Error en la solitud eli"]);    
        
        }
        break;
    
    case 2:
        
        if (isset($_GET['aviso'])) {
    
            if ($_GET['aviso'] != "" && $_GET['aviso'] != NULL && $_GET['aviso'] == 'true') {
                
                if ($_POST['mod_aviso'] != '' && $_POST['mod_aviso'] == 'true' && $_POST['mod_aviso'] != NULL) {

                    if (
                        isset($_POST['id_aviso']) && 
                        $_POST['id_aviso'] != "" &&
                        $_POST['id_aviso'] != NULL &&
                        isset($_POST['titulo']) && 
                        $_POST['titulo'] != "" &&
                        $_POST['titulo'] != NULL &&
                        isset($_POST['mensaje']) && 
                        $_POST['mensaje'] != "" &&
                        $_POST['mensaje'] != NULL
                    ) {
                        
                        $aviso = new Aviso();
        
                        $id = (int) $_POST['id_aviso'];
                        $titulo = (string) $_POST['titulo'];
                        $mensaje = (string) $_POST['mensaje'];
        
                        $aviso->setId($id);
                        $aviso->setTitulo($titulo);
                        $aviso->setMensaje($mensaje);
        
                        $response = $aviso->actualizar();
        
                        echo json_encode($response);
        
                    } else {
                        http_response_code(424);
                        echo json_encode(["error" => true, "message" => "Valor no admitido antes de acutalizar"]);
                    }
        
                } else if ($_POST['mod_aviso'] != '' && $_POST['mod_aviso'] == 'false' && $_POST['mod_aviso'] != NULL) {
        
                    if (
                        isset($_POST['titulo']) && 
                        $_POST['titulo'] != "" &&
                        $_POST['titulo'] != NULL &&
                        isset($_POST['mensaje']) && 
                        $_POST['mensaje'] != "" &&
                        $_POST['mensaje'] != NULL
                    ) {
        
                        $aviso = new Aviso();
        
                        $titulo = (string) $_POST['titulo'];
                        $mensaje = (string) $_POST['mensaje'];
        
                        $aviso->setTitulo($titulo);
                        $aviso->setMensaje($mensaje);
        
                        $response = $aviso->alta();
        
                        echo json_encode($response);
        
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
                echo json_encode(["error" => true, "message" => "Hubo un error al procesar la solicitud"]);
            }
        
        } else {
            http_response_code(400);
            echo json_encode(["error" => true, "message" => "Error en la solitud mos"]);
        }

        break;
}

