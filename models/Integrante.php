
<?php

include_once "../conexion/Conexion.php";

class Integrante
{
    private $id;
    private $id_equipo;
    private $nombre_integrante;
    private $goles;
    private $tarjetas_amarillas;
    private $tarjetas_rojas;
    private $num_camisa;
    private $num_jornada;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId_equipo(){
		return $this->id_equipo;
	}

	public function setId_equipo($id_equipo){
		$this->id_equipo = $id_equipo;
	}

	public function getNombre_integrante(){
		return $this->nombre_integrante;
	}

	public function setNombre_integrante($nombre_integrante){
		$this->nombre_integrante = $nombre_integrante;
	}

	public function getGoles(){
		return $this->goles;
	}

	public function setGoles($goles){
		$this->goles = $goles;
	}

	public function getTarjetas_amarillas(){
		return $this->tarjetas_amarillas;
	}

	public function setTarjetas_amarillas($tarjetas_amarillas){
		$this->tarjetas_amarillas = $tarjetas_amarillas;
	}

	public function getTarjetas_rojas(){
		return $this->tarjetas_rojas;
	}

	public function setTarjetas_rojas($tarjetas_rojas){
		$this->tarjetas_rojas = $tarjetas_rojas;
	}

	public function getNum_camisa(){
		return $this->num_camisa;
	}

	public function setNum_camisa($num_camisa){
		$this->num_camisa = $num_camisa;
	}

	public function getNum_jornada(){
		return $this->num_jornada;
	}

	public function setNum_jornada($num_jornada){
		$this->num_jornada = $num_jornada;
	}

	public static function obtenerJugadores($id){
        $conexion = new Conexion();
		$sql = "SELECT id, nombre_integrante FROM integrantes WHERE id_equipo = :id ";
		
		$query = $conexion->prepare($sql);
		
		$query->bindValue(":id", $id);

        $query->execute();
        $query = $query->fetchAll();
        
        $resultados = [];

        $i = 0;

        foreach ($query as $key => $value){

            $resultados[$i] ='
                <option value="'.$value["id"].'">'.$value["nombre_integrante"].'</option>';
                
            $i++;
        }

        return $resultados;
	}

	public function golesJugador() {
		$conexion = new Conexion();

		try {

		$sql = "
			UPDATE integrantes set goles = (SELECT SUM(goles)
			FROM integrantes WHERE id = :id) + :goles
			WHERE id = :id AND id_equipo = :id_equipo
		";

		$query = $conexion->prepare($sql);
		
		$query->bindValue(":id", $this->id);
		$query->bindValue(":goles", $this->goles);
		$query->bindValue(":id_equipo", $this->id_equipo);

		$query->execute();

		return ["success" => true, "message" => "todo perfecto"];
      	
		} catch (Exception $e) {
		 	return ["success" => false, "message" => "Ocurrió un error inesperado al insertar los datos",
                  "error" => $e->getMessage(), "exception" => json_encode($e)];		
		}
	}

	public function tarjetasAmarillasJugador() {
		$conexion = new Conexion();

		try {

		$sql = "
			UPDATE integrantes set tarjetas_amarillas = (SELECT SUM(tarjetas_amarillas)
			FROM integrantes WHERE id = :id) + :tarjetas_amarillas
			WHERE id = :id AND id_equipo = :id_equipo
		";

		$query = $conexion->prepare($sql);
		
		$query->bindValue(":id", $this->id);
		$query->bindValue(":tarjetas_amarillas", $this->tarjetas_amarillas);
		$query->bindValue(":id_equipo", $this->id_equipo);

		$query->execute();

		return ["success" => true, "message" => "todo perfecto"];
      	
		} catch (Exception $e) {
		 	return ["success" => false, "message" => "Ocurrió un error inesperado al insertar los datos",
                  "error" => $e->getMessage(), "exception" => json_encode($e)];		
		}
	}

	public function tarjetasRojasJugador() {
		$conexion = new Conexion();

		try {

		$sql = "
			UPDATE integrantes set tarjetas_rojas = (SELECT SUM(tarjetas_rojas)
			FROM integrantes WHERE id = :id) + :tarjetas_rojas 
			WHERE id = :id AND id_equipo = :id_equipo
		";

		$query = $conexion->prepare($sql);
		
		$query->bindValue(":id", $this->id);
		$query->bindValue(":tarjetas_rojas", $this->tarjetas_rojas);
		$query->bindValue(":id_equipo", $this->id_equipo);

		$query->execute();

		return ["success" => true, "message" => "todo perfecto"];
      	
		} catch (Exception $e) {
		 	return ["success" => false, "message" => "Ocurrió un error inesperado al insertar los datos",
                  "error" => $e->getMessage(), "exception" => json_encode($e)];		
		}
	}

}

?>
