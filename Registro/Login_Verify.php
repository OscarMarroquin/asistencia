<?php
	include('DataExtra.php');
	include('Conexion_Abrir.php');
	session_start();
	$mensaje 	= "";
	$bd         = "";
	$txtEmail   = htmlentities($_POST['Usuario']);
	$password   = trim($_POST['Password']);
	if(VerificarDireccionCorreo($txtEmail))
	{
		/*VALIDAMOS EN DONDE EXISTE*/		
		
		$sqlx = "SELECT EMAIL FROM usuarios WHERE EMAIL ='".strtoupper($txtEmail)."'";
		$rsx  = mysqli_query($conexion,$sqlx);
		if(mysqli_num_rows($rsx)!=0){
			$bd		  = "usuarios";
		}
		if($bd==""){
			$mensaje    = "<br/><div class='error-box round'>EL EMAIL NO EXISTE</div>";
		}else{
			$sqlxx = "SELECT * FROM ".$bd." WHERE EMAIL ='".strtoupper($txtEmail)."' and PASSWORD='".strtoupper($password)."' LIMIT 1";
			$rsxx  = mysqli_query($conexion,$sqlxx);
			if(mysqli_num_rows($rsxx)!=0){
				$row = mysqli_fetch_assoc($rsxx);
				$_SESSION['USERCORE'] = $row['ID'];
				$_SESSION['TIPOUSER'] = $row['TIPO_USUARIO'];
				$mensaje      = '<META HTTP-EQUIV=Refresh CONTENT="0; URL=Contenido.php"/>';
			}else{
				$mensaje    = "<br/><div class='error-box round'>EL EMAIL/PASSWORD ES INVALIDO</div>";
			}
		}
	}else{
		$mensaje    = "<br/><div class='error-box round'>EL EMAIL ES INVALIDO</div>";
	}
  
	echo $mensaje;
?>