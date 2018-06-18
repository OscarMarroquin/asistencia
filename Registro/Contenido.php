<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body style="background-image: url(imagenes/Fondo.jpg);">
<link rel="stylesheet" href="css/tablasmostrar.css">
<script>
function Lista(id,semestre,grupo,materia,idmateria){
	window.location="ElegirGrupo.php?id="+id+"&semestre="+semestre+"&grupo="+grupo+"&materia="+materia+"&idmateria="+idmateria;
}
</script>
</head>
<body>
<center>
<h3>Mis Materias </h3>
<br/>
<div style="OVERFLOW:auto;WIDTH:800px;HEIGHT:400px">
<table id="table" border=0 cellpadding="0" cellspacing="0">
<?php
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');

	$filtro  = "";
	
	if($tipoUser==2){
		$filtro  = " WHERE ID_DOCENTE='".$usuario."'";
	}
	$contador = 0;
	$contador1= 0;
	$sql      = "SELECT * FROM docente_bimestre ".$filtro."  GROUP BY  ID_BIMESTRE";
	$rs       = mysqli_query($conexion,$sql);
	if(mysqli_num_rows($rs)!=0){
		while($rows = mysqli_fetch_assoc($rs)){
	   
		$contador	 = $contador + 1;
		$body		 = "odd";	
		$semestre    = DatosSemestre($rows['ID_BIMESTRE'],"ID",$conexion);
		$descripcions= DatosSemestre($rows['ID_BIMESTRE'],"DESCRIPCION",$conexion);
		$grupo       = DatosGrupo($rows['ID_GRUPO'],"ID",$conexion);
		if($contador%2){$body="even";}
		echo '<tr><th colspan=4>';
		echo '<center>'.$descripcions.'</center>';
		/*DIBUJAMOS EL CONTENIDO */
		echo '</th></tr>';
		$slx = "SELECT * FROM materias WHERE ID_SEMESTRE='".$semestre."'";
		$rsx = mysqli_query($conexion,$slx);
		if(mysqli_num_rows($rsx)!=0){
			while($rows = mysqli_fetch_assoc($rsx)){
			$contador1	 = $contador1 + 1;
			if($contador1==1){
				echo '<tr>';
				echo '<th>BIMESTRE</th>';
				echo '<th>MATERIA</th>';
				echo '<th>GRUPOS</th>';
				echo '<th>ASISTENCIA</th>';
				echo '</tr>';
			
			}
			$body		 = "odd";
			if($contador1%2){$body="even";}
			echo "<tr class='".$body."'>";
			echo "<td>".$descripcions."</td>";
			echo "<td>".$rows['DESCRIPCION']."</td>";
			echo '<td>'.SplitGrupo($rows['GRUPO'],$conexion,1).'</td>';	
			echo "<td>";
	?>
			<img src='imagenes/MINISELECT.jpg' style='cursor:pointer;' title='PASAR LISTA' onclick="Lista('<?php echo $semestre; ?>','<?php echo $descripcions; ?>','<?php echo $rows['GRUPO']; ?>','<?php echo $rows['DESCRIPCION']; ?>','<?php echo $rows['ID']; ?>')"/>
<?php
			echo "</td>";
			echo "</tr>";
			
			}
		}
		$contador1 = 0;
		

	}
}

?>
</table>
</div>
</center>
</body>
</html>