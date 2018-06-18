<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtNombre 			  = strtoupper($_POST["txtNombre"]);
	$txtApaterno 		  = strtoupper($_POST["txtApaterno"]);
	$txtMaterno	    	  = strtoupper($_POST["txtMaterno"]);
	$id			 		  = $_POST["id"];
	
	
	$mensaje        	  = "";	
	
	if($txtNombre==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Nombre</div>";
	}elseif($txtApaterno==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Apellido Paterno</div>";
	}elseif($txtMaterno==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Apellido Materno</div>";
	}else{
				
			$sqls 	= "UPDATE usuarios SET NOMBRE='".$txtNombre."', APATERNO='".$txtApaterno."', AMATERNO='".$txtMaterno."' WHERE ID='".$id."'";
			mysql_query($sqls,$conexion);			
			$mensaje = '<br/><div class="information-box round">'."Informacion Actualizada Correctamente</div>".$refresh;
		
	}
	echo $mensaje;
?>