<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="js/ajax.js" type="text/javascript"></script>
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/tablasmostrar.css">
<script LANGUAGE="JavaScript">
function Nuevo(){
	window.location="NuevoUsuario.php";
}
function Eliminar(id){
	var mensaje = "¿ESTAS SEGURO QUE QUIERES ELIMINAR, UNA VEZ ELIMINADO NO PODRAS RECUPERARLO?";
	if(confirm(mensaje)){
		window.location="Configuracion/EliminarUsuarios.php?a="+id;
	}else{
	
	}
}
function Editar(id){
	window.location="EditarUsuario.php?a="+id;
}
function Password(id){
	window.location="EditarPassword.php?a="+id;
}
</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$filtro = "";
	if($idUsuario!=1){
		$filtro = "AND ID_ESCUELA='".$idEscuela."' ";
	}
?>
<center>
<body style="background-image: url(imagenes/Fondo.jpg);">
<br/>
<div style="OVERFLOW:auto;WIDTH:90%;HEIGHT:600px">
<table><tr><td colspan="7" style="align:left;" ><button class="clean-gray" onclick="Nuevo()">NUEVO</button></td></tr></table>
<table id="table" border=0 cellpadding="0" cellspacing="0">
<thead>
<tr>
<th></th>
<th>NOMBRE</th>
<th>DIRECCION</th>
<th>EMAIL</th>
<th>TELEFONO</th>
<th>TIPO USUARIO</th>
<th>ESCUELA</th>
<tr>
</thead>
<tbody id="tbody">
<?php
	$contador = 0;
$sql      = "SELECT * FROM usuarios WHERE TIPO_USUARIO=1 ".$filtro." Order by ID ";
$rs       = mysqli_query($conexion,$sql);
if(mysqli_num_rows($rs)!=0){
	while($rows = mysqli_fetch_assoc($rs)){
	  
		$contador	 = $contador + 1;
		$body		 = "odd";	
		if($contador%2){$body="even";}
		echo '<tr class="'.$body.'">';
		echo '<td>';
?>
		<img src="imagenes/MINICAMBIOS.jpg" style="cursor:pointer;" title="EDITAR <?php echo $rows['NOMBRE'].' '.$rows['APATERNO'].' '.$rows['AMATERNO']; ?>" onclick="Editar('<?php echo $rows['ID']; ?>')"/> 		
		<?php if($idUsuario==1){ ?>
		<img src="imagenes/MINILLAVE.jpg" onclick="Password('<?php echo $rows['ID']; ?>')" style="cursor:pointer" title="CAMBIAR PASSWORD A <?php echo $rows['NOMBRE'].' '.$rows['APATERNO'].' '.$rows['AMATERNO']; ?>"/>
		<img src="imagenes/MINISELECT.jpg" style="cursor:pointer" title="ASIGNAR PERMISOS A  <?php echo $rows['NOMBRE'].' '.$rows['APATERNO'].' '.$rows['AMATERNO']; ?>"/>
		<?php } 
		if ($rows['ID']!=1){?>
		<img src="imagenes/MINIELIMINAR.jpg" title="ELIMINAR <?php echo $rows['NOMBRE'].' '.$rows['APATERNO'].' '.$rows['AMATERNO']; ?>" style="cursor:pointer;" onclick="Eliminar('<?php echo $rows['ID']; ?>')"/>			
<?php
		}
		echo '</td>';
		echo '<td>'.$rows['NOMBRE'].' '.$rows['APATERNO'].' '.$rows['AMATERNO'].'</td>';
		echo '<td>'.$rows['DIRECCION'].'</td>';
		echo '<td>'.$rows['EMAIL'].'</td>';
		echo '<td>'.$rows['TELEFONO'].'</td>';		
		
		if($rows['ID']==1){
			echo '<td>SUPER ADMINISTRADOR</td>';
			echo '<td>SUPER ADMINISTRADOR</td>';
		}else{
			echo '<td>ADMINISTRADOR</td>';
			echo '<td>'.DatosEscuela($rows['ID_ESCUELA'],"NOMBRE",$conexion).'</td>';
		}
		echo '</tr>';
	}
}

?>
</tbody>
</table>
</div>
</center>