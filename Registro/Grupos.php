<script src="js/ajax.js" type="text/javascript"></script>
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/tablasmostrar.css">
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){
	
	divResultado 			= document.getElementById('resultado');
	var txtGrupo 			= document.formularios.txtGrupo.value;
	var id					= document.formularios.id.value;
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/GuardaGrupo.php",true);
	divResultado.innerHTML = " Enviando Datos....";
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtGrupo="+txtGrupo+"&id="+id);
	
}
function Editar(descripcion,id){
	document.formularios.txtGrupo.value=descripcion;
	document.formularios.id.value=id;
}
function Eliminar(id){
	var mensaje = "¿ESTAS SEGURO QUE QUIERES ELIMINAR, UNA VEZ ELIMINADO NO PODRAS RECUPERARLO?";
	if(confirm(mensaje)){
		window.location="Configuracion/EliminarGrupo.php?a="+id;
	}else{
	
	}
}
</script>
<?php
	include('DibujaVentana.php');
	include('Conexion_Abrir.php');
	include('ScreenCatalogo_Seguridad.php');
	include('DataExtra.php');
	Cabecera("Nuevo Grupo");
	$boton		= "salvar";
	$javascript = "";
	echo '<form name="formularios" id="formularios" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	echo '<center>';
	echo '<input type="hidden" name="id" value="0"/>';
	echo '<table border=0>';
	echo '<tr><td colspan="2"><div id="resultado"></div></td></tr>';
	echo '<tr>';
	echo '	<td><strong>Grupo:</strong></td>';
	echo '	<td><input type="text" name="txtGrupo" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';
?>
<center>
<br/>
<div style="OVERFLOW:auto;WIDTH:800px;HEIGHT:100px">
<table id="table" border=0 cellpadding="0" cellspacing="0">
<thead>
<tr>
<th>ID</th>
<th>GRUPO</th>
<th>ESTATUS</th>
<th></th>
<tr>
</thead>
<tbody id="tbody">
<?php
	
	$contador = 0;
	$sql      = "SELECT * FROM grupos Order by DESCRIPCION";
	$rs       = mysqli_query($conexion,$sql);
	if(mysqli_num_rows($rs)!=0){
		while($rows = mysqli_fetch_assoc($rs)){
	   
		$contador	 = $contador + 1;
		$body		 = "odd";	
		if($contador%2){$body="even";}
		echo '<tr class="'.$body.'">';
		echo '<td>'.$contador.'</td>';
		echo '<td>'.$rows['DESCRIPCION'].'</td>';
		echo '<td>'.Estatus($rows['ESTATUS']).'</td>';
		echo '<td>';
?>
	<img src="imagenes/actions-edit.png" style="cursor:pointer;" onclick="Editar('<?php echo $rows['DESCRIPCION']; ?>','<?php echo $rows['ID']; ?>')"/>
		<img src="imagenes/actions-delete.png" style="cursor:pointer;" onclick="Eliminar('<?php echo $rows['ID']; ?>')"/>

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