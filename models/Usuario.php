<?php

include_once "../conexion/Conexion.php";

class Usuario
{

    private $idUsuario;
    private $nombre;
    private $usuario;
    private $password;
    private $activo;

    public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getActivo(){
		return $this->activo;
	}

	public function setActivo($activo){
		$this->activo = $activo;
	}
  
    public function initData($data){
        $this->idUsuario = $data["idUsuario"];
        $this->nombre = $data["nombre"];
        $this->usuario = $data["usuario"];
        $this->activo = ($data["activo"] == 1) ? true : false;
    }

    public static function iniciarSession($usuario, $password){
        $conexion = new Conexion();
        $sql = "SELECT * FROM usuario WHERE usuario LIKE :usuario AND activo = TRUE limit 1;";
        $query = $conexion->prepare($sql);
        $query->bindValue(":usuario", $usuario);
        $query->execute();
        $query = $query->fetchAll();

        foreach ($query as $res){
            if(password_verify($password, $res["password"])){
                include_once "../utils/ConvertJSON.php";
                $usuario = new Usuario();
                $usuario->initData($res);
                $_SESSION["usuario"] = json_encode(ConvertJSON::convertUsuario($usuario));
                return ["success" => true, "message" => "Sesión iniciada", "cont" => 0];
            }
            else{
                return ["success" => false, "message" => "El usuario o la contraseña son incorrectos", "cont" => 1];
            }
        }

        return ["success" => false, "message" => "El usuario o la contraseña son incorrectos", "cont" => 1];
    }

    public function delete() {
        $conexion = new Conexion();
        $sql = "UPDATE usuarios set activo = false WHERE id = :id;";
        $query = $conexion->prepare($sql);
        $query->bindValue(":id", $this->id);
        $query->execute();

        return ["success" => true, "message" => "Usuario eliminado"];
    }

    public function save() {
        $conexion = new Conexion();

        try{
            $sql = "INSERT INTO usuario (nombre, usuario,".
                "password) VALUES(".
                ":nombre, :usuario, :password);";

            $query = $conexion->prepare($sql);
            $query->bindValue(":nombre", $this->nombre);
            $query->bindValue(":usuario", $this->usuario);
            $query->bindValue(":password", $this->password);

            $query->execute();

            return ["success" => true, "message" => "Usuario registrado"];

        } catch (Exception $e){
            return ["success" => false, "message" => "Ocurrió un error inesperado2",
                "error" => $e->getMessage(), "exception" => json_encode($e)];
        }
    }

    public static function consultar(){
        $conexion = new Conexion();
        $sql = "SELECT * FROM usuario"; //EJEMPLO
        $query = $conexion->prepare($sql);

        $query->execute();
        $query = $query->fetchAll();
        $resultados = [];

        foreach ($query as $key => $value){

            $resultados[$key] = array(
                $value['idUsuario'],
                $value['nombre'],
                $value['usuario']
            );
        }

        return $resultados;
    }

}

?>