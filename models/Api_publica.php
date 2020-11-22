<?php

include_once "../conexion/Conexion.php";

class Api_publica
{

    public function mostrarAvisos() {
        $conexion = new Conexion();
        $sql = 'SELECT titulo, mensaje, fecha FROM avisos';
            
        $query = $conexion->prepare($sql);

        $query->execute();

        $row = $query->rowCount();

        $query = $query->fetchAll();
        
        $resultados = [];
        $i = 0;

        foreach ($query as $key => $value) {

            $resultados[$key] = array(
                "titulo" => $value["titulo"],
                "mensaje" => $value["mensaje"],
                "fecha" => $value["fecha"]
            );

        }
        
        if ($row > 0) {

            return $resultados;
        }
        
        $no_info = ['
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class="service-box-wrap">
                        <div class="service-icon-wrap">
                        </div>
                        <div class="service-cnt-wrap">
                            <h3 class="service-title">NO HAY AVISOS POR EL MOMENTO</h3>
                        </div>
                    </div>
                </div>
            '];
            
        return $no_info;
    }

    public function consultarTopGol(){
        $conexion = new Conexion();
        $sql = '
            SELECT eq.nombre_equipo as Equipo, inte.num_camisa as Numero, inte.goles
            as Goles FROM integrantes inte INNER JOIN equipos eq 
            ON eq.id = inte.id_equipo ORDER BY Goles DESC LIMIT 0,5
        ';
            
        $query = $conexion->prepare($sql);

        $query->execute();

        $row = $query->rowCount();

        $query = $query->fetchAll();
        
        $resultados = [];

        foreach ($query as $key => $value){

            $resultados[$key] = array(
                "equipo" => $value["Equipo"],
                "numero" => $value["Numero"],
                "goles" => $value["Goles"]
            );
            
        }

        if ($row > 0) {

            return $resultados;
        }

        return ["No hay datos por el momento, intente después"];

    }

    public function consultarTopTarAma(){
        $conexion = new Conexion();
        $sql = '
            SELECT eq.nombre_equipo as Equipo,inte.num_camisa as
            Numero,inte.tarjetas_amarillas as tarjetas_amarillas FROM
            integrantes inte INNER JOIN equipos eq ON eq.id = inte.id_equipo
            ORDER BY tarjetas_amarillas DESC LIMIT 0,5
        ';
            
        $query = $conexion->prepare($sql);

        $query->execute();

        $row = $query->rowCount();

        $query = $query->fetchAll();
        
        $resultados = [];

        foreach ($query as $key => $value){

            $resultados[$key] = array(
                "equipo" => $value["Equipo"],
                "numero" => $value["Numero"],
                "tarjetas" => $value["tarjetas_amarillas"]
            );

        }

        if ($row > 0) {

            return $resultados;
        }

        return ["No hay datos por el momento, intente después"];

    }

    public function consultarTopTarRoj(){
        $conexion = new Conexion();
        $sql = '
            SELECT eq.nombre_equipo as Equipo, inte.num_camisa as 
            Numero, inte.tarjetas_rojas as tarjetas_rojas FROM
            integrantes inte INNER JOIN equipos eq 
            ON eq.id = inte.id_equipo  ORDER BY tarjetas_rojas DESC LIMIT 0,5
        ';
            
        $query = $conexion->prepare($sql);

        $query->execute();

        $row = $query->rowCount();

        $query = $query->fetchAll();
        
        $resultados = [];
        $i = 0;

        foreach ($query as $key => $value){

            $resultados[$key] = array(
                "equipo" => $value["Equipo"],
                "numero" => $value["Numero"],
                "tarjetas" => $value["tarjetas_rojas"]
            );
                
        }

        if ($row > 0) {

            return $resultados;
        }

        return ["No hay datos por el momento, intente después"];

    }

    public function consultarTablaPos(){
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

        $row = $query->rowCount();

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

        if ($row > 0) {

            return $resultados;
        }

        return ["No hay datos por el momento, intente después"];
	}


    public function consultaJornada(){
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

        $row = $query->rowCount();

		$query = $query->fetchAll();
		
        $resultados = [];
        
		$verMas = '';


        foreach ($query as $key => $value){

            $verMas = "";

            if ($value['equipo_ganador'] == 'Sin resultados') {
                $verMas .= '
                <a class="btn btn-danger more-info btn-ver-mas" title="Sin resultado"
                    href="resJor.php?id='.$value["id"].'"
                    role="button">
                    <span class="far fa-clock"></span>
                </a>
                ';                
            } else {
                $verMas .= '
                <a class="btn btn-warning more-info btn-ver-mas" title="Ver resultados"
                    href="resJor.php?id='.$value["id"].'"
                    role="button">
                    <span class="fa fa-info"></span>
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

        if ($row > 0) {
            
            return $resultados;
        }

        return ['Sin resultados, intente más tarde'];

    }
    
    public function consultaVerMas($verMas){
        $conexion = new Conexion();
		$sql = '
			SELECT (SELECT nombre_equipo from equipos where id = el.idEquipo) as "local",
			el.goles_local, el.tarjetas_amarillas_local, el.tarjetas_rojas_local,
			(SELECT nombre_equipo from equipos where id = ev.idEquipo) as "visitante",
			ev.goles_visitante, ev.tarjetas_amarillas_visitante, ev.tarjetas_rojas_visitante, j.horario,
			j.cancha, j.equipo_ganador from jornada j JOIN equipo_local el JOIN equipo_visitante ev 
			on j.idLocal = el.idLocal and j.idVisitante = ev.idVisitante WHERE id = '.$verMas.'; ';
			
		$query = $conexion->prepare($sql);	

        $query->execute();
        $query = $query->fetchAll();
        $resultados = [];

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


    public static function consultarEquipos(){
        $conexion = new Conexion();
		$sql = "
           SELECT * FROM equipos
        ";
			
		$query = $conexion->prepare($sql);	

        $query->execute();

        $row = $query->rowCount();

        $query = $query->fetchAll();

        $resultados = [];

        foreach ($query as $key => $value){

            $historial = '
            <a class="btn btn-primary more-info" title="Ver historial" href="histEquipo.php?id='.$value["id"].'" role="button">
					<span class="fas fa-list-ol"></span>
			</a>
            ';

		    $resultados[$key] = array(
				$value['nombre_equipo'],
				$value['partidos_ganados'],
				$value['partidos_emp'],
                $value['partidos_perdidos'],
                $historial
			);
			
			
        }

        
        if ($row > 0) {

            return $resultados;
        }

        return ["No hay datos por el momento, intente después"];
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


    public static function equipoCampeon(){
        $conexion = new Conexion();
		$sql = "
           SELECT * FROM historial_campeon
        ";
			
		$query = $conexion->prepare($sql);	

        $query->execute();
        $query = $query->fetchAll();
        $resultados = [];
        $cont = 0;
        $otro = 0;

        foreach ($query as $key => $value){

            if ($cont <= 3) {
             
                $lugar[$cont++] = array(
                    "nombre_equipo" => $value['nombre_equipo'],
                    "puntos" => $value['puntos'],
                );
            }
            
            $resultados[$otro] = $lugar;
                            
            if ($cont == 3) {
                $otro++;  
                $lugar = [];
                $cont=0;
            } 
                
        }

        return $resultados;
    }

}

?>