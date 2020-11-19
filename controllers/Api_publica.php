<?php 
include_once "../models/Api_publica.php";

$sw;



if(isset($_GET["avisos"])) {
    //echo 'aviso';

    $sw = 1;
}

if(isset($_GET["topGol"])){
    $sw = 2;
}

if(isset($_GET["topTarAma"])){
    $sw = 3;
}

if(isset($_GET["topTarRoj"])){
    $sw = 4;
}

if(isset($_GET["tabPosiciones"])){
    $sw = 5;
}

if(isset($_GET["jornada"])){
    $sw = 6;
}

if(isset($_GET["jornadaVerMas"])){
    $sw = 7;
}

switch ($sw) {
    case 1:

        if (isset($_GET['avisos'])) {

            $api = new Api_publica();
            
            $response = $api->mostrarAvisos();

            echo json_encode($response);
        }

        break;
    
    case 2:
        
        if (isset($_GET['topGol'])) {

            $api = new Api_publica();
            
            $response = $api->consultarTopGol();

            echo json_encode($response);
        }

        break;

        case 3:
            if (isset($_GET['topTarAma'])) {

                $api = new Api_publica();
                
                $response = $api->consultarTopTarAma();
    
                echo json_encode($response);
            }

        break;

        case 4:
            if (isset($_GET['topTarRoj'])) {

                $api = new Api_publica();
                
                $response = $api->consultarTopTarRoj();
    
                echo json_encode($response);
            }

        break;

        case 5:
            if (isset($_GET['tabPosiciones'])) {

                $api = new Api_publica();
                
                $response = $api->consultarTablaPos();
    
                echo json_encode($response);
            }

        break;

        case 6:
            if (isset($_GET['jornada'])) {

                $api = new Api_publica();
                
                $response = $api->consultaJornada();
    
                echo json_encode($response);
            }
            
        break;

        
        case 7:
            if (isset($_GET['jornadaVerMas'])) {

                $id = $_GET['id'];

                $api = new Api_publica();
                
                $response = $api->consultaVerMas($id);
    
                echo json_encode($response);
            }
            
        break;

}

