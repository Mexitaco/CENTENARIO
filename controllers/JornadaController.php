<?php
// include_once "../auth/AuthSession.php";
include_once "../models/Jornada.php";

if(isset($_GET["eliminar"])){

    $jornada = new Jornada();
    $jornada->setId($_GET["id"]);
    $response = $jornada->delete();
    echo json_encode($response);
    
}
else if(isset($_GET["crear-jornada"])) {
    $jornada = new Jornada();
    
    if(isset($_POST["jornada"]) && $_POST["jornada"] != ""){

       $jornada->crearJornada();        

         //echo json_encode(["success" => true, "message" => "todo perfecto"]);
       //  echo json_encode($response);
    
    }
    else{
         echo json_encode(["success" => false, "message" => "no ejecuto nada"]);
    }
    
}
