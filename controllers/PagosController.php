<?php
include_once "../models/Pago.php";
include_once "../auth/Session.php" ;
include_once "../auth/AuthSession.php";

if(AuthSession::getUsuario() == null){
    header('Location: ../views/login.php');
}

$sw;

if (isset($_GET['consulta'])) {
    $sw = 1;
}

if (isset($_GET["save-pagos"])) {
    $sw = 2;
}

switch ($sw) {
    
    case 1:
    
        if (isset($_GET['consulta'])) {

            $pago = new Pago();
            $response = $pago->consultar();
            echo json_encode($response);
        }

    break;

    case 2:

        if(isset($_GET["save-pagos"])) {

            if ($_GET['save-pagos'] == 'true') {
                
                if (isset($_POST['equipo']) && $_POST['equipo'] != "") {
                    
                    if (isset($_POST['abono']) && $_POST['abono'] != "") {
                        
                        $pagos = new Pago();
        
                        $flag = false;
        
                        $equipo = (int) $_POST['equipo'];
                        $abono = (int) $_POST['abono'];
        
                        if ($equipo > 0){
        
                            $pagos->setId_Equipo($equipo);
                            $flag = true;
        
                            $resultado = $pagos->consultar($equipo);
        
                            if ($resultado == null) {
                                $maximo = 7000;
                            } else {
                                $maximo = (int) $resultado[0][4];
                            }
                            
                            if ($abono > 1) {
        
                                if ($abono <= $maximo) {
                                    
                                    $flag = true;
                                    $pagos->setAbono($abono);
            
                                    if ($flag != false) {
            
                                        $response = $pagos->save();
                                        echo json_encode($response);
            
                                    } else {
                                        http_response_code(422);
                                        echo json_encode(["error" => true, "message" => "La solicitud fue enviada, pero no hubo respuesta"]);
                                    }
        
                                } else {
                                    http_response_code(424);
                                    echo json_encode(["error" => true, "message" => "El valor excede la deuda"]);   
                                }
        
                            } else {
                                $flag = false;
                                http_response_code(424);
                                echo json_encode(["error" => true, "message" => "Valor no admitido en abono"]);    
                            }
        
                        } else {
                            $flag = false;
                            http_response_code(424);
                            echo json_encode(["error" => true, "message" => "Valor no admitido en equipo"]);    
                        }
        
                    } else {
                        http_response_code(424);
                        echo json_encode(["error" => true, "message" => "Valor no admitido en abono"]);    
                    }
        
                } else {
                    http_response_code(424);
                    echo json_encode(["error" => true, "message" => "Valor no admitido en equipo"]);    
                }
        
            } else {
                http_response_code(400);
                echo json_encode(["error" => true, "message" => "Hubo un error al procesar la solicitud"]);
            }
        
        } else {
            http_response_code(400);
            echo json_encode(["error" => true, "message" => "Error en la solitud"]);
        }
        
    break;
    
}


