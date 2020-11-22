<?php

include_once "../conexion/Conexion.php";

class Jornada
{
    private $id;
    private $num_jornada;
    private $equipo_local;
    private $equipo_visitante;
    private $gol_local;
    private $gol_visitante;
    private $faltas_local;
    private $faltas_visitante;
    private $tarjetas_amarillas_local;
    private $tarjetas_amarillas_visitante;
    private $tarjetas_rojas_local;
    private $tarjetas_rojas_visitante;
    private $cancha;
    private $horario;
    private $equipo_ganador;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNum_jornada(){
		return $this->num_jornada;
	}

	public function setNum_jornada($num_jornada){
		$this->num_jornada = $num_jornada;
	}

	public function getEquipo_local(){
		return $this->equipo_local;
	}

	public function setEquipo_local($equipo_local){
		$this->equipo_local = $equipo_local;
	}

	public function getEquipo_visitante(){
		return $this->equipo_visitante;
	}

	public function setEquipo_visitante($equipo_visitante){
		$this->equipo_visitante = $equipo_visitante;
	}

	public function getGol_local(){
		return $this->gol_local;
	}

	public function setGol_local($gol_local){
		$this->gol_local = $gol_local;
	}

	public function getGol_visitante(){
		return $this->gol_visitante;
	}

	public function setGol_visitante($gol_visitante){
		$this->gol_visitante = $gol_visitante;
	}

	public function getFaltas_local(){
		return $this->faltas_local;
	}

	public function setFaltas_local($faltas_local){
		$this->faltas_local = $faltas_local;
	}

	public function getFaltas_visitante(){
		return $this->faltas_visitante;
	}

	public function setFaltas_visitante($faltas_visitante){
		$this->faltas_visitante = $faltas_visitante;
	}

	public function getTarjetas_amarillas_local(){
		return $this->tarjetas_amarillas_local;
	}

	public function setTarjetas_amarillas_local($tarjetas_amarillas_local){
		$this->tarjetas_amarillas_local = $tarjetas_amarillas_local;
	}

	public function getTarjetas_amarillas_visitante(){
		return $this->tarjetas_amarillas_visitante;
	}

	public function setTarjetas_amarillas_visitante($tarjetas_amarillas_visitante){
		$this->tarjetas_amarillas_visitante = $tarjetas_amarillas_visitante;
	}

	public function getTarjetas_rojas_local(){
		return $this->tarjetas_rojas_local;
	}

	public function setTarjetas_rojas_local($tarjetas_rojas_local){
		$this->tarjetas_rojas_local = $tarjetas_rojas_local;
	}

	public function getTarjetas_rojas_visitante(){
		return $this->tarjetas_rojas_visitante;
	}

	public function setTarjetas_rojas_visitante($tarjetas_rojas_visitante){
		$this->tarjetas_rojas_visitante = $tarjetas_rojas_visitante;
	}

	public function getCancha(){
		return $this->cancha;
	}

	public function setCancha($cancha){
		$this->cancha = $cancha;
	}

	public function getHorario(){
		return $this->horario;
	}

	public function setHorario($horario){
		$this->horario = $horario;
	}

	public function getEquipo_ganador(){
		return $this->equipo_ganador;
	}

	public function setEquipo_ganador($equipo_ganador){
		$this->equipo_ganador = $equipo_ganador;
	}

	public static function consultaJornada(){
        $conexion = new Conexion();
		$sql = '
			SELECT id, num_jornada,
				(SELECT nombre_equipo from equipos where id = el.idEquipo) as "local",
				(SELECT id from equipos where id = el.idEquipo) as "id_equipo_local",
				(SELECT nombre_equipo from equipos where id = ev.idEquipo) as "visitante",
				(SELECT id from equipos where id = ev.idEquipo) as "id_equipo_visitante",
				j.horario, j.cancha, j.equipo_ganador from jornada j JOIN equipo_local el JOIN equipo_visitante ev 
				on j.idLocal = el.idLocal and j.idVisitante = ev.idVisitante';
			
		$query = $conexion->prepare($sql);	

        $query->execute();
		$query = $query->fetchAll();
		
		$resultados = [];
		$verMas = '';


        foreach ($query as $key => $value){

			$verMas = '';

			if ($value['equipo_ganador'] != 'Sin resultados')  {
				$verMas .= '
				<a class="btn btn-warning more-info" title="Ver resultados" href="resJor.php?id='.$value["id"].'" role="button">
					<span class="fa fa-info"></span>
				</a>
				';
			} else {
				$verMas .= '
			<a class="btn btn-primary more-info" title="Calificar" href="calJornada.php?id='.$value["id"].'&&el='.$value["id_equipo_local"].'&&ev='.$value["id_equipo_visitante"].'" role="button">
				<span class="fas fa-external-link-alt" aria-hidden="true" style="color: white;"></span>
			</a>
			';
			}
			
            $resultados[$key] = array(
				$value['num_jornada'],
				$value['horario'],
				$value['local'],
				$value['visitante'],
				$value['cancha'],
				$verMas
			);
			
        }

        return $resultados;
	}
	
	public static function consultaVerMas($verMas){
        $conexion = new Conexion();
		$sql = '
			SELECT (SELECT nombre_equipo from equipos where id = el.idEquipo) as "local",
			el.goles_local, el.tarjetas_amarillas_local, el.tarjetas_rojas_local,
			(SELECT nombre_equipo from equipos where id = ev.idEquipo) as "visitante",
			ev.goles_visitante, ev.tarjetas_amarillas_visitante, ev.tarjetas_rojas_visitante, j.horario,
			j.cancha, j.equipo_ganador, j.num_jornada from jornada j JOIN equipo_local el JOIN equipo_visitante ev 
			on j.idLocal = el.idLocal and j.idVisitante = ev.idVisitante WHERE id = '.$verMas.'; ';
			
		$query = $conexion->prepare($sql);	

        $query->execute();
        $query = $query->fetchAll();
        $resultados = [];

        foreach ($query as $key => $value){

		    $resultados[$key] = array(
				"local" => $value['local'],
				"goles_local" => $value['goles_local'],
				"tarjetas_amarillas_local" => $value['tarjetas_amarillas_local'],
				"tarjetas_rojas_local" => $value['tarjetas_rojas_local'],
				"visitante" => $value['visitante'],
				"goles_visitante" => $value['goles_visitante'],
				"tarjetas_amarillas_visitante" => $value['tarjetas_amarillas_visitante'],
				"tarjetas_rojas_visitante" => $value['tarjetas_rojas_visitante'],
				"horario" => $value['horario'],
				"cancha" => $value['cancha'],
				"equipo_ganador" => $value['equipo_ganador'],
				"num_jornada" => $value['num_jornada']
			);
				
        }

        return $resultados;
	}

	private static function obtenerEquipos(){
        $conexion = new Conexion();
        $sql = "SELECT id FROM equipos";
            
        $query = $conexion->prepare($sql);

        $query->execute();
        $query = $query->fetchAll();
        
        $resultados = array();
		
        foreach ($query as $key){
			array_push($resultados, $key["id"]);       
		}

        return $resultados;
	}


	public function crearJornada() {
		$crear = new Jornada();
		$array = $crear->obtenerEquipos();

		$jornada = 0;
		$numCancha = 0;
		$numHorario = 0;

		$uno = $array;
		$response;

		$horario = array(
			'11:00',
			'12:30',
			'14:00',
			'15:30',
			'17:00',
			'18:30',
			'20:00'
		);

		$combinacion = [
			[10, 3, 12, 2, 13, 6, 4, 11, 7, 1, 8, 5, 9, 0],
			[0, 8, 1, 4, 11, 13, 2, 10, 3, 9, 5, 7, 6, 12],
			[12, 11, 13, 1, 4, 5, 6, 2, 7, 0, 8, 3, 9, 10],
			[0, 4, 1, 12, 10, 8, 11, 6, 2, 9, 3, 7, 5, 13],
			[11, 2, 12, 5, 13, 0, 4, 3, 6, 1, 7, 10, 8, 9],
			[0, 12, 1, 11, 10, 4, 2, 8, 3, 13, 5, 6, 9, 7],
			[1, 2, 11, 5, 12, 3, 13, 10, 4, 9, 6, 0, 7, 8],
			[0, 11, 10, 12, 2, 7, 3, 6, 5, 1, 8, 4, 9, 13],
			[1, 0, 11, 3, 12, 9, 13, 8, 4, 7, 5, 2, 6, 10],
			[0, 5, 10, 11, 2, 4, 3, 1, 7, 13, 8, 12, 9, 6],
			[0, 2, 1, 10, 11, 9, 12, 7, 13, 4, 5, 3, 6, 8],
			[10, 5, 13, 2, 3, 0, 4, 12, 7, 6, 8, 11, 9, 1],
			[0, 10, 1, 8, 11, 7, 12, 13, 2, 3, 5, 9, 6, 4],
		  ];

		for ($i=0; $i < count($combinacion); $i++) { 
			
			if ($jornada == 13) {
				$jornada = 0;
			}

			$jornada++;
			

			for ($j= 0; $j < count($combinacion[$i]); $j+=2) { 

				if ($numCancha == 4) {
					$numCancha = 0;
				}
	
				if ($numHorario == 7) {
					$numHorario = 0;
				}

				$numCancha++;
				
				$this->setEquipo_local($uno[$combinacion[$i][$j]]);
				$this->setEquipo_visitante($uno[$combinacion[$i][$j + 1]]);
				$this->setNum_jornada($jornada);
				$this->setHorario($horario[$numHorario]);
				$this->setCancha('Cancha '.$numCancha);

				$response = $this->insertarJornada();
				
				$numHorario++;
			}
		}

		if ($response != null) {
			return $response;
		}

		return null;
	}

	private function insertarJornada() {
		$conexion = new Conexion();

        try{
            $sql = "CALL Insert_jornada(
				:local,
				:visitante,
				:numJornada,
				:horario,
				:cancha
			);";

			$query = $conexion->prepare($sql);
			
            $query->bindValue(":local", $this->getEquipo_local(), PDO::PARAM_INT);
            $query->bindValue(":visitante", $this->getEquipo_visitante(), PDO::PARAM_INT);
			$query->bindValue(":numJornada", $this->getNum_jornada(), PDO::PARAM_INT);
			$query->bindValue(":horario", $this->getHorario(), PDO::PARAM_STR);
			$query->bindValue(":cancha", $this->getCancha(), PDO::PARAM_STR);

            $query->execute();

          return ["success" => true, "message" => "Jornada creadas"];

        } catch (Exception $e){
            return ["success" => false, "message" => "Ocurrió un error inesperado al insertar los datos",
                   "error" => $e->getMessage(), "exception" => json_encode($e)];
        }
	}
	
	public static function verificarResultado($idResultado){
        $conexion = new Conexion();
		$sql = "
            SELECT equipo_ganador FROM jornada WHERE id = :id
        ";
			
		$query = $conexion->prepare($sql);	

		$query->bindValue(":id", $idResultado, PDO::PARAM_INT);

		$query->execute();
		
        $resultado = $query->fetch(PDO::FETCH_ASSOC);

        return $resultado;
	}

	public static function verificarId($tab, $idVerificar){

		if ($tab == null || $tab == '') {
			return false;
		}

		if ($idVerificar == null || $idVerificar == '') {
			return false;
		}

        $conexion = new Conexion();
		$sql = "
            SELECT id FROM ".$tab." WHERE id = :id
        ";
			
		$query = $conexion->prepare($sql);	

		$query->bindValue(":id", $idVerificar, PDO::PARAM_INT);

		$query->execute();
		
        $resultado = $query->fetch(PDO::FETCH_ASSOC);

        return $resultado;
	}


	public function terminarLiga() {

		$conexion = new Conexion();

		$sql = "CALL `terminar_temporada`();";

		$query = $conexion->prepare($sql);


		$query->execute();

		return ["success" => true, "message" => "Temporada terminada"];
	
	}

}

?>