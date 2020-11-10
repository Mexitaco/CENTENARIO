<?php

class ConvertJSON
{
    public static function convertUsuario($usuario){
        return [
            "idUsuario" => $usuario->getIdUsuario(),
            "nombre" => $usuario->getNombre(),
            "usuario" => $usuario->getUsuario()
        ];
    }
}