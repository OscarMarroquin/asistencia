<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	include('../DataExtra.php');
	$filtro     = $_GET['llaveabuscar'];
	$habilitado = "";	
	if($filtro==0){$habilitado = "disabled";}
	
	echo '<select name="grupo" '.$habilitado.' onchange="BuscaMaterias(this.value)">';
	echo '<option value="0|0">---SELECCIONE OPCION---</option>';
	$sqlx = "SELECT ID_GRUPO FROM docente_bimestre WHERE ID_BIMESTRE='".$filtro."' AND ID_DOCENTE='".$usuario."' GROUP BY ID_GRUPO";
	$rsx  = mysqli_query($conexion,$sqlx);
	if(mysqli_num_rows($rsx)!=0){
		while($rows = mysqli_fetch_assoc($rsx)){
			echo '<option value="'.$rows['ID_GRUPO'].'|'.$filtro.'">'.DatosGrupo($rows['ID_GRUPO'],"DESCRIPCION",$conexion).'</option>';
		}
	}
	echo '</select>';

?>