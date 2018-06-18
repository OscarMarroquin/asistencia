<?php
	$id					  = $_POST['id'];
	$txtNombre 			  = strtoupper($_POST["txtNombre"]);
	$txtApaterno 		  = strtoupper($_POST["txtApaterno"]);
	$txtMaterno	    	  = strtoupper($_POST["txtMaterno"]);
	$txtCarnet			  = strtoupper($_POST["txtCarnet"]);
	$txtSeccion			  = strtoupper($_POST["txtSeccion"]);
	
	$mensaje        	  = "";	
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	include('../DataExtra.php');
	if($txtCarnet==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Carnet</div>";
	}elseif($txtNombre==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Nombre</div>";
	}elseif($txtApaterno==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Apellido Paterno</div>";
	}elseif($txtMaterno==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Apellido Materno</div>";
	}elseif($txtSeccion==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Seccion</div>";
	}else{
		
			$sqls 	= "UPDATE alumnos SET NOMBRE='".$txtNombre."', APATERNO='".$txtApaterno."', AMATERNO = '".$txtMaterno."', SECCION='".$txtSeccion."',CARNET='".$txtCarnet."' WHERE ID='".$id."'";
			mysql_query($sqls,$conexion);
			$mensaje = '<br/><div class="information-box round">'."Informacion Actualizada Correctamente</div>";
			
		
	}
	echo $mensaje;
?>