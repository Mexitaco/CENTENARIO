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
    private $num_jornada;

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

    public function getNum_jornada(){
        return $this->num_jornada;
    }

    public function setNum_jornada($num_jornada){
        $this->num_jornada = $num_jornada;
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
            SELECT * FROM(SELECT eq.nombre_equipo as Equipo,inte.num_camisa as Numero,SUM(inte.goles)
            as Goles FROM integrantes inte INNER JOIN equipos eq ON eq.id = inte.id GROUP by inte.id )
            as b ORDER BY Goles DESC LIMIT 0,5
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
            SELECT * FROM(SELECT eq.nombre_equipo as Equipo,inte.num_camisa as
            Numero,SUM(inte.tarjetas_amarillas) as tarjetas_amarillas FROM
            integrantes inte INNER JOIN equipos eq ON eq.id = inte.id GROUP by inte.id )
            as b ORDER BY tarjetas_amarillas DESC LIMIT 0,5
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
            SELECT * FROM(SELECT eq.nombre_equipo as Equipo,inte.num_camisa as 
            Numero,SUM(inte.tarjetas_rojas) as tarjetas_rojas FROM
            integrantes inte INNER JOIN equipos eq ON eq.id = inte.id GROUP by inte.id )
            as b ORDER BY tarjetas_rojas DESC LIMIT 0,5
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

}

?>