
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
		$sql = "SELECT id, nombre_integrante, num_camisa FROM integrantes WHERE id_equipo = :id  and status = 1";
		
		$query = $conexion->prepare($sql);
		
		$query->bindValue(":id", $id);

        $query->execute();
        $query = $query->fetchAll();
        
        $resultados = [];

        $i = 0;

        foreach ($query as $key => $value){

            $resultados[$i] ='
                <option value="'.$value["id"].'">'.$value["nombre_integrante"].' - '.$value['num_camisa'].'</option>';
                
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

	public function consultarIntegrantes($id){
        $conexion = new Conexion();
		$sql = "SELECT id, nombre_integrante, num_camisa FROM integrantes WHERE id_equipo = :id  and status = 1";
		
		$query = $conexion->prepare($sql);
		
		$query->bindValue(":id", $id);

        $query->execute();
        $query = $query->fetchAll();
        
        $resultados = [];

		$i = 1;

        foreach ($query as $key => $value){

			$modificar = '
				<button type="button" class="btn-mod-inte btn btn-warning more-info fas fa-pencil-alt" data-toggle="modal" 
					title="Modificar nombre" 
					data-id="'.$value['id'].'" data-nomb="'.$value['nombre_integrante'].'"
					data-num="'.$value['num_camisa'].'" 
					data-target="#mod-integrante">
				</button>
			';

            $resultados[$key] = array(
				$i,
				$value["nombre_integrante"],
				$value['num_camisa'],
				$modificar
			);

			$i++;
        }

        return $resultados;
	}

	public function verificarCamisa($idVerificar, $camisa, $idEquipo){
        $conexion = new Conexion();
		$sql = "
            SELECT num_camisa FROM integrantes WHERE id = :id
        ";
			
		$query = $conexion->prepare($sql);	

		$query->bindValue(":id", $idVerificar, PDO::PARAM_INT);
		//$query->bindValue(":num_camisa", $camisa, PDO::PARAM_INT);

		$query->execute();

		$row = $query->rowCount();
		
		$resultado = "";

		$query = $query->fetchAll();

		$cam = (string) $camisa;

		foreach ($query as $key => $value) {
			
			$resultado = $value['num_camisa'];

			if ($resultado == $cam) {
				return true;
			}

			$res = $this->consultarCamisas($idEquipo, $cam);

			if ($res == true) {
				return true;
			}

			return false;
		}
	
		
	
	}


	public function consultarCamisas($idVerificar, $cam){
        $conexion = new Conexion();
		$sql = "
            SELECT num_camisa FROM integrantes WHERE id_equipo = :id 
        ";
			
		$query = $conexion->prepare($sql);	

		$query->bindValue(":id", $idVerificar, PDO::PARAM_INT);
		//$query->bindValue(":num_camisa", $camisa, PDO::PARAM_INT);

		$query->execute();

		$row = $query->rowCount();
		
		$resultado = [];

		$query = $query->fetchAll();

		$i = 0;

		foreach ($query as $key => $value) {
			
			$resultado[$i] = $value['num_camisa'];
		
			if ($cam == $resultado[$i]) {
				return false;
			}
			
			$i++;
		}
	
		return true;
	
	}

	public function actualizarIntegrante() {
		$conexion = new Conexion();

		try {

		$sql = "
			UPDATE integrantes SET nombre_integrante = :nombre_integrante,
			num_camisa = :num_camisa WHERE id = :id
		";

		$query = $conexion->prepare($sql);
		
		$query->bindValue(":id", $this->getId(), PDO::PARAM_INT);
		$query->bindValue(":nombre_integrante", $this->getNombre_integrante(), PDO::PARAM_STR);
		$query->bindValue(":num_camisa", $this->getNum_camisa(), PDO::PARAM_INT);

		$query->execute();

		return ["success" => true, "message" => "Jugador actualizado"];
      	
		} catch (Exception $e) {
		 	return ["success" => false, "message" => "Ocurrió un error inesperado al insertar los datos",
                  "error" => $e->getMessage(), "exception" => json_encode($e)];		
		}


	}

}

?>
