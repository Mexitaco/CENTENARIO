<?php

include_once "../conexion/Conexion.php";

class Pagos
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
            $sql = "INSERT INTO pagos (id_equipo, fecha_pago, abono, total) ".
                "VALUES(:id_equipo, DEFAULT, :abono, DEFAULT);";

            $query = $conexion->prepare($sql);

            $query->bindValue(":id_equipo", $this->id_equipo, PDO::PARAM_INT);
            $query->bindValue(":abono", $this->abono, PDO::PARAM_INT);

            $query->execute();

            return ["success" => true, "message" => "Abono añadido"];
            
        } catch (Exception $e){
            return ["success" => false, "message" => "Ocurrió un error inesperado2",
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
            SELECT eq.nombre_equipo, max(pag.fecha_pago) as fecha_pago,
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

            $resultados[$key] = array(
                $value['nombre_equipo'],
                $value['fecha_pago'],
                $value['abono'],
                $value['total'],
                $value['Restante']
            );

        }

        return $resultados;
    }

}

?>