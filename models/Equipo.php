<?php

include_once "../conexion/Conexion.php";

class Equipo
{

    private $id;
    private $nombre_equipo;
    private $partidos_ganados;
    private $partidos_perdidos;
    private $partidos_emp;
    private $goles_favor;
    private $goles_contra;
    private $nuevo_equipo;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNombre_equipo(){
        return $this->nombre_equipo;
    }

    public function setNombre_equipo($nombre_equipo){
        $this->nombre_equipo = $nombre_equipo;
    }

    public function getPartidos_ganados(){
        return $this->partidos_ganados;
    }

    public function setPartidos_ganados($partidos_ganados){
        $this->partidos_ganados = $partidos_ganados;
    }

    public function getPartidos_perdidos(){
        return $this->partidos_perdidos;
    }

    public function setPartidos_perdidos($partidos_perdidos){
        $this->partidos_perdidos = $partidos_perdidos;
    }

    public function getPartidos_emp(){
        return $this->partidos_emp;
    }

    public function setPartidos_emp($partidos_emp){
        $this->partidos_emp = $partidos_emp;
    }

    public function getGoles_favor(){
        return $this->goles_favor;
    }

    public function setGoles_favor($goles_favor){
        $this->goles_favor = $goles_favor;
    }

    public function getGoles_contra(){
        return $this->goles_contra;
    }

    public function setGoles_contra($goles_contra){
        $this->goles_contra = $goles_contra;
    }

    public function getNuevo_equipo(){
        return $this->nuevo_equipo;
    }

    public function setNuevo_equipo($nuevo_equipo){
        $this->nuevo_equipo = $nuevo_equipo;
    }

    public static function consultarNombreEquipo(){
        $conexion = new Conexion();
        $sql = "SELECT id, nombre_equipo FROM equipos";
            
        $query = $conexion->prepare($sql);

        $query->execute();
        $query = $query->fetchAll();
        
        $resultados = [];
        $i = 0;

        foreach ($query as $key => $value){

            $resultados[$i] ='
                <option value="'.$value["id"].'">'.$value["nombre_equipo"].'</option>';
                
            $i++;
        }

        return $resultados;
    }

    public static function consultarTopGol(){
        $conexion = new Conexion();
        $sql = '
            SELECT eq.nombre_equipo as Equipo, inte.num_camisa as Numero, inte.goles
            as Goles FROM integrantes inte INNER JOIN equipos eq 
            ON eq.id = inte.id_equipo ORDER BY Goles DESC LIMIT 0,5
        ';
            
        $query = $conexion->prepare($sql);

        $query->execute();
        $query = $query->fetchAll();
        
        $resultados = [];
        $i = 0;

        foreach ($query as $key => $value){

            $resultados[$i] ='
                <tr>
                    <td>'.$value["Equipo"].'</td>
                    <td>'.$value["Numero"].'</td>
                    <td>'.$value["Goles"].'</td>
                <tr>';
                
            $i++;
        }

        return $resultados;
    }

    public static function consultarTopTarAma(){
        $conexion = new Conexion();
        $sql = '
            SELECT eq.nombre_equipo as Equipo,inte.num_camisa as
            Numero,inte.tarjetas_amarillas as tarjetas_amarillas FROM
            integrantes inte INNER JOIN equipos eq ON eq.id = inte.id_equipo
            ORDER BY tarjetas_amarillas DESC LIMIT 0,5
        ';
            
        $query = $conexion->prepare($sql);

        $query->execute();
        $query = $query->fetchAll();
        
        $resultados = [];
        $i = 0;

        foreach ($query as $key => $value){

            $resultados[$i] ='
                <tr>
                    <td>'.$value["Equipo"].'</td>
                    <td>'.$value["Numero"].'</td>
                    <td>'.$value["tarjetas_amarillas"].'</td>
                <tr>';
                
            $i++;
        }

        return $resultados;
    }

    public static function consultarTopTarRoj(){
        $conexion = new Conexion();
        $sql = '
            SELECT eq.nombre_equipo as Equipo, inte.num_camisa as 
            Numero, inte.tarjetas_rojas as tarjetas_rojas FROM
            integrantes inte INNER JOIN equipos eq 
            ON eq.id = inte.id_equipo  ORDER BY tarjetas_rojas DESC LIMIT 0,5
        ';
            
        $query = $conexion->prepare($sql);

        $query->execute();
        $query = $query->fetchAll();
        
        $resultados = [];
        $i = 0;

        foreach ($query as $key => $value){

            $resultados[$i] ='
                <tr>
                    <td>'.$value["Equipo"].'</td>
                    <td>'.$value["Numero"].'</td>
                    <td>'.$value["tarjetas_rojas"].'</td>
                <tr>';
                
            $i++;
        }

        return $resultados;
    }

    public static function consultarTablaPos(){
        $conexion = new Conexion();
		$sql = "
            SELECT @rownum:=@rownum+1 Posicion,t.* FROM  
            (SELECT @rownum:=0) r, (SELECT eq.nombre_equipo, SUM(eq.partidos_ganados)+SUM(eq.partidos_perdidos)
            +SUM(eq.partidos_emp) as PJ,SUM(eq.partidos_ganados) as PG,SUM(eq.partidos_emp) 
            as PE,SUM(eq.partidos_perdidos) as PP,SUM(eq.goles_favor) as GF,SUM(eq.goles_contra)
            as GC,SUM(eq.goles_favor) - SUM(eq.goles_contra) as '+/-',sum(eq.partidos_ganados)
            *3+SUM(eq.partidos_emp)*1 as PT FROM equipos eq GROUP BY eq.nombre_equipo ORDER BY PT DESC) as t 
        ";
			
		$query = $conexion->prepare($sql);	

        $query->execute();
        $query = $query->fetchAll();
        $resultados = [];

        foreach ($query as $key => $value){

		    $resultados[$key] = array(
				$value['Posicion'],
				$value['nombre_equipo'],
				$value['PJ'],
				$value['PG'],
				$value['PE'],
				$value['PP'],
				$value['GF'],
				$value['GC'],
				$value['+/-'],
				$value['PT']
			);
			
			
        }

        return $resultados;
	}

    public static function consultarEquipos(){
        $conexion = new Conexion();
		$sql = "
           SELECT * FROM equipos
        ";
			
		$query = $conexion->prepare($sql);	

        $query->execute();
        $query = $query->fetchAll();
        $resultados = [];

        foreach ($query as $key => $value){

            $historial = '
            <a class="btn btn-primary more-info" title="Ver historial" href="histEquipo.php?id='.$value["id"].'" role="button">
					<span class="fas fa-list-ol"></span>
			</a>
            ';

            $modificar = '
            <button type="button" class="new-equipo btn btn-warning more-info fas fa-pencil-alt" data-toggle="modal" 
                title="Modificar nombre" value="'.$value['nombre_equipo'].'" data-target="#modEquipo">
            </button>
            ';

            $modificar_inte = '
            <a class="btn btn-info more-info" title="Modificar integrantes" 
                href="integrantes.php?id='.$value["id"].'" role="button">
				<span class="fas fa-user"></span>
			</a>
            ';

		    $resultados[$key] = array(
				$value['nombre_equipo'],
				$value['partidos_ganados'],
				$value['partidos_emp'],
                $value['partidos_perdidos'],
                $modificar,
                $historial,
                $modificar_inte
			);
			
			
        }

        return $resultados;
    }

    public static function consHistEquipo($param){
        $conexion = new Conexion();
        $sql = '
            SELECT DISTINCT (SELECT nombre_equipo from equipos where id = el.idEquipo) as "local",
            el.goles_local, el.tarjetas_amarillas_local, el.tarjetas_rojas_local, 
            (SELECT nombre_equipo from equipos where id = ev.idEquipo) as "visitante", 
            ev.goles_visitante, ev.tarjetas_amarillas_visitante, ev.tarjetas_rojas_visitante, 
            j.horario, j.cancha, j.equipo_ganador from jornada j JOIN equipo_local el 
            JOIN equipo_visitante ev on j.idLocal = el.idLocal and
            j.idVisitante = ev.idVisitante WHERE el.idEquipo = :id OR ev.idEquipo = :id
        ';
			
		$query = $conexion->prepare($sql);	

        $idHistorial = (int) $param;

        $query->bindValue(":id", $idHistorial, PDO::PARAM_INT);

        $query->execute();
        $total = $query->rowCount();
        $query = $query->fetchAll();
        $resultados = [];

        if ($total > 0) {
            
            foreach ($query as $key => $value){

                $resultados[$key] = array(
                    $value['local'],
                    $value['goles_local'],
                    $value['tarjetas_amarillas_local'],
                    $value['tarjetas_rojas_local'],
                    $value['visitante'],
                    $value['goles_visitante'],
                    $value['tarjetas_amarillas_visitante'],
                    $value['tarjetas_rojas_visitante'],
                    $value['horario'],
                    $value['cancha'],
                    $value['equipo_ganador']
                );
                
            }

            return $resultados;
        }

        return ["error" => false, "message" => "Aún no existen jornadas"];

    }
    

    public function verificarEquipo() {
        $conexion = new Conexion();

        $sql = "
            SELECT nombre_equipo FROM equipos WHERE nombre_equipo = :nombre_equipo
        ";
			
		$query = $conexion->prepare($sql);	

		$query->bindValue(":nombre_equipo", $this->getNombre_equipo(), PDO::PARAM_STR);

		$query->execute();
		
        $resultado = $query->rowCount();

        if ($resultado > 0) {
            return false;
        }

        return true;
    }

    public function crearEquipo() {
		$conexion = new Conexion();

		try {

		$sql = "
			INSERT INTO equipos VALUES(DEFAULT, :nombre_equipo, 0, 0, 0, 0, 0, 0)
		";

		$query = $conexion->prepare($sql);
		
		$query->bindValue(":nombre_equipo", $this->getNombre_equipo(), PDO::PARAM_STR);

		$query->execute();

        $resultado = $query->rowCount();

        if ($resultado > 0) {
            return ["success" => true, "message" => "Equipo añadido"];
        }

		return ["error" => true, "message" => "Ocurrió un error insesperado"];
      	
		} catch (Exception $e) {
		 	return ["success" => false, "message" => "Ocurrió un error inesperado al insertar los datos",
                  "error" => $e->getMessage(), "exception" => json_encode($e)];		
		}
	}


    public function actualizarEquipo() {
		$conexion = new Conexion();

		try {

		$sql = "
			UPDATE equipos SET nombre_equipo = :nuevo_equipo WHERE nombre_equipo = :nombre_equipo
		";

		$query = $conexion->prepare($sql);
		
        $query->bindValue(":nombre_equipo", $this->getNombre_equipo(), PDO::PARAM_STR);
        $query->bindValue(":nuevo_equipo", $this->getNuevo_equipo(), PDO::PARAM_STR);

		$query->execute();

        $resultado = $query->rowCount();

        if ($resultado > 0) {
            return ["success" => true, "message" => "Equipo actualizado"];
        }

		return ["error" => true, "message" => "El nombre es igual"];
      	
		} catch (Exception $e) {
		 	return ["success" => false, "message" => "Ocurrió un error inesperado al insertar los datos",
                  "error" => $e->getMessage(), "exception" => json_encode($e)];		
		}
	}

    public static function equipoCampeon(){
        $conexion = new Conexion();
		$sql = "
           SELECT * FROM historial_campeon
        ";
			
		$query = $conexion->prepare($sql);	

        $query->execute();
        $query = $query->fetchAll();
        $resultados = [];

        foreach ($query as $key => $value){

		    $resultados[$key] = array(
                "nombre_equipo" => $value['nombre_equipo'],
                "puntos" => $value['puntos'],
                "lugar" => $value['lugar'],
                "temporada" => $value['temporada']
			);
			
        }

        return $resultados;
    }


}

?>