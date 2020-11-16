<?php
session_start();
include_once "../models/Usuario.php";
if(isset($_POST["iniciarSesion"])){


    $tiempo = 5;

    if (!isset($_SESSION['cont'])) {
        $_SESSION['cont'] = 0;
    }
     

    if ($_SESSION['cont'] < 5) {

        $response = Usuario::iniciarSession($_POST["usuario"], $_POST["password"]);
        
        $validar = $response['cont'];

        if ($validar == 1) {
            
            if ($_SESSION['cont'] == 4) {
                $response = ["success" => false, "message" => "Demasiados intentos fallidos"];
                echo json_encode($response);
            } else {
                echo json_encode($response);
            }
            
            $_SESSION['cont']++;

        } else {
            $_SESSION['cont'] = 0;
            echo json_encode($response);
        }  
        
    } else {
        
        sleep($tiempo);
        $_SESSION['cont'] = 0;
    }

}