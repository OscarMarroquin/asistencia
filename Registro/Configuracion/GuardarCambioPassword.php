<link href="../css/Estilo.css" rel="stylesheet" type="text/css"/>
<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtPass1    = strtoupper(trim($_POST['txtPass1']));
	$txtConfirma = strtoupper(trim($_POST['txtConfirma']));
	$txtId		 = $_POST['txtId'];
	$mensaje     = "";
	if($txtPass1==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Password</div>";
	}elseif($txtConfirma==""){
		$mensaje = '<br/><div class="error-box round">'."Campo Obligatorio: Confirmar Password</div>";
	}elseif($txtConfirma!=$txtPass1){
		$mensaje = '<br/><div class="error-box round">'."No Coincide el Password</div>";
	}else{
			
			$sql = "UPDATE usuarios SET PASSWORD='".$txtPass1."' WHERE ID='".$txtId."' ";
			mysqli_query($conexion,$sql);
			$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>";		
	}
	echo $mensaje;
	


?>