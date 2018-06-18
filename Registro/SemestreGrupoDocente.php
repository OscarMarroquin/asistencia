
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="js/ajax.js" type="text/javascript"></script>
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/tablasmostrar.css">
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){
	
	divResultado 		= document.getElementById('resultado');
	var Semestre 	    = document.formularios.Semestre.value;
	var id				= document.formularios.id.value;
	var grupo			= document.formularios.Grupo.value;
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/GuardaSemestreGrupoDocente.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("Semestre="+Semestre+"&id="+id+"&grupo="+grupo);
	
}
function Eliminar(id,docente){
	var mensaje = "¿ESTAS SEGURO QUE QUIERES ELIMINAR, UNA VEZ ELIMINADO NO PODRAS RECUPERARLO?";
	if(confirm(mensaje)){
		window.location="Configuracion/EliminarSemestreGrupoDocente.php?id="+id+"&docente="+docente;
	}else{
	
	}
	
}
</script>
<?php
	$id		= $_GET['id'];	

	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	
	Cabecera("Nuevo Grupo y Bimestre");
	$boton		= "salvar";
	$javascript = "";
	echo '<form name="formularios" id="formularios" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	echo '<center>';
	echo '<input type="hidden" name="id" value="'.$id.'"/>';
	echo '<table border=0>';
	echo '<tr><td colspan="2"><div id="resultado"></div></td></tr>';
	
	echo '<tr>';
	echo '	<td><strong>Bimestre:</strong></td>';
	echo '	<td>';
	echo '<select name="Semestre">';
	$sqlx = "SELECT * FROM semestre  order by DESCRIPCION";
	$rsx  = mysqli_query($conexion,$sqlx);
	if(mysqli_num_rows($rsx)!=0){
		while($rows = mysqli_fetch_assoc($rsx)){
			echo '<option value="'.$rows['ID'].'">'.$rows['DESCRIPCION'].'</option>';
		}
	}else{
		echo '<option value="">---SIN OPCIONES---</option>';
	}
	echo '</select>';
	echo '</td>';
	echo '</tr>';
	/*DIBUJAMOS GRUPOS*/
	
	echo "<tr>";
	echo "<td><strong>Grupo :</strong></td>";
	echo "<td>";
	echo '<select name="Grupo">';
	echo '<option value="">---ELIGE GRUPO---</option>';
	$sqlx = "SELECT * FROM grupos ".$filtro." order by DESCRIPCION";
	$rsx  = mysqli_query($conexion,$sqlx);
	if(mysqli_num_rows($rsx)!=0){
		while($rows = mysqli_fetch_assoc($rsx)){
			echo '<option value="'.$rows['ID'].'">'.$rows['DESCRIPCION'].'</option>';
		}
	}else{
		echo '<option value="">---SIN OPCIONES---</option>';
	}
	echo '</select>';
	echo "</td>";
	echo "</tr>";
		
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';
?>
<center>
<br/>
<div style="OVERFLOW:auto;WIDTH:800px;HEIGHT:400px">
<table id="table" border=0 cellpadding="0" cellspacing="0">
<thead>
<tr>
<th>ID</th>
<th>BIMESTRE</th>
<th>GRUPO</th>
<th></th>
<tr>
</thead>
<tbody id="tbody">
<?php
	
	$contador = 0;
	$sql      = "SELECT * FROM docente_bimestre where ID_DOCENTE='".$id."'  Order by ID";
	$rs       = mysqli_query($conexion,$sql);
	if(mysqli_num_rows($rs)!=0){
		while($rows = mysqli_fetch_assoc($rs)){
	   
		$contador	 = $contador + 1;
		$body		 = "odd";	
		
		if($contador%2){$body="even";}
		echo '<tr class="'.$body.'">';
		echo '<td>'.$contador.'</td>';
		echo '<td>'.DatosSemestre($rows['ID_BIMESTRE'],"DESCRIPCION",$conexion).'</td>';
		echo '<td>'.SplitGrupo($rows['ID_GRUPO'],$conexion,1).'</td>';	
		echo '<td>';
?>

		<img src="imagenes/actions-delete.png" style="cursor:pointer;" onclick="Eliminar('<?php echo $rows['ID']; ?>','<?php echo $_GET['id']; ?>')"/>

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