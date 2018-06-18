<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="js/ajax.js" type="text/javascript"></script>
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){
	
	divResultado 		= document.getElementById('resultado');	
	var grupo 		    = document.formularios.grupos.value;	
	var semestre 	    = document.formularios.semestre.value;
	var idmateria       = document.formularios.idmateria.value;
	ajax = newAjax();		
	
	ajax.open("POST", "ValidacionLista.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("grupo="+grupo+"&semestre="+semestre+"&idmateria="+idmateria);
	
}
</script>
<?php
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DibujaVentana.php');
	include('DataExtra.php');
	$id 	     = $_GET['id'];
	$semestre	 = $_GET['semestre'];
	$grupo		 = $_GET['grupo'];
	$materia	 = $_GET['materia'];
	$idmateria   = $_GET['idmateria'];
	
	Cabecera("PASAR ASISTENCIA ".$semestre." - ".$materia);
	$boton		= "Continuar";
	$javascript = "";
	
	echo '<form name="formularios" id="formularios" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	echo '<input type="hidden" name="semestre" value="'.$id.'"/>';
	echo '<input type="hidden" name="idmateria" value="'.$idmateria.'"/>';
	echo '<center>';
	echo '<table border=0>';
	echo '<tr><td colspan="2"><div id="resultado"></div></td></tr>';
	echo '<tr>';
	echo '	<td><strong>BIMESTRE:</strong></td>';
	echo '	<td><input type="text" name="txtBimestre" value="'.$semestre.'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>MATERIA:</strong></td>';
	echo '	<td><input type="text" name="txtMateria" value="'.$materia.'" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>GRUPO:</strong></td>';
	echo '	<td>';
	echo "<select name='grupos'>";
	echo "<option value=''>--- SELECCIONE OPCION --- </option>";
	$grups = explode(",",$grupo);
	for($i=0;$i<count($grups);$i++){
		echo "<option value='".$grups[$i]."'>".DatosGrupo($grups[$i],"DESCRIPCION",$conexion)."</option>";
	}
	echo "</select>";
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';
	
	
?>