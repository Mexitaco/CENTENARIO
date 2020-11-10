<?php
session_start();
include_once "../models/Usuario.php";
if(isset($_POST["iniciarSesion"])){
    $response = Usuario::iniciarSession($_POST["usuario"], $_POST["password"]);
    echo json_encode($response);
}