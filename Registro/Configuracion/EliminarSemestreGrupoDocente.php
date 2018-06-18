<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$id 	 = $_GET["id"];
	$docente = $_GET["docente"];
	$sql  = "DELETE FROM docente_bimestre WHERE ID='".$id."'";
	mysqli_query($conexion,$sql);
	header("Location:../SemestreGrupoDocente.php?id=".$docente);

?>