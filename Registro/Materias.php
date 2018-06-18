<script src="js/ajax.js" type="text/javascript"></script>
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/tablasmostrar.css">
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){
	
	divResultado 		= document.getElementById('resultado');
	var txtMateria 		= document.formularios.txtMateria.value;
	var Semestre 	    = document.formularios.Semestre.value;
	var id				= document.formularios.id.value;
	var group			= document.formularios.group.value;
	var txtCodigo	    = document.formularios.txtCodigo.value;
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/GuardaMateria.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtMateria="+txtMateria+"&Semestre="+Semestre+"&id="+id+"&group="+group+"&txtCodigo="+txtCodigo);
	
}
function Editar(materia,id,semestre,valorescombo,cuantos,comboRecorrer,txtCodigo){
	document.formularios.txtMateria.value=materia;
	document.formularios.Semestre.value=semestre;
	document.formularios.id.value=id;
	document.formularios.group.value=valorescombo;
	document.formularios.txtCodigo.value=txtCodigo;
	var valores = comboRecorrer.split(',');

	var contador = 0;
	var variable = "";
	for(i=0;i<cuantos;i++){
		contador = contador + 1;
		//document.write("Grupo" + contador + "<br>" ); 
		variable = "Grupo" + contador;
		//alert(variable);
		//document.formularios.variable.value=valores[i];
		
	}
}
function Eliminar(id){
	var mensaje = "¿ESTAS SEGURO QUE QUIERES ELIMINAR, UNA VEZ ELIMINADO NO PODRAS RECUPERARLO?";
	if(confirm(mensaje)){
		window.location="Configuracion/EliminarMateria.php?a="+id;
	}else{
	
	}
}
function AsignaGrupo(nuevo){
	
	var grupo = document.formularios.group.value;	
	grupo = grupo + ',' + nuevo ;
	document.formularios.group.value = grupo;
	
}
</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	
	Cabecera("Nuevo Materia");
	$boton		= "salvar";
	$javascript = "";
	echo '<form name="formularios" id="formularios" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	echo '<center>';
	echo '<input type="hidden" name="id" value="0"/>';
	echo '<table border=0>';
	echo '<tr><td colspan="2"><div id="resultado"></div></td></tr>';
	echo '<tr>';
	echo '	<td><strong>Codigo:</strong></td>';
	echo '	<td><input type="text" name="txtCodigo" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Materia:</strong></td>';
	echo '	<td><input type="text" name="txtMateria" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	
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
	$cuantos = 0;
	$sqlt = "SELECT * FROM grupos  ORDER BY DESCRIPCION";
	$rst  = mysqli_query($conexion,$sqlt);
	if(mysqli_num_rows($rst)!=0){
		while($rowt = mysqli_fetch_assoc($rst)){
			$cuantos = $cuantos + 1;
			echo "<tr>";
			echo "<td><strong>Grupo ".$cuantos.":</strong></td>";
			echo "<td>";
			echo '<select name="Grupo'.$cuantos.'" onchange="AsignaGrupo(this.value)">';
			echo '<option value="0">---ELIGE GRUPO---</option>';
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
		}		
	}
	echo "<tr><td colspan='2'><input type='hidden' name='group' value=''/></td></tr>";
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
<th>CODIGO</th>
<th>MATERIA</th>
<th>SEMESTRE</th>
<th>GRUPO</th>
<th>ESTATUS</th>
<th></th>
<tr>
</thead>
<tbody id="tbody">
<?php
	
	$contador = 0;
	$sql      = "SELECT * FROM materias  Order by DESCRIPCION";
	$rs       = mysqli_query($conexion,$sql);
	if(mysqli_num_rows($rs)!=0){
		while($rows = mysqli_fetch_assoc($rs)){
	   
		$contador	 = $contador + 1;
		$body		 = "odd";	
		$cuantoscombo= SplitGrupo($rows['GRUPO'],$conexion,2);
		if($contador%2){$body="even";}
		echo '<tr class="'.$body.'">';
		echo '<td>'.$contador.'</td>';
		echo '<td>'.$rows['CODIGO'].'</td>';
		echo '<td>'.$rows['DESCRIPCION'].'</td>';
		echo '<td>'.DatosSemestre($rows['ID_SEMESTRE'],"DESCRIPCION",$conexion).'</td>';
		echo '<td>'.SplitGrupo($rows['GRUPO'],$conexion,1).'</td>';			
		echo '<td>'.Estatus($rows['ESTATUS']).'</td>';
		echo '<td>';
?>
	<img src="imagenes/actions-edit.png" style="cursor:pointer;" onclick="Editar('<?php echo $rows['DESCRIPCION']; ?>','<?php echo $rows['ID']; ?>','<?php echo $rows['ID_SEMESTRE']; ?>','<?php echo ",".$rows['GRUPO']; ?>','<?php echo $cuantoscombo; ?>','<?php echo $rows['GRUPO']; ?>','<?php echo $rows['CODIGO']; ?>')"/>
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