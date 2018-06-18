<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="css/tablasmostrar.css">
<link rel="stylesheet" type="text/css" href="calendario/tcal.css" />
<script type="text/javascript" src="calendario/tcal.js"></script>
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<script>
function PDF(bimestre,grupo,materia,txtFechaInicial,txtFechaFinal){
	window.location="ExportarPDF.php?bimestre="+bimestre+"&grupo="+grupo+"&materia="+materia+"&txtFechaInicial="+txtFechaInicial+"&txtFechaFinal="+txtFechaFinal;
}
function IMPRIMIR(bimestre,grupo,materia,txtFechaInicial,txtFechaFinal){
	window.location="Print.php?bimestre="+bimestre+"&grupo="+grupo+"&materia="+materia+"&txtFechaInicial="+txtFechaInicial+"&txtFechaFinal="+txtFechaFinal;
}
</script>
<body style="background-image: url(imagenes/Fondo.jpg);">
<?php
	date_default_timezone_set('America/Mexico_City');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$bimestre	= $_POST['bimestre'];
	$grupos		= explode("|",$_POST['grupo']);
	$materias	= $_POST['materia'];
	
	if($bimestre==0 or $grupos[0]==0 or $materias==0){header("Location:EligeMateriaGrupo.php");}
    
	$hoy      = date("Y-m-d");
	$inicial  = date("Y-m-d");
	$final    = date("Y-m-d");
	$usuario  = $_SESSION['USERCORE'];
	$filtro   = "FECHA between '".str_replace("-","",$hoy)."' and '".str_replace("-","",$hoy)."' AND ID_BIMESTRE='".$bimestre."' AND ID_GRUPO='".$grupos[0]."' AND ID_MATERIA='".$materias."'";
	if(isset($_POST['txtFechaInicial']) OR isset($_POST['txtFechaFinal'])){
		if($_POST['txtFechaInicial']!="" and $_POST['txtFechaFinal']!=""){
			$filtro = "FECHA between '".str_replace("-","",$_POST['txtFechaInicial'])."' and '".str_replace("-","",$_POST['txtFechaFinal'])."' AND ID_BIMESTRE='".$bimestre."' AND ID_GRUPO='".$grupos[0]."' AND ID_MATERIA='".$materias."'";
			$inicial = $_POST['txtFechaInicial'];
			$final   = $_POST['txtFechaFinal'];
			
		}
	}
    $sql      = "SELECT FECHA FROM asistencia WHERE ID_DOCENTE='".$usuario."' AND  ".$filtro." GROUP BY FECHA order by FECHA asc";
?>
<center>
<h3>REPORTE DE ASISTENCIAS - <?php echo DatosSemestre($bimestre,"DESCRIPCION",$conexion); ?> <br/>GRUPO - <?php echo DatosGrupo($grupos[0],"DESCRIPCION",$conexion); ?> <br/>MATERIA - <?php echo DatosMateria($materias,"DESCRIPCION",$conexion); ?></h3>
<form name="busqueda" method="post" action="ConsultarAsistencia.php">
<input type="hidden" name="bimestre" value="<?php echo $_POST['bimestre']; ?>"/>
<input type="hidden" name="grupo" value="<?php echo $_POST['grupo']; ?>"/>
<input type="hidden" name="materia" value="<?php echo $_POST['materia']; ?>"/>
<table>
<tr>
<td>Fecha Inicial:</td><td><input type="text" value="<?php echo $inicial; ?>" name="txtFechaInicial" class="tcal" size="40" x-webkit-speech="true"/></td>
<td>Fecha Inicial:</td><td><input type="text" value="<?php echo $final; ?>" name="txtFechaFinal" class="tcal" size="40" x-webkit-speech="true"/></td>
<td><button class="clean-gray"> Buscar </button></td>
<td><img src="imagenes/Filetype-PDF-icon.png" style="cursor:pointer;" onclick="PDF('<?php echo $bimestre; ?>','<?php echo $grupos[0]; ?>','<?php echo $materias; ?>','<?php echo $inicial; ?>','<?php echo $final; ?>')" title="EXPORTAR a PDF"/></td>
<td><img src="imagenes/print-icon.png" style="cursor:pointer;" onclick="IMPRIMIR('<?php echo $bimestre; ?>','<?php echo $grupos[0]; ?>','<?php echo $materias; ?>','<?php echo $inicial; ?>','<?php echo $final; ?>')" title="IMPRIMIR"/></td>
</tr>
</table>
</form>
<br/>
<div style="OVERFLOW:auto;WIDTH:1200px;HEIGHT:500px">
<table id="table" border=0 cellpadding="0" cellspacing="0">
<thead>
<tr>
<th>No.</th>
<th>Alumno</th>
<?php	
	$rs       = mysqli_query($conexion,$sql);
	if(mysqli_num_rows($rs)!=0){
		while($rows = mysqli_fetch_assoc($rs)){
			echo '<th>'.FormatDate($rows['FECHA']).'</th>'; 
		}
	}
	
?>

<tr>
</thead>
<tbody id="tbody">
<?PHP
/**/
$contador = 0;
$sql      = "SELECT * FROM asistencia WHERE ID_DOCENTE='".$usuario."' AND  ".$filtro." GROUP BY ID_ALUMNO order by FECHA asc";
$rs       = mysqli_query($conexion,$sql);
if(mysqli_num_rows($rs)!=0){
	while($rows = mysqli_fetch_assoc($rs)){
		
		$contador	 = $contador + 1;
		$body		 = "odd";	
		if($contador%2){$body="even";}
		echo '<tr class="'.$body.'">';
		echo '<td>'.$contador.'</td>';
		echo '<td>'.DatosAlumnosID($rows['ID_ALUMNO'],"CONCAT(NOMBRE , ' ' , APATERNO , ' ' , AMATERNO) AS NOMBRECOMPLETO",$conexion).'</td>';
		/*DIBUJAMOS ASISTENCIA*/	
		$sqlS      = "SELECT DESCRIPCION FROM asistencia WHERE ID_ALUMNO='".$rows['ID_ALUMNO']."' AND ".$filtro;
		$rsS       = mysqli_query($conexion,$sqlS);
		if(mysqli_num_rows($rsS)!=0){
			while($rowsS = mysqli_fetch_assoc($rsS)){
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
				echo '<td>'.$descripcion.'</td>'; 
			}
		}

		echo '</tr>';
		
	}

}else{
	echo "<tr><td colspan='8'><center><img src='imagenes/error.png'/> No Hay Registros</center></td></tr>";
}

?>
</tbody>
</table>
</div>
</center>