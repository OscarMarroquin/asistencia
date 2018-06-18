<script src="js/ajax.js" type="text/javascript"></script>
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/tablasmostrar.css">
<link rel="stylesheet" type="text/css" href="calendario/tcal.css" />
<script type="text/javascript" src="calendario/tcal.js"></script>
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){	
	divResultado 			 = document.getElementById('resultado');
	var txtNombre 			 = document.formularios.txtNombre.value;
	var txtApaterno 		 = document.formularios.txtApaterno.value;
	var txtMaterno	    	 = document.formularios.txtMaterno.value;
	var Grupo			     = document.formularios.Grupo.value;
	var Semestre			 = document.formularios.Semestre.value;
	var txtCarnet			 = document.formularios.txtCarnet.value;
	var txtSeccion			 = 0;
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/GuardaAlumno.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtNombre="+txtNombre+"&txtApaterno="+txtApaterno+"&txtMaterno="+txtMaterno+"&Grupo="+Grupo+"&Semestre="+Semestre+"&txtSeccion="+txtSeccion+"&txtCarnet="+txtCarnet);
	
}
</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	Cabecera("Nuevo Alumno");
	$boton		= "Continuar";
	$javascript = "";
	echo '<form name="formularios" id="formularios" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	/*CAMPOS OCULTOS*/
	echo '<center>';
	echo '<table border=0>';
	echo '<tr><td colspan="2"><div id="resultado"></div></td></tr>';
	echo '<tr>';
	echo '	<td><strong>Carnet:</strong></td>';
	echo '	<td><input type="text" name="txtCarnet" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Nombre:</strong></td>';
	echo '	<td><input type="text" name="txtNombre" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Apellido P:</strong></td>';
	echo '	<td><input type="text" name="txtApaterno" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Apellido M:</strong></td>';
	echo '	<td><input type="text" name="txtMaterno" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	//echo '<tr>';
	//echo '	<td><strong>Seccion:</strong></td>';
	//echo '	<td><input type="text" name="txtSeccion" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	//echo '</tr>';
	// echo '<tr>';
	echo '	<td align="left"><strong>Semestre:</strong></td>';
	echo '	<td>';
	echo '<select name="Semestre">';
	$sqlx = "SELECT * FROM semestre order by DESCRIPCION";
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
	echo '	<tr><td align="left"><strong>Seccion:</strong></td>';
	echo '	<td>';
	echo '<select name="Grupo">';
	$sqlx = "SELECT * FROM grupos  order by DESCRIPCION";
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
   	
	
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';
?>
