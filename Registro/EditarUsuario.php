<script src="js/ajax.js" type="text/javascript"></script>
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/tablasmostrar.css">
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){
	
	divResultado 			 = document.getElementById('resultado');
	var txtNombre 			 = document.formularios.txtNombre.value;
	var txtApaterno 		 = document.formularios.txtApaterno.value;
	var txtMaterno	    	 = document.formularios.txtMaterno.value;
	var Sexo				 = document.formularios.Sexo.value;
	var txtTelefono			 = document.formularios.txtTelefono.value;
	var txtDireccion    	 = document.formularios.txtDireccion.value;
	var txtId                = document.formularios.txtId.value;
	
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/UpdateUsuario.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtNombre="+txtNombre+"&txtApaterno="+txtApaterno+"&txtMaterno="+txtMaterno+"&Sexo="+Sexo+"&txtTelefono="+txtTelefono+"&txtDireccion="+txtDireccion+"&txtId="+txtId);
	
}
</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	
	$boton		= "salvar";
	$a	= $_GET['a'];
	$sql = "SELECT * FROM usuarios where ID='".$a."'";
	$rs  = mysqli_query($conexion,$sql);
	if(mysqli_num_rows($rs)!=0){
		$row = mysqli_fetch_assoc($rs);
	$javascript = "";
	Cabecera("EDITAR [ ".$row['NOMBRE'].' '.$row['APATERNO'].' '.$row['AMATERNO']." ]");
	echo '<form name="formularios" id="formularios" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	echo '<center>';
	echo '<input type="hidden" name="txtId" value="'.$row['ID'].'"/>';
	echo '<table border=0>';
	echo '<tr><td colspan="2"><div id="resultado"></div></td></tr>';
	echo '<tr>';
	echo '	<td><strong>Nombre:</strong></td>';
	echo '	<td><input type="text" name="txtNombre" value="'.$row['NOMBRE'].'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Apellido P:</strong></td>';
	echo '	<td><input type="text" name="txtApaterno" value="'.$row['APATERNO'].'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Apellido M:</strong></td>';
	echo '	<td><input type="text" name="txtMaterno" value="'.$row['AMATERNO'].'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Sexo:</strong></td>';
	echo '	<td>';
	echo '<select name="Sexo">';
	echo '<option value="'.$row['SEXO'].'">'.$row['SEXO'].'</option>';
	echo '<option value="Masculino">Masculino</option>';
	echo '<option value="Femenino">Femenino</option>';
	echo '</select>';
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td align="left"><strong>Telefono:</strong></td>';
	echo '	<td><input type="text" name="txtTelefono" class="CajaTexto" value="'.$row['TELEFONO'].'" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Direccion:</strong></td>';
	echo '	<td><input type="text" name="txtDireccion" value="'.$row['DIRECCION'].'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr><td colspan="2"><hr/></td></tr>';
	
	
	echo '<tr>';
	echo '	<td align="left"><strong>Email:</strong></td>';
	echo '	<td><input type="text" name="txtEmail" class="CajaTexto" size="40" value="'.$row['EMAIL'].'" x-webkit-speech="true" disabled/></td>';
	echo '</tr>';
		
	echo '</table>';
	echo '</center>';
	}
	Pie($boton,$javascript);
	echo '</form>';
?>

	