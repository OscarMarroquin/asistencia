<?php
	date_default_timezone_set('America/Mexico_City');
	function hoy(){
	return date("Y").date("m").date("d");
	}
	function horaactual() {
		
		$horaactual = intval(date('H'));
		$horaactual = right('00'.trim($horaactual),2);
		$minuactual = intval(date('i'));
		$minuactual = right('00'.trim($minuactual),2);
		$segundoAct = intval(date('s'));
		$segundoAct = right('00'.trim($segundoAct),2);
		$horaactual = $horaactual.":".$minuactual.":".$segundoAct;
		return $horaactual;
	}
	function DatosSemestre($id,$campo,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT ".$campo." FROM semestre WHERE ID=".$id;
		$rs  = mysqli_query($conexion,$sql);
		if(mysqli_num_rows($rs)!=0){
			$row = mysqli_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;
	}
	function DatosMateria($id,$campo,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT ".$campo." FROM materias WHERE ID=".$id;
		$rs  = mysqli_query($conexion,$sql);
		if(mysqli_num_rows($rs)!=0){
			$row = mysqli_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;
	}
	function DatosUsuarios($id,$campo,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT ".$campo." FROM usuarios WHERE ID=".$id;
		$rs  = mysqli_query($conexion,$sql);
		if(mysqli_num_rows($rs)!=0){
			$row = mysqli_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;
	}
	function DatosGrupo($id,$campo,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT ".$campo." FROM grupos WHERE ID='".$id."'";
		
		$rs  = mysqli_query($conexion,$sql);
		if(mysqli_num_rows($rs)!=0){
			$row = mysqli_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;
	}
	function TraeSemestreGrupo($id,$campo,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT ".$campo." FROM alumno_semestre_grupo WHERE ID=".$id;
		$rs  = mysqli_query($conexion,$sql);
		if(mysqli_num_rows($rs)!=0){
			$row = mysqli_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;
	}
	function Estatus($campo){
		$ValorRetorna = "ACTIVO";
		if($campo==1){
			$ValorRetorna = "INACTIVO";
		}
		return $ValorRetorna;
	}
	function DatosAlumnos($id,$campo,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT ".$campo." FROM alumnos WHERE CURP='".$id."'";
		$rs  = mysqli_query($conexion,$sql);
		if(mysqli_num_rows($rs)!=0){
			$row = mysqli_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;
	}
	function DatosAlumnosID($id,$campo,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT ".$campo." FROM alumnos WHERE ID='".$id."'";
		$rs  = mysqli_query($conexion,$sql);
		if(mysqli_num_rows($rs)!=0){
			$row = mysqli_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;
	}
	function DatosTutores($id,$campo,$conexion){
		$ValorRetorna = "";
		$sql = "SELECT ".$campo." FROM inscripciones WHERE CURP='".$id."'";
		$rs  = mysqli_query($conexion,$sql);
		if(mysqli_num_rows($rs)!=0){
			$row = mysqli_fetch_array($rs);
			$ValorRetorna = $row[0];
		}
		return $ValorRetorna;
	}
	
	function VerificarDireccionCorreo($direccion)
	{
		$Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
		if(preg_match($Sintaxis,$direccion))
			return true;
		else
			return false;
	}
	function SplitGrupo($cadena,$conexion,$control){
		$valorRetorna = "";
		$explode	= explode(",",$cadena);
		$cuantos    = count($explode);
		if($control==2){
			return $cuantos;
		}
		if($control==1){
			if($cuantos>1){
				for($i=0;$i<$cuantos;$i++){		
					$valorRetorna = $valorRetorna.", ".DatosGrupo($explode[$i],"DESCRIPCION",$conexion);
				}
				$valorRetorna = substr($valorRetorna,1);
			}		
			if($cuantos<=1){
				$valorRetorna = DatosGrupo($cadena,"DESCRIPCION",$conexion);
			}
			return $valorRetorna;
		}
	}
	
	function right($value, $count){
		return substr($value, ($count*-1));
	}
	function left($string, $count){
		return substr($string, 0, $count);
	}
	function FormatDate($fechaaformatear){
    $mes="";
	if (substr($fechaaformatear,4,2)=="01") {$mes="ENE";}
	if (substr($fechaaformatear,4,2)=="02") {$mes="FEB";}
	if (substr($fechaaformatear,4,2)=="03") {$mes="MAR";}
	if (substr($fechaaformatear,4,2)=="04") {$mes="ABR";}
	if (substr($fechaaformatear,4,2)=="05") {$mes="MAY";}
	if (substr($fechaaformatear,4,2)=="06") {$mes="JUN";}
	if (substr($fechaaformatear,4,2)=="07") {$mes="JUL";}
	if (substr($fechaaformatear,4,2)=="08") {$mes="AGO";}
	if (substr($fechaaformatear,4,2)=="09") {$mes="SEP";}
	if (substr($fechaaformatear,4,2)=="10") {$mes="OCT";}
	if (substr($fechaaformatear,4,2)=="11") {$mes="NOV";}
	if (substr($fechaaformatear,4,2)=="12") {$mes="DIC";}
    return substr($fechaaformatear,0,4)."-".$mes."-".substr($fechaaformatear,6,2);
}
	function encrypt($string, $key) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}

function decrypt($string, $key) {
   $result = '';
   echo $string;
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}
?>