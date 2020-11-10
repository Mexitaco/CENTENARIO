<?php
 //include_once "../auth/AuthSession.php";
include_once "../models/Pagos.php";

 if(isset($_GET["save-pagos"])) {
    $pagos = new Pagos();

    $bandera = false;

     if(isset($_POST["equipo"]) && !empty($_POST['equipo']) && $_POST["equipo"] > 1){
         $pagos->setId_Equipo($_POST["equipo"]);
         $bandera = true;
     }
     else{
         $pagos->setId_Equipo(null);
         $bandera = false;
     }

     if(isset($_POST["abono"]) && !empty($_POST['abono']) && $_POST["abono"] > 1){
        $pagos->setAbono($_POST["abono"]);
        $bandera = true;
     }
     else{
         $pagos->setAbono(null);
         $bandera = false;
     }

    if ($bandera != false) {
        $response = $pagos->save();
        echo json_encode($response);
    } else {
        echo json_encode(["success" => false, "message" => "Ocurrió un error inesperado3"]);
    }

    

}