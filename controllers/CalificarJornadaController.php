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
    
    if ($_GET['save-caljor'] == 'true') {
        
        if (isset($_POST)) {

            if ($_POST != null) { 

                $calificar = new CalificarJornada();

                $golesLocal = 0;
                $tarAmaLocal = 0;
                $tarRojLocal = 0;

                $golesVisitante = 0;
                $tarAmaVisitante = 0;
                $tarRojVisitante = 0;

                $idLocal = (int) $_POST['idLocal'];
                $idVisitante = (int) $_POST['idVisitante'];
                $idJornada = (int) $_POST['idJornada'];

                $select_goles_local = array_map( create_function('$value', 'return (int)$value;'), $_POST['select_goles_local']);
                $select_amarillas_local = array_map( create_function('$value', 'return (int)$value;'), $_POST['select_amarillas_local']);
                $select_rojas_local = array_map( create_function('$value', 'return (int)$value;'), $_POST['select_rojas_local']);
                $select_goles_visitante = array_map( create_function('$value', 'return (int)$value;'), $_POST['select_goles_visitante']);
                $select_amarillas_visitante = array_map( create_function('$value', 'return (int)$value;'), $_POST['select_amarillas_visitante']);
                $select_rojas_visitante = array_map( create_function('$value', 'return (int)$value;'), $_POST['select_rojas_visitante']);

                function validar($var) {
                    foreach ($var as $key => $value) {
                        if ($value < 0 ) {
                            return $flag = false;
                        } else {
                            return $flag = true;
                        }
                    }
                }

                $flags1 = validar($select_goles_local);
                $flags2 = validar($select_amarillas_local);
                $flags3 = validar($select_rojas_local);
                $flags4 = validar($select_goles_visitante);
                $flags5 = validar($select_amarillas_visitante);
                $flags6 = validar($select_rojas_visitante);
                
                $flagJornada = $calificar->verificarId("jornada", $idJornada);
                $flagLocal = $calificar->verificarId("equipos", $idLocal);
                $flagVisitante = $calificar->verificarId("equipos", $idVisitante);

                if ($idLocal <= 0 || $idVisitante <= 0 || $idJornada <= 0) {

                    http_response_code(424);
                    
                    echo json_encode(["error" => true, "message" => "Valor no admitido"]);    

                } else {

                    if (
                        $flags1 == true &&
                        $flags2 == true &&
                        $flags3 == true &&
                        $flags4 == true &&
                        $flags5 == true &&
                        $flags6 == true &&
                        !empty($flagVisitante) &&
                        !empty($flagLocal) &&
                        !empty($flagJornada)
                    ) {

                        if (isset($_POST['select_goles_local'])) {
                            foreach ($select_goles_local as $key => $value) {
                                
                                if ($value > 0) {
                                    $calificar->golesJugador($value, 1, $idLocal);
            
                                    $golesLocal++;
                                }
                                
                            }
                        }
    
                        if (isset($_POST['select_amarillas_local'])) {
                            foreach ($select_amarillas_local as $key => $value) {
                                
                                if ($value > 0) {
                                    $calificar->tarjetasAmarillasJugador($value, 1, $idLocal);
        
                                    $tarAmaLocal++;
                                }
                            }
                        }
    
                        if (isset($_POST['select_rojas_local'])) {
                            foreach ($select_rojas_local as $key => $value) {
    
                                if ($value > 0) {
                                    $calificar->tarjetasRojasJugador($value, 1, $idLocal);
                                    
                                    $tarRojLocal++;
                                }
                            }
                        }
    
                        if (isset($_POST['select_goles_visitante'])) {
                            foreach ($select_goles_visitante as $key => $value) {
                                
                                if ($value > 0) {
                                    $calificar->golesJugador($value, 1, $idVisitante);
                                    
                                    $golesVisitante++;
                                }
                            }
                        }
    
                        if (isset($_POST['select_amarillas_visitante'])) {
                            foreach ($select_amarillas_visitante as $key => $value) {
                                
                                if ($value > 0) {
                                    $calificar->tarjetasAmarillasJugador($value, 1, $idVisitante);
                                    
                                    $tarAmaVisitante++;
                                }
                            }
                        }
    
                        if (isset($_POST['select_rojas_visitante'])) {
                            foreach ($select_rojas_visitante as $key => $value) {
                                
                                if ($value > 0) {
                                    $calificar->tarjetasRojasJugador($value, 1, $idVisitante);
                                    
                                    $tarRojVisitante++;
                                }
                            }
                        }

                        if (
                            $golesLocal >= 0 &&
                            $tarAmaLocal >= 0 &&
                            $tarRojLocal >= 0 &&
                            $golesVisitante >= 0 &&
                            $tarAmaVisitante >= 0 &&
                            $tarRojVisitante >= 0 
                        ) {

                            $response = $calificar->actualizarPartido(
                                    $idLocal,
                                    $idVisitante,
                                    $golesLocal,
                                    $golesVisitante,
                                    $tarAmaVisitante,
                                    $tarAmaLocal,
                                    $tarRojVisitante,
                                    $tarRojLocal,
                                    $idJornada
                                );
            
                                echo json_encode($response);

                        } else {
                            echo json_encode(["error" => true, "message" => "Datos truncados"]);    
                        }

                    } else {
                        http_response_code(424);

                        if (empty($flagVisitante) || empty($flagLocal) || empty($flagJorna)) {
                            echo json_encode(["error" => true, "message" => "Parámetros no válidos"]);        
                        } else {
                            echo json_encode(["error" => true, "message" => "Valor no admitido en jugadores"]);    
                        }
                    }

                }

            } else {
                http_response_code(400);
                echo json_encode(["error" => true, "message" => "No hay información en la solicitud"]);
            }
            
        } else {
            http_response_code(400);
            echo json_encode(["error" => true, "message" => "No hay información en la solicitud"]);
        }

    } else {
        http_response_code(412);
        echo json_encode(["error" => true, "message" => "Parámetro no permitido"]);
    }

} else {
    http_response_code(404);
    echo json_encode(["error" => true, "message" => "No se encontró la dirección solicitada"]);
}

?>

