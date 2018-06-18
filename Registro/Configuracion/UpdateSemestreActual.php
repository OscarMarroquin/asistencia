<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	include('../DataExtra.php');
	$id			= $_POST['id'];
	$Semestre	= $_POST['Semestre'];
	$sg			= $_POST['sg'];
	$Grupo		= $_POST['Grupo'];
	
	if($id==""){
		$mensaje = '<div class="error-box round">'."Alumno no Seleccionado</div>";
	}elseif($Semestre==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Semestre </div>";
	}elseif($Grupo==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Grupo</div>";
	}else{
		/**/
		$sls  = "SELECT ID FROM alumno_semestre_grupo WHERE ID_GRUPO ='".$Grupo."' AND ID_SEMESTRE='".$Semestre."' AND ID_ALUMNO='".$id."'";
		$rss  = mysql_query($sls,$conexion);
		if(mysql_num_rows($rss)!=0){
			$mensaje = '<div class="error-box round">'."No Puedes Elegir el Mismo Grupo y Semestre</div>";
		}else{
			 /*Verificamos que no se regrese de semestre*/
		}
	}
	echo $mensaje;
?>