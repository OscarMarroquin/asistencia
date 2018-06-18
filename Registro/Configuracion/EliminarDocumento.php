<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$id = $_GET["a"];
	$sql  = "DELETE FROM documentos WHERE ID='".$id."'";
	mysqli_query($conexion,$sql);
	header("Location:../Documentos.php");

?>