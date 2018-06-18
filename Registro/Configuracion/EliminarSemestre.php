<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$id = $_GET["a"];
	$sql  = "DELETE FROM semestre WHERE ID='".$id."'";
	mysqli_query($conexion,$sql);
	header("Location:../Semestre.php");

?>