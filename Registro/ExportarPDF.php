<?php
	//error_reporting(E_ALL); 
	//ini_set("display_errors", 1); 
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	require_once("dompdf/dompdf_config.inc.php");
	$bimestre	= $_GET['bimestre'];
	$grupos		= explode("|",$_GET['grupo']);
	$materias	= $_GET['materia'];
	$html       = "";
	$html='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lista</title>
</head>

<body>';
	if($bimestre==0 or $grupos[0]==0 or $materias==0){header("Location:EligeMateriaGrupo.php");}

	$hoy      = date("Y-m-d");
	$usuario  = $_SESSION['USERCORE'];
	$filtro   = "FECHA between '".str_replace("-","",$hoy)."' and '".str_replace("-","",$hoy)."' AND ID_BIMESTRE='".$bimestre."' AND ID_GRUPO='".$grupos[0]."' AND ID_MATERIA='".$materias."'";
	if(isset($_GET['txtFechaInicial']) OR isset($_GET['txtFechaFinal'])){
		if($_GET['txtFechaInicial']!="" and $_GET['txtFechaFinal']!=""){
			$filtro = "FECHA between '".str_replace("-","",$_GET['txtFechaInicial'])."' and '".str_replace("-","",$_GET['txtFechaFinal'])."' AND ID_BIMESTRE='".$bimestre."' AND ID_GRUPO='".$grupos[0]."' AND ID_MATERIA='".$materias."'";
			
		}
	}
    $sql      = "SELECT FECHA FROM asistencia WHERE ID_DOCENTE='".$usuario."' AND  ".$filtro." GROUP BY FECHA order by FECHA asc";
	

	$html = $html.'<center>';
	$html = $html.'<h3>REPORTE DE ASISTENCIAS </h3>';
	$html = $html.'<table  border=0>';
	$html = $html.'<tr>';
	$html = $html.'<td><strong>Bimestre:</strong>&nbsp;&nbsp;</td>';
	$html = $html.'<td>'.DatosSemestre($bimestre,"DESCRIPCION",$conexion).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	$html = $html.'<td><strong>Grupo:</strong>&nbsp;&nbsp;</td>';
	$html = $html.'<td>'.DatosGrupo($grupos[0],"DESCRIPCION",$conexion).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	$html = $html.'<td><strong>Materia:</strong>&nbsp;&nbsp;</td>';
	$html = $html.'<td>'.DatosMateria($materias,"DESCRIPCION",$conexion).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	$html = $html.'</tr>';
	$html = $html.'</table>';
	$html = $html.'<table width="90%" border=1 cellpadding="0" cellspacing="0">';
	$html = $html.'<thead>';
	$html = $html.'<tr bgcolor="#808080">';
	$html = $html.'<th>No.</th>';
	$html = $html.'<th>Alumno</th>';
	
	$rs       = mysql_query($sql,$conexion);
	if(mysql_num_rows($rs)!=0){
		while($rows = mysql_fetch_assoc($rs)){
			$html = $html.'<th>'.FormatDate($rows['FECHA']).'</th>'; 
		}
	}
	$html = $html.'</tr>';
	$html = $html.'</thead>';
    $html = $html.'<tbody id="tbody">';
/**/
	$contador = 0;
	$sql      = "SELECT * FROM asistencia WHERE ID_DOCENTE='".$usuario."' AND  ".$filtro." GROUP BY ID_ALUMNO order by FECHA asc";
	$rs       = mysql_query($sql,$conexion);
	if(mysql_num_rows($rs)!=0){
		while($rows = mysql_fetch_assoc($rs)){
			
			$contador	 = $contador + 1;
			$body		 = "#C0C0C0";	
			if($contador%2){$body="#ffffff";}
			$html = $html.'<tr bgcolor="'.$body.'">';
			$html = $html.'<td>'.$contador.'</td>';
			$html = $html.'<td>'.DatosAlumnosID($rows['ID_ALUMNO'],"CONCAT(NOMBRE , ' ' , APATERNO , ' ' , AMATERNO) AS NOMBRECOMPLETO",$conexion).'</td>';
			/*DIBUJAMOS ASISTENCIA*/	
			$sqlS      = "SELECT DESCRIPCION FROM asistencia WHERE ID_ALUMNO='".$rows['ID_ALUMNO']."' AND ".$filtro;
			$rsS       = mysql_query($sqlS,$conexion);
			if(mysql_num_rows($rsS)!=0){
				while($rowsS = mysql_fetch_assoc($rsS)){
					$descripcion  = "";
					if($rowsS['DESCRIPCION']=="Presente"){
						$descripcion = "P";
					}
					if($rowsS['DESCRIPCION']=="Ausente"){
						$descripcion = "A";
					}
					if($rowsS['DESCRIPCION']=="Ausente con Permiso"){
						$descripcion = "AESC";
					}
					if($rowsS['DESCRIPCION']=="Tarde"){
						$descripcion = "T";
					}
					$html = $html.'<td>'.$descripcion.'</td>'; 
				}
			}
	
			$html = $html.'</tr>';
			
		}
	
	}
	//$html = $html.$html1;
	$html = $html.'</tbody>';
	$html = $html.'</table>';
	$html = $html.'</center></body></html>';
	//$html = utf8_decode($html);
	//$dompdf=new DOMPDF(); -----------
	//$dompdf->load_html($html); -----------
	////ini_set("memory_limit","128M");
	//$dompdf->render(); -------------
	//$dompdf->stream("Asistencia".$hoy.".pdf"); -----------
	echo $html;
?>


