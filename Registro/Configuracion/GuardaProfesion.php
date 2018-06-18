<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtProfesion	= strtoupper($_POST['txtProfesion']);
	$id			    = trim($_POST['id']);
	$mensaje        = "";
	if($txtProfesion==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Profesion</div>";
	}else{
		if($id!=0){
			$sqs = "UPDATE materias SET profesion='".$txtProfesion."' WHERE ID='".$id."'";
			mysql_query($sqs,$conexion);			
			$mensaje = '<br/><div class="information-box round">'."Informacion Actualizada Correctamente</div>".$refresh;
		}
		if($id==0){
			$sqlx = "SELECT DESCRIPCION FROM profesion WHERE DESCRIPCION LIKE '".$txtProfesion."'";
			$rsx  = mysql_query($sqlx,$conexion);
			if(mysql_num_rows($rsx)!=0){
				$row = mysql_fetch_assoc($rsx);
				$mensaje = '<br/><div class="error-box round">'." Existe una Profesion Similar: ".$row['DESCRIPCION']."</div>";
			}else{
				
				$sqls 	= "INSERT INTO profesion(DESCRIPCION,ID_ESCUELA) VALUES ('".$txtProfesion."','".$idEscuela."')";
				mysql_query($sqls,$conexion);			
				$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>".$refresh;
			}
		}
	}
	echo $mensaje;
?>