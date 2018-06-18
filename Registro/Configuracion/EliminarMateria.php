<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$id = $_GET["a"];
	$sql  = "DELETE FROM materias WHERE ID='".$id."'";
	mysqli_query($conexion,$sql);
	header("Location:../Materias.php");

?>