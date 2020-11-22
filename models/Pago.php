<?php

include_once "../conexion/Conexion.php";

class Pago
{
    private $id;
    private $id_equipo;
    private $fecha_pago;
    private $abono;
    private $total;

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

    public function getFecha_pago(){
        return $this->fecha_pago;
    }

    public function setFecha_pago($fecha_pago){
        $this->fecha_pago = $fecha_pago;
    }

    public function getAbono(){
        return $this->abono;
    }

    public function setAbono($abono){
        $this->abono = $abono;
    }

    public function getTotal(){
        return $this->total;
    }

    public function setTotal($total){
        $this->total = $total;
    }

    public function save() {
        $conexion = new Conexion();

        try{
            $sql = "
                INSERT INTO pagos (id, id_equipo, fecha_pago, abono, total) ".
                "VALUES(
                    DEFAULT,
                    (SELECT id FROM equipos WHERE id = :id_equipo),
                    :fecha_pago,
                    :abono,
                    DEFAULT)
                ;";

            $query = $conexion->prepare($sql);

            $formato = "Y-m-d H:i:s";
            $fecha = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $this->fecha_pago = $fecha->format($formato);

            $query->bindValue(":id_equipo", $this->id_equipo, PDO::PARAM_INT);
            $query->bindValue(":abono", $this->abono, PDO::PARAM_INT);
            $query->bindValue(":fecha_pago", $this->fecha_pago, PDO::PARAM_STR);

            $query->execute();

            $error = $query->errorInfo();

            if ($error[2] != '') {
                //print_r($query->errorInfo());
                return ["error" => true, "message" => "Equipo inexistente"];
            } else {
                return ["success" => true, "message" => "Abono añadido"];
            }

        } catch (Exception $e){
            return ["success" => false, "message" => "Ocurrió un error inesperado",
                "error" => $e->getMessage(), "exception" => json_encode($e)];
        }
    }

    public static function consultar($idVerificar = ""){
        $conexion = new Conexion();

        if ($idVerificar != NULL && $idVerificar != "" && $idVerificar > 0) {
            $opcional = 'WHERE id_equipo = ';
            $idVerificar = $opcional.$idVerificar;
        }
        
        $sql = "
            SELECT pag.id_equipo,eq.nombre_equipo, max(pag.fecha_pago) as fecha_pago,
            SUM(pag.abono) as abono, MIN(pag.total)as total,
            MIN(pag.total)-SUM(pag.abono) as Restante
            FROM equipos eq INNER JOIN pagos pag 
            ON eq.id = pag.id_equipo ".$idVerificar." GROUP BY pag.id_equipo
        ";
            
        $query = $conexion->prepare($sql);

        $query->execute();
        $query = $query->fetchAll();
        $resultados = [];

        foreach ($query as $key => $value){

            $masdetalles = '
                <a class="btn btn-primary more-info" title="Ver Historial"
                    href="historialPagos.php?id='.$value["id_equipo"].'" role="button" >
                    <span class="fas fa-external-link-alt"></span>
                </a>
            ';

            $resultados[$key] = array(
                $value['nombre_equipo'],
                $value['fecha_pago'],
                $value['abono'],
                $value['total'],
                $value['Restante'],
                $masdetalles
            );

        }

        return $resultados;
    }


    public static function historialPago($va){
        $conexion = new Conexion();
        $sql = '
           SELECT eq.nombre_equipo, pag.fecha_pago as fecha_pago,
            pag.abono as abono
            FROM equipos eq INNER JOIN pagos pag 
            ON eq.id = pag.id_equipo and eq.id = '.$va.'
        ';
            
        $query = $conexion->prepare($sql);
        $query->execute();
        $query = $query->fetchAll();
        
        $resultados = [];
        $i = 0;

        foreach ($query as $key => $value){

           $resultados[$key] = array(
               $value["nombre_equipo"],
               $value["fecha_pago"],
               $value["abono"]);
        }
        return $resultados;
    }

}

?>