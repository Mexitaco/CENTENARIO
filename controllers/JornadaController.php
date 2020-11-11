<?php
// include_once "../auth/AuthSession.php";
include_once "../models/Jornada.php";

if(isset($_GET["crear-jornada"])) {

    if($_GET["crear-jornada"] == 'true') {
        
        if(isset($_POST["jornada"]) && $_POST["jornada"] != ""){

            if ($_POST['jornada'] == 'jornada') {

                $jornada = new Jornada();
                
                $response =  $jornada->crearJornada();        
                
                if ($response != null) {
                    echo json_encode($response);   
                }
                
                if ($response == null) {
                    http_response_code(422);
                    echo json_encode(["error" => true, "message" => "La solicitud fue enviada, pero no hubo respuesta"]);
                }
            }

        } else{
            http_response_code(500);
            echo json_encode(["error" => true, "message" => "La solicitud se proceso, pero no fue enviada"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => true, "message" => "Hubo un error al procesar la solicitud"]);
    }

} else {
    http_response_code(400);
    echo json_encode(["error" => true, "message" => "Error en la solitud"]);
}
