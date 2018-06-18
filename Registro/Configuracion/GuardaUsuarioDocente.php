<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	include('../DataExtra.php');
	$txtNombre 			  = strtoupper($_POST["txtNombre"]);
	$txtApaterno 		  = strtoupper($_POST["txtApaterno"]);
	$txtMaterno	    	  = strtoupper($_POST["txtMaterno"]);
	$txtEmail			  = strtoupper($_POST["txtEmail"]);
	$txtPassword		  = strtoupper($_POST["txtPassword"]);
	$txtPasswordConfirmar = strtoupper($_POST["txtPasswordConfirmar"]);
	$TipoUsuario          = strtoupper($_POST["TipoUsuario"]);
	$mensaje        	  = "";	
	
	if($txtNombre==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Nombre</div>";
	}elseif($txtApaterno==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Apellido Paterno</div>";
	}elseif($txtMaterno==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Apellido Materno</div>";
	}elseif($txtEmail==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Email</div>";
	}elseif($txtPassword==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Password</div>";
	}elseif($txtPasswordConfirmar==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Confirmar Password</div>";
	}elseif($txtPassword!=$txtPasswordConfirmar){
		$mensaje = '<div class="error-box round">'." Password no Coinciden</div>";
	}elseif(VerificarDireccionCorreo($txtEmail)==false){
		$mensaje    = "<div class='error-box round'>EL EMAIL ES INVALIDO</div>";
	}else{
		$bandera1 = 0;
		$bandera2 = 0;
		
		$sqlx = "SELECT EMAIL FROM usuarios WHERE EMAIL ='".$txtEmail."'";
		$rsx  = mysqli_query($conexion,$sqlx);
		if(mysqli_num_rows($rsx)!=0){
			$bandera2 = 1;
		}
		
		
		if($bandera2==1){			
			$mensaje = '<br/><div class="error-box round">'." El Correo Ya esta en Uso</div>";
		}else{
			
			$sqls 	= "INSERT INTO usuarios(NOMBRE, APATERNO, AMATERNO,  EMAIL, PASSWORD, TIPO_USUARIO, ESTATUS)";
			$sqls   = $sqls." VALUES ('".$txtNombre."','".$txtApaterno."','".$txtMaterno."','".$txtEmail."','".$txtPassword."','".$TipoUsuario."','0')";
			mysqli_query($conexion,$sqls);			
			$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>".$refresh;
		}
	}
	echo $mensaje;
?>