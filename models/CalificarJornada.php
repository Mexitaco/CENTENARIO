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

    public function golesJugador($id, $goles) {
        $integrante = new Integrante();

        $integrante->setGoles($goles);
        $integrante->setId($id);
        $integrante->golesJugador();
    }

    public function tarjetasAmarillasJugador($id, $amarillas) {
        $integrante = new Integrante();

        $integrante->setTarjetas_amarillas($amarillas);
        $integrante->setId($id);
        $integrante->tarjetasAmarillasJugador();
    }

    public function tarjetasRojasJugador($id, $rojas) {
        $integrante = new Integrante();

        $integrante->setTarjetas_rojas($rojas);
        $integrante->setId($id);
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
        CALL actualiza_partido4(
            :idLocal,
            :idVisitante,
            :golesLocal,
            :golesVisitante,
            :tarAmaVisitante,
            :tarAmaLocal,
            :tarRojVisitante
            :tarRojLocal,
            :idJornada
        )";

            echo         $idLocal.', '.
            $idVisitante.', '.
            $golesLocal.', '.
            $golesVisitante.', '.
            $tarAmaVisitante.', '.
            $tarAmaLocal.', '.
            $tarRojVisitante.', '.
            $tarRojLocal.', '.
            $idJornada;

		$query = $conexion->prepare($sql);
		
        $query->bindValue(":idLocal", $idLocal);
        $query->bindValue(":idVisitante", $idVisitante);
        $query->bindValue(":golesLocal", $golesLocal);
        $query->bindValue(":golesVisitante", $golesVisitante);
        $query->bindValue(":tarAmaVisitante", $tarAmaVisitante);
        $query->bindValue(":tarAmaLocal", $tarAmaLocal);
        $query->bindValue(":tarRojVisitante", $tarRojVisitante);
        $query->bindValue(":tarRojLocal", $tarRojLocal);
        $query->bindValue(":idJornada", $idJornada);
        
		$query->execute();

		return ["success" => true, "message" => "todo perfecto"];
      	
		} catch (Exception $e) {
		 	return ["success" => false, "message" => "Ocurrió un error inesperado al insertar los datos",
                  "error" => $e->getMessage(), "exception" => json_encode($e)];		
		}
	}


    // public function golesEquipoLocal($id, $goles) {
    //     $equipoLocal = new EquipoLocal();

    //     $equipoLocal->setGoles_local($goles);
    //     $equipoLocal->setIdLocal($id);
    //     $equipoLocal->golesEquipoLocal();
    // }

    // public function tarjetasAmarillasEquipoLocal($id, $goles) {
    //     $equipoLocal = new EquipoLocal();

    //     $equipoLocal->setTarjetas_amarillas_local($goles);
    //     $equipoLocal->setIdLocal($id);
    //     $equipoLocal->tarjetasAmarillasEquipoLocal();
    // }

    // public function tarjetasRojasEquipoLocal($id, $rojas) {
    //     $equipoLocal = new EquipoLocal();

    //     $equipoLocal->setTarjetas_rojas_local($rojas);
    //     $equipoLocal->setIdLocal($id);
    //     $equipoLocal->tarjetasRojasEquipoLocal();
    // }

    // public function golesEquipoVisitante($id, $goles) {
    //     $equipoVisitante = new EquipoVisitante();

    //     $equipoVisitante->setGoles_visitante($goles);
    //     $equipoVisitante->setIdVisitante($id);
    //     $equipoVisitante->golesEquipoVisitante();
    // }

    // public function tarjetasAmarillasEquipoVisitante($id, $amarillas) {
    //     $equipoVisitante = new EquipoVisitante();

    //     $equipoVisitante->setTarjetas_amarillas_visitante($amarillas);
    //     $equipoVisitante->setIdVisitante($id);
    //     $equipoVisitante->tarjetasAmarillasEquipoVisitante();
    // }

    // public function tarjetasRojasEquipoVisitante($id, $rojas) {
    //     $equipoVisitante = new EquipoVisitante();

    //     $equipoVisitante->setTarjetas_rojas_visitante($rojas);
    //     $equipoVisitante->setIdVisitante($id);
    //     $equipoVisitante->tarjetasRojasEquipoVisitante();
    // }
 
    
}

?>
