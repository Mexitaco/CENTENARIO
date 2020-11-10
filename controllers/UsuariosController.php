<?php
// include_once "../auth/AuthSession.php";
include_once "../models/Usuario.php";

if(isset($_GET["eliminar"])){

    $usuario = new Usuario();
    $usuario->setId($_GET["id"]);
    $response = $usuario->delete();
    echo json_encode($response);
    
}
else if(isset($_GET["save-usuario"])) {
    $usuario = new Usuario();

    $usuario->setNombre($_POST["nombre"]);
    $usuario->setUsuario($_POST["usuario"]);
    
    if(isset($_POST["password"]) && $_POST["password"] != ""){
        $usuario->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
    }
    else{
        $usuario->setPassword(null);
    }
    
    $response = $usuario->save();
    echo json_encode($response);
}
