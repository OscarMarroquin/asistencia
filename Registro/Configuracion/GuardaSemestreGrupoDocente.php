<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$Semestre     = $_POST['Semestre'];	
	$id			  = $_POST['id'];
	$grupo		  = $_POST['grupo'];
	$mensaje      = "";
	if($Semestre==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Semestre</div>";
	}elseif($grupo==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Grupo</div>";
	}else{
		$sls  = "SELECT ID FROM docente_bimestre WHERE ID_GRUPO ='".$grupo."' AND ID_BIMESTRE='".$Semestre."' AND ID_DOCENTE='".$id."'";
		$rss  = mysqli_query($conexion,$sls);
		if(mysqli_num_rows($rss)!=0){
			$mensaje = '<div class="error-box round">'."El Grupo y Semestre Ya existe</div>";
		}else{
			 /*Verificamos que no se regrese de semestre*/
			 $sql = "INSERT INTO docente_bimestre(ID_GRUPO, ID_BIMESTRE, ID_DOCENTE) VALUES ('".$grupo."','".$Semestre."','".$id."')";
			 mysqli_query($conexion,$sql);
			 $mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>";
		}
	}
	echo $mensaje;
?>