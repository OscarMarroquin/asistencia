<script src="js/ajax.js" type="text/javascript"></script>
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/tablasmostrar.css">
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){	
	divResultado 			 = document.getElementById('resultado');
	var txtNombre 			 = document.formularios.txtNombre.value;
	var txtApaterno 		 = document.formularios.txtApaterno.value;
	var txtMaterno	    	 = document.formularios.txtMaterno.value;
	var txtEmail			 = document.formularios.txtEmail.value;
	var txtPassword			 = document.formularios.txtPassword.value;
	var txtPasswordConfirmar = document.formularios.txtPasswordConfirmar.value;
	var TipoUsuario          = document.formularios.TipoUsuario.value;
	
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/GuardaUsuarioDocente.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtNombre="+txtNombre+"&txtApaterno="+txtApaterno+"&txtMaterno="+txtMaterno+"&txtEmail="+txtEmail+"&txtPassword="+txtPassword+"&txtPasswordConfirmar="+txtPasswordConfirmar+"&TipoUsuario="+TipoUsuario);
	
}
</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	Cabecera("Nuevo Docente");
	$boton		= "salvar";
	$javascript = "";
	echo '<form name="formularios" id="formularios" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	/*CAMPOS OCULTOS*/
	echo '<input type="hidden" name="TipoUsuario" value="2"/>';
	echo '<center>';
	echo '<table border=0>';
	echo '<tr><td colspan="2"><div id="resultado"></div></td></tr>';
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
	echo '<tr><td colspan="2"><hr/></td></tr>';	
	echo '<tr>';
	echo '	<td align="left"><strong>Email:</strong></td>';
	echo '	<td><input type="text" name="txtEmail" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '	<td align="left"><strong>Password:</strong></td>';
	echo '	<td><input type="password" name="txtPassword" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td align="left"><strong>Confirmar:</strong></td>';
	echo '	<td><input type="password" name="txtPasswordConfirmar" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';
?>
