<?php

include_once "../conexion/Conexion.php";
include_once "Jornada.php";
include_once "Integrante.php";

class CalificarJornada 
{

    public function partido($id){
        $jornada = new Jornada();

        $resultado = $jornada->consultaVerMas($id);

        return $resultado;
    }

    public function jugador($id){
        $integrante = new Integrante();

        $jugadores = $integrante->obtenerJugadores($id);

        $option = implode("", $jugadores);

        echo $option;
    }

    public function golesJugador($id, $goles, $equipo) {
        $integrante = new Integrante();

        $integrante->setGoles($goles);
        $integrante->setId($id);
        $integrante->setId_equipo($equipo);
        $integrante->golesJugador();
    }

    public function tarjetasAmarillasJugador($id, $amarillas, $equipo) {
        $integrante = new Integrante();

        $integrante->setTarjetas_amarillas($amarillas);
        $integrante->setId($id);
        $integrante->setId_equipo($equipo);
        $integrante->tarjetasAmarillasJugador();
    }

    public function tarjetasRojasJugador($id, $rojas, $equipo) {
        $integrante = new Integrante();

        $integrante->setTarjetas_rojas($rojas);
        $integrante->setId($id);
        $integrante->setId_equipo($equipo);
        $integrante->tarjetasRojasJugador();
    }

    public function actualizarPartido(
        $idLocal,
        $idVisitante,
        $golesLocal,
        $golesVisitante,
        $tarAmaVisitante,
        $tarAmaLocal,
        $tarRojVisitante,
        $tarRojLocal,
        $idJornada
    ) {
		$conexion = new Conexion();

		try {

		$sql = "
            CALL actualiza_partido_id_jornada(
                :idLocal,
                :idVisitante,
                :golesLocal,
                :golesVisitante,
                :tarAmaVisitante,
                :tarAmaLocal,
                :tarRojVisitante,
                :tarRojLocal,
                :idJornada
            );
        ";

        $query = $conexion->prepare($sql);
        
        $query->bindValue(":idLocal", $idLocal, PDO::PARAM_INT);
        $query->bindValue(":idVisitante", $idVisitante, PDO::PARAM_INT);
        $query->bindValue(":golesLocal", $golesLocal, PDO::PARAM_INT);
        $query->bindValue(":golesVisitante", $golesVisitante, PDO::PARAM_INT);
        $query->bindValue(":tarAmaVisitante", $tarAmaVisitante, PDO::PARAM_INT);
        $query->bindValue(":tarAmaLocal", $tarAmaLocal, PDO::PARAM_INT);
        $query->bindValue(":tarRojVisitante", $tarRojVisitante, PDO::PARAM_INT);
        $query->bindValue(":tarRojLocal", $tarRojLocal, PDO::PARAM_INT);
        $query->bindValue(":idJornada", $idJornada, PDO::PARAM_INT);

		$query->execute();

        return ["success" => true, "message" => "Partido calificado"];
              	
		} catch (Exception $e) {
		 	return ["success" => false, "message" => "Ocurrió un error inesperado al insertar los datos",
                  "error" => $e->getMessage(), "exception" => json_encode($e)];		
		}
	}

    public function verificarResultado($idResultado){
        $jornada = new Jornada();

        $id = (int) $idResultado;

        $resultado = $jornada->verificarResultado($id);

        return $resultado;
    }
    
    public function verificarId($tab, $idValidar) {
        if ($tab == null || $tab == "") {
            return false;
        }

        $jornada = new Jornada();

        $id = (int) $idValidar;

        $resultado = $jornada->verificarId($tab, $id);

        return $resultado;
    }
}

?>
