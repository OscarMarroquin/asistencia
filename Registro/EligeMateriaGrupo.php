<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="js/ajax.js" type="text/javascript"></script>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/ValidacionesEspeciales.js" type="text/javascript"></script>
<script>

</script>
<?php
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DibujaVentana.php');
	include('DataExtra.php');
	
	
	Cabecera("ELEGIR GRUPO Y BIMESTRE");
	$boton		= "Continuar";
	$javascript = "";
	
	echo '<form name="formularios" id="formularios" method="post" action="ConsultarAsistencia.php">';
	echo '<center>';
	echo '<table border=0>';
	echo '<tr><td colspan="2"><div id="resultado"></div></td></tr>';
	echo '<tr>';
	echo '	<td><strong>BIMESTRE:</strong></td>';
	echo '<td>';
	echo '<select name="bimestre" onchange="BuscaGrupo(this.value)">';
	echo '<option value="0">---SELECCIONE OPCION---</option>';
	$sqlx = "SELECT ID_BIMESTRE FROM docente_bimestre WHERE ID_DOCENTE='".$usuario."' GROUP BY ID_BIMESTRE";
	$rsx  = mysqli_query($conexion,$sqlx);
	if(mysqli_num_rows($rsx)!=0){
		while($rows = mysqli_fetch_assoc($rsx)){
			echo '<option value="'.$rows['ID_BIMESTRE'].'">'.DatosSemestre($rows['ID_BIMESTRE'],"DESCRIPCION",$conexion).'</option>';
		}	
	}
	echo '</select>';
	echo '</td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '	<td><strong>GRUPO:</strong></td>';
	echo '	<td>';
	echo '<div id="AjaxDibujaGrupo">';
	echo "<select name='grupos' enabled>";	
	echo "<option value=''>--- SELECCIONE OPCION --- </option>";	
	echo "</select>";
	echo '</div>';
	echo '</td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '	<td><strong>MATERIA:</strong></td>';
	echo '<td><div id="AjaxDibujaMaterias">';
	echo "<select name='materias' enabled>";	
	echo "<option value=''>--- SELECCIONE OPCION --- </option>";	
	echo "</select>";
	echo '</div></td>';
	echo '</tr>';
	
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';
	
	
?>