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
			mysqli_query($conexion,$sqs);			
			$mensaje = '<br/><div class="information-box round">'."Informacion Actualizada Correctamente</div>".$refresh;
		}
		if($id==0){
			$sqlx = "SELECT DESCRIPCION FROM profesion WHERE DESCRIPCION LIKE '".$txtProfesion."'";
			$rsx  = mysqli_query($conexion,$sqlx);
			if(mysqli_num_rows($rsx)!=0){
				$row = mysqli_fetch_assoc($rsx);
				$mensaje = '<br/><div class="error-box round">'." Existe una Profesion Similar: ".$row['DESCRIPCION']."</div>";
			}else{
				
				$sqls 	= "INSERT INTO profesion(DESCRIPCION,ID_ESCUELA) VALUES ('".$txtProfesion."','".$idEscuela."')";
				mysqli_query($conexion,$sqls);			
				$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>".$refresh;
			}
		}
	}
	echo $mensaje;
?>