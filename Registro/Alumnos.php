<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="js/ajax.js" type="text/javascript"></script>
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/tablasmostrar.css">
<script LANGUAGE="JavaScript">
function Nuevo(){
	window.location="NuevoAlumno.php";
}
function Editar(id){
	window.location="EditarAlumno.php?id="+id;
}
function Eliminar(id){
	var mensaje = "¿ESTAS SEGURO QUE QUIERES ELIMINAR, UNA VEZ ELIMINADO NO PODRAS RECUPERARLO?";
	if(confirm(mensaje)){
		//window.location="Configuracion/EliminarDocente.php?a="+id;
	}else{
	
	}
}
function ChangeSemestre(id,sg){
	window.location="ChangeSemestre.php?id="+id+"&sg="+sg;
}

</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');	
	include('DataExtra.php');
?>
<center>
<body style="background-image: url(imagenes/Fondo.jpg);">
<br/>
<div style="OVERFLOW:auto;WIDTH:80%;HEIGHT:400px">
<table><tr><td colspan="7" style="align:left;" ><button class="clean-gray" onclick="Nuevo()">NUEVO</button></td></tr></table>
<table id="table" border=0 cellpadding="0" cellspacing="0" >
<thead>
<tr>

<th>NOMBRE</th>
<th>CARNET</th>
<th>GRADO</th>
<th>GRUPO</th>



<th></th>
<tr>
</thead>
<tbody id="tbody">
<?php
$filtro = "";

$contador = 0;
$sql      = "SELECT * FROM alumnos ".$filtro." Order by NOMBRE ";
$rs       = mysqli_query($conexion,$sql);
if(mysqli_num_rows($rs)!=0){
	while($rows = mysqli_fetch_assoc($rs)){
	  
		$contador	 = $contador + 1;
		$body		 = "odd";	
		$grupo       = TraeSemestreGrupo($rows['ID_SG'],"ID_GRUPO",$conexion);
		$semestre    = TraeSemestreGrupo($rows['ID_SG'],"ID_SEMESTRE",$conexion);
		if($contador%2){$body="even";}
		echo '<tr class="'.$body.'">';
		
		echo '<td>'.$rows['NOMBRE'].' '.$rows['APATERNO'].' '.$rows['AMATERNO'].'</td>';
		echo '<td>'.$rows['CARNET'].'</td>';
		echo '<td>'.DatosSemestre($semestre,"DESCRIPCION",$conexion).'</td>';
		echo '<td>'.DatosGrupo($grupo,"DESCRIPCION",$conexion).'</td>';
		//echo '<td>'.$rows['SECCION'].'</td>';
		
echo '<td>';
?>
		<img src="imagenes/actions-edit.png" style="cursor:pointer;"title="Editar" onclick="Editar('<?php echo $rows['ID']; ?>')"/>
		<img src="imagenes/actions-delete.png" style="cursor:pointer;" title="Eliminar" onclick="Eliminar('<?php echo $rows['ID']; ?>')"/>
		<img src="imagenes/MINIPAQUETE.jpg" style="cursor:pointer;" title="Cambiar Semestre y Grupo" onclick="ChangeSemestre('<?php echo $rows['ID']; ?>','<?php echo $rows['ID_SG']; ?>')"/>
		
<?php
		echo '</td>';
		echo '</tr>';
	}
}

?>
</tbody>
</table>
</div>
</center>