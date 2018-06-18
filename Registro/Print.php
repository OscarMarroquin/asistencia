<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	//error_reporting(E_ALL); 
	//ini_set("display_errors", 1); 
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$bimestre	= $_GET['bimestre'];
	$grupos		= explode("|",$_GET['grupo']);
	$materias	= $_GET['materia'];
	$html       = "";
	$html='

<body onload="print()">';
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
	$html = $html.'<h3><center>REPORTE DE ASISTENCIAS </center></h3>';
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
	//$html = $html.'<thead>';
	$html = $html.'<tr bgcolor="#808080">';
	$html = $html.'<th>No.</th>';
	$html = $html.'<th>Alumno</th>';
	
	$rs       = mysqli_query($conexion,$sql);
	if(mysqli_num_rows($rs)!=0){
		while($rows = mysqli_fetch_assoc($rs)){
			$html = $html.'<th>'.FormatDate($rows['FECHA']).'</th>'; 
		}
	}
	$html = $html.'<tr>';
	//$html = $html.'</thead>';
	//$html = $html.'<tbody id="tbody">';
/**/
	$contador = 0;
	$sql      = "SELECT * FROM asistencia WHERE ID_DOCENTE='".$usuario."' AND  ".$filtro." GROUP BY ID_ALUMNO order by FECHA asc";
	$rs       = mysqli_query($conexion,$sql);
	if(mysqli_num_rows($rs)!=0){
		while($rows = mysqli_fetch_assoc($rs)){
			
			$contador	 = $contador + 1;
			$body		 = "#C0C0C0";	
			if($contador%2){$body="#ffffff";}
			$html = $html.'<tr bgcolor="'.$body.'">';
			$html = $html.'<td>'.$contador.'</td>';
			$html = $html.'<td>'.DatosAlumnosID($rows['ID_ALUMNO'],"CONCAT(NOMBRE , ' ' , APATERNO , ' ' , AMATERNO) AS NOMBRECOMPLETO",$conexion).'</td>';
			/*DIBUJAMOS ASISTENCIA*/	
			$sqlS      = "SELECT DESCRIPCION FROM asistencia WHERE ID_ALUMNO='".$rows['ID_ALUMNO']."' AND ".$filtro;
			$rsS       = mysqli_query($conexion,$sqlS);
			if(mysqli_num_rows($rsS)!=0){
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
	//$html = $html.'</tbody>';
	$html = $html.'</table>';
	$html = $html.'</center>';
	//$html = utf8_decode($html);
	echo $html;
?>


