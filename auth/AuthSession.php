<?php
if(!isset($_SESSION)){ 
    session_start(); 
} 
class AuthSession
{
    public static function getUsuario(){
        if(isset($_SESSION["usuario"])){
            return json_decode($_SESSION["usuario"]);
        }
        return null;
    }

    public static function cerrarSession(){
        session_destroy();
        if(!isset($_SESSION)){ 
            session_start(); 
        } 
    }

}