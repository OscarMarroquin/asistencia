<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>	
<link rel="stylesheet" href="css/tablasmostrar.css">
<?php
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$grupo		= $_GET['grupo'];
	$semestre	= $_GET['semestre'];
	$idmateria  = $_GET['idmateria'];
?>
<center>
<div style="OVERFLOW:auto;WIDTH:800px;HEIGHT:400px">
<form name="lista" method="post" action="Configuracion/GuardaAsistencia.php">
<h3>LISTA DE ASISTENCIA <?php echo DatosSemestre($semestre,"DESCRIPCION",$conexion); ?> GRUPO <?php echo DatosGrupo($grupo,"DESCRIPCION",$conexion); ?></h3>
<small><font color="red">Nota: Debe de Llenar los Campos Correspondientes</font></small>
<table id="table" border=0 cellpadding="0" cellspacing="0" >
<tr>
<th>NUMERO</th>
<th>ALUMNO</th>
<th colspan=4>SELECCIONE UNA OPCION</th>
</tr>
<?php
	$contador1 = 0;
	$sql = "SELECT ID_ALUMNO FROM alumno_semestre_grupo where ESTATUS=0 AND ID_GRUPO='".$grupo."' AND ID_SEMESTRE='".$semestre."' ORDER BY ID_ALUMNO ";
	$rs  = mysqli_query($conexion,$sql);
	if(mysqli_num_rows($rs)!=0){
		while($row = mysqli_fetch_assoc($rs)){
			$contador1	 = $contador1 + 1;
			$body		 = "odd";
			$presente    = ExisteLista($semestre,$grupo,$row['ID_ALUMNO'],$idmateria,"Presente");
			$tarde       = ExisteLista($semestre,$grupo,$row['ID_ALUMNO'],$idmateria,"Tarde");
			$ausente     = ExisteLista($semestre,$grupo,$row['ID_ALUMNO'],$idmateria,"Ausente");
			$permiso     = ExisteLista($semestre,$grupo,$row['ID_ALUMNO'],$idmateria,"Ausente con Permiso");
			if($presente==1){$presente = "checked=true";}else{$presente="";}
			if($tarde==1){$tarde = "checked=true";}else{$tarde="";}
			if($ausente==1){$ausente = "checked=true";}else{$ausente="";}
			if($permiso==1){$permiso = "checked=true";}else{$permiso="";}
			if($contador1%2){$body="even";}
			echo "<tr class='".$body."'>";
			echo "<td>".$contador1."</td>";
			echo "<td>".DatosAlumnosID($row['ID_ALUMNO'],"NOMBRE",$conexion).' '.DatosAlumnosID($row['ID_ALUMNO'],"APATERNO",$conexion).' '.DatosAlumnosID($row['ID_ALUMNO'],"AMATERNO",$conexion)."</td>";
			echo '<td><input name="asistencia[]'.$row['ID_ALUMNO'].'" '.$presente.' type="radio" value="'.$semestre.'|'.$grupo.'|'.$row['ID_ALUMNO'].'|Presente|'.$idmateria.'">Presente</td>';	
			echo '<td><input name="asistencia[]'.$row['ID_ALUMNO'].'" '.$tarde.' type="radio" value="'.$semestre.'|'.$grupo.'|'.$row['ID_ALUMNO'].'|Tarde|'.$idmateria.'">Tarde</td>';
			echo '<td><input name="asistencia[]'.$row['ID_ALUMNO'].'" '.$ausente.' type="radio" value="'.$semestre.'|'.$grupo.'|'.$row['ID_ALUMNO'].'|Ausente|'.$idmateria.'">Ausente</td>';
			echo '<td><input name="asistencia[]'.$row['ID_ALUMNO'].'" '.$permiso.' type="radio" value="'.$semestre.'|'.$grupo.'|'.$row['ID_ALUMNO'].'|Ausente con Permiso|'.$idmateria.'">Ausente con Permiso</td>';
			echo "</tr>";		
		}	
		echo '<tr><td colspan=6><center><button class="clean-gray" onclick="hola">SALVAR</button></center></td></tr>';
	}else{
		echo '<tr><td colspan=6><center>Sin Registros</center></td></tr>';
	}

?>

</table>
</form>
</div>
</center>
<?php
function ExisteLista($semestre,$grupo,$alumno,$materia,$lista){
	global $conexion;
	date_default_timezone_set('America/Mexico_City');
	$slx = "SELECT ID FROM asistencia WHERE ID_BIMESTRE='".$semestre."' AND ID_GRUPO='".$grupo."' AND ID_ALUMNO='".$alumno."' AND DESCRIPCION='".$lista."' AND ID_MATERIA='".$materia."' AND FECHA='".date("Ymd")."'";
	$rsx = mysqli_query($conexion,$slx);
	if(mysqli_num_rows($rsx)!=0){
		return 1;
		echo $slx."<br/>";
	}else{
		return 0;
	}
	
}
?>