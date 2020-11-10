<?php 
// include_once "../auth/AuthSession.php";
include_once "../models/CalificarJornada.php";

if(isset($_GET["eliminar"])){

    $jornada = new Jornada();
    $jornada->setId($_GET["id"]);
    $response = $jornada->delete();
    echo json_encode($response);
    
}
else if(isset($_GET["save-caljor"])) {
    $calificar = new CalificarJornada();
    
    $golesLocal = 0;
    $tarAmaLocal = 0;
    $tarRojLocal = 0;

    $golesVisitante = 0;
    $tarAmaVisitante = 0;
    $tarRojVisitante = 0;

    
    if (isset($_POST['select_goles_local'])) {
        foreach ($_POST['select_goles_local'] as $key => $value) {
            
            $calificar->golesJugador($value, 1);

            $golesLocal++;
        }
    }

    if (isset($_POST['select_amarillas_local'])) {
        foreach ($_POST['select_amarillas_local'] as $key => $value) {
            
            $calificar->tarjetasAmarillasJugador($value, 1);

            $tarAmaLocal++;
        }
    }

    if (isset($_POST['select_rojas_local'])) {
        foreach ($_POST['select_rojas_local'] as $key => $value) {
            
            $calificar->tarjetasRojasJugador($value, 1);

            $tarRojLocal++;
        }
    }

    if (isset($_POST['select_goles_visitante'])) {
        foreach ($_POST['select_goles_visitante'] as $key => $value) {
            
            $calificar->golesJugador($value, 1);

            $golesVisitante++;
        }
    }

    if (isset($_POST['select_amarillas_visitante'])) {
        foreach ($_POST['select_amarillas_visitante'] as $key => $value) {
            
            $calificar->tarjetasAmarillasJugador($value, 1);

            $tarAmaVisitante++;
        }
    }

    if (isset($_POST['select_rojas_visitante'])) {
        foreach ($_POST['select_rojas_visitante'] as $key => $value) {
            
            $calificar->tarjetasRojasJugador($value, 1);

            $tarRojVisitante++;
        }
    }

    if (
        $golesLocal != NULL &&
        $tarAmaLocal != NULL &&
        $tarRojLocal != NULL &&
        $golesVisitante != NULL &&
        $tarAmaVisitante != NULL &&
        $tarRojVisitante > NULL
    ) {

        // echo             $_POST['idLocal'].','.
        // $_POST['idVisitante'].','.
        // $golesLocal.','.
        // $golesVisitante.','.
        // $tarAmaVisitante.','.
        // $tarAmaLocal.','.
        // $tarRojVisitante.','.
        // $tarRojLocal;

        $response = $calificar->actualizarPartido(
            $_POST['idLocal'],
            $_POST['idVisitante'],
            $golesLocal,
            $golesVisitante,
            $tarAmaVisitante,
            $tarAmaLocal,
            $tarRojVisitante,
            $tarRojLocal,
            $_POST['idJornada']
        );

        echo json_encode($response);
    }

    // if ($golesLocal != 0) {
    //     $calificar->golesEquipoLocal($_POST['idLocal'], $golesLocal);
    // }

    // if ($tarAmaLocal != 0) {
    //     $calificar->tarjetasAmarillasEquipoLocal($_POST['idLocal'], $tarAmaLocal);
    // }

    // if ($golesLocal != 0) {
    //     $calificar->tarjetasRojasEquipoLocal($_POST['idLocal'], $golesLocal);
    // }
    
    // if ($golesVisitante != 0) {
    //     $calificar->golesEquipoVisitante($_POST['idVisitante'], $golesVisitante);
    // }

    // if ($tarAmaLocal != 0) {
    //     $calificar->tarjetasAmarillasEquipoVisitante($_POST['idVisitante'], $tarAmaLocal);
    // }

    // if ($golesLocal != 0) {
    //     $calificar->tarjetasRojasEquipoVisitante($_POST['idVisitante'], $golesLocal);
    // }

}

?>

