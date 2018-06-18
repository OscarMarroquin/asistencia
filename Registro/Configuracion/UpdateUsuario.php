<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtNombre 			  = strtoupper($_POST["txtNombre"]);
	$txtApaterno 		  = strtoupper($_POST["txtApaterno"]);
	$txtMaterno	    	  = strtoupper($_POST["txtMaterno"]);
	$Sexo				  = strtoupper($_POST["Sexo"]);
	$txtTelefono		  = strtoupper($_POST["txtTelefono"]);
	$txtDireccion    	  = strtoupper($_POST["txtDireccion"]);
	$txtId     		      = strtoupper($_POST["txtId"]);
	$mensaje        	  = "";	
	
	if($txtNombre==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Nombre</div>";
	}elseif($txtApaterno==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Apellido Paterno</div>";
	}elseif($txtMaterno==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Apellido Materno</div>";
	}elseif($Sexo==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Sexo</div>";
	}elseif($txtTelefono==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Telefono</div>";
	}elseif($txtDireccion==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Direccion</div>";
	}elseif(is_numeric($txtTelefono)==false){
		$mensaje = '<div class="error-box round">'."Error: Numero de Telefono es Numerico</div>";
	}else{		
			
			$sqls 	= "UPDATE usuarios SET NOMBRE='".$txtNombre."', APATERNO='".$txtApaterno."', AMATERNO='".$txtMaterno."', SEXO='".$Sexo."', DIRECCION='".$txtDireccion."'";
			$sqls   = $sqls.", TELEFONO='".$txtTelefono."' WHERE ID='".$txtId."'";	
			mysqli_query($conexion,$sqls);			
			$mensaje = '<br/><div class="information-box round">'."Registros Actualizados Correctamente</div>".$refresh;
		
	}
	echo $mensaje;
?>