<?php
	$id	= $_GET['id'];
?>
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
	var id					 = document.formularios.id.value;
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/UpdateDocente.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtNombre="+txtNombre+"&txtApaterno="+txtApaterno+"&txtMaterno="+txtMaterno+"&txtEmail="+txtEmail+"&id="+id);
	
}
</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	Cabecera("EDITAR docente");
	$boton		= "salvar";
	$javascript = "";
	$sql        = "SELECT * FROM usuarios WHERE ID='".$id."'";
	$rs			= mysqli_query($conexion,$sql);
	if(mysqli_num_rows($rs)!=0){
		$row = mysqli_fetch_assoc($rs);	
	echo '<form name="formularios" id="formularios" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	/*CAMPOS OCULTOS*/
	echo '<input type="hidden" name="id" value="'.$id.'"/>';
	echo '<center>';
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
	echo '<tr><td colspan="2"><hr/></td></tr>';
	
	echo '<tr>';
	echo '	<td align="left"><strong>Email:</strong></td>';
	echo '	<td><input type="text" name="txtEmail" disabled value="'.$row['EMAIL'].'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	
	echo '</table>';
	echo '</center>';
	}
	Pie($boton,$javascript);
	echo '</form>';
?>
