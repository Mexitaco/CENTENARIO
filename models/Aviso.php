<?php

include_once "../conexion/Conexion.php";

class Aviso
{
    private $id;
    private $titulo;
    private $mensaje;
    private $fecha;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getMensaje(){
		return $this->mensaje;
	}

	public function setMensaje($mensaje){
		$this->mensaje = $mensaje;
    }
    
    public function getFecha(){
		return $this->fecha;
	}

	public function setFecha($fecha){
		$this->fecha = $fecha;
	}


	public static function consultarAvisos(){
        $conexion = new Conexion();
        $sql = 'SELECT id, titulo, mensaje, fecha from avisos';
            
        $query = $conexion->prepare($sql);

        $query->execute();
        $query = $query->fetchAll();
        
        $resultados = [];
      
	
        foreach ($query as $key => $value){
            $mod = '
                <button class="btn btn-info more-info btn-mod-aviso" title="Modificar"
                    data-id="'.$value['id'].'"
                    data-tittle="'.$value['titulo'].'"  
                    data-message="'.$value['mensaje'].'"  
                    data-toggle="modal" 
                    data-target="#mod-avisos">
                    <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                </button>
            ';
            
			$eli = '
                <a class="btn btn-danger more-info btn-eliminar-avisos" title="Eliminar" role="button"
                data-id="'.$value['id'].'">
                    <span class="fas fa-minus" aria-hidden="true"></span>
                </a>
            ';
            
            $resultados[$key] = array(
                $value['titulo'],
                $value['mensaje'],
                $value['fecha'],
                $mod,
                $eli
                );
        }

        return $resultados;
    }
    
    public  function delete(){

        $conexion = new Conexion();

        try {

            $sql = "DELETE FROM avisos WHERE id = :id ";

            $query = $conexion->prepare($sql);

            $query->bindValue(":id", $this->getId(), PDO::PARAM_INT);

            $query->execute();

            $resultado = $query->rowCount();

            if ($resultado > 0) {   
                return ["success" => true, "message" => "Aviso eliminado"];
            }

            return ["error" => true, "message" => "Ocurrió un error inesperado eliminar"];
              	
        } catch (Exception $e) {
            return ["success" => false, "message" => "Ocurrió un error inesperado al eleminar el registro",
                "error" => $e->getMessage(), "exception" => json_encode($e)];		
        }
       
    }

    public function actualizar() {
		$conexion = new Conexion();

		try {

            $sql = "UPDATE avisos SET titulo=:titulo, mensaje=:mensaje, fecha=:fecha WHERE id = :id;";
    
            $formato = "Y-m-d";
            $dia = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $this->setFecha($dia->format($formato));

            $query = $conexion->prepare($sql);
            
            $query->bindValue(":id", $this->getId(), PDO::PARAM_INT);
            $query->bindValue(":titulo", $this->getTitulo(), PDO::PARAM_STR);
            $query->bindValue(":mensaje", $this->getMensaje(), PDO::PARAM_STR);
            $query->bindValue(":fecha", $this->getFecha(), PDO::PARAM_STR);

            $query->execute();

            $resultado = $query->rowCount();

            if ($resultado > 0) {
                return ["success" => true, "message" => "Aviso actualizado"];
            }

            return ["error" => true, "message" => "Se ingresaron los mismos datos"];
      	
		} catch (Exception $e) {
		 	return ["success" => false, "message" => "Ocurrió un error inesperado al insertar los datos",
                  "error" => $e->getMessage(), "exception" => json_encode($e)];		
		}
	}

    public function alta() {
		$conexion = new Conexion();

		try {

            $sql = "INSERT INTO avisos (titulo,mensaje,fecha) VALUES (:titulo,:mensaje,:fecha);";

            $query = $conexion->prepare($sql);

            $formato = "Y-m-d";
            $dia = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $this->setFecha($dia->format($formato));
            
            $query->bindValue(":titulo", $this->getTitulo(), PDO::PARAM_STR);
            $query->bindValue(":mensaje", $this->getMensaje(), PDO::PARAM_STR);
            $query->bindValue(":fecha", $this->getFecha(), PDO::PARAM_STR);

            $query->execute();

            $resultado = $query->rowCount();

            if ($resultado > 0) {
                return ["success" => true, "message" => "Aviso agregado"];
            }

            return ["error" => true, "message" => "Ocurrió un error insesperado"];
      	
		} catch (Exception $e) {
		 	return ["success" => false, "message" => "Ocurrió un error inesperado al insertar los datos",
                  "error" => $e->getMessage(), "exception" => json_encode($e)];		
		}
	}




    public static function mostrarAvisos() {
        $conexion = new Conexion();
        $sql = 'SELECT titulo, mensaje, fecha FROM avisos';
            
        $query = $conexion->prepare($sql);

        $query->execute();

        $row = $query->rowCount();

        $query = $query->fetchAll();
        
        $resultados = [];
        $i = 0;

        foreach ($query as $key => $value) {

            $resultados[$i] = '
                <div class="col-md-4 col-sm-4">
                    <div class="service-box-wrap">
                        <div class="service-icon-wrap">
                        </div>
                        <div class="service-cnt-wrap">
                            <h3 class="service-title">'.$value["titulo"].'</h3>
                            <p>'.$value["mensaje"].'</p>
                            <p>'.$value["fecha"].'</p>
                        </div>
                    </div>
                </div>
            ';

            $i++;
        }
        
        if ($row > 0) {

            return $resultados;
        }
        
        $no_info = ['
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class="service-box-wrap">
                        <div class="service-icon-wrap">
                        </div>
                        <div class="service-cnt-wrap">
                            <h3 class="service-title">NO HAY AVISOS POR EL MOMENTO</h3>
                        </div>
                    </div>
                </div>
            '];
            
        return $no_info;
    }

}

?>