<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtGrupo		= strtoupper($_POST['txtGrupo']);
	$id				= trim($_POST['id']);
	$mensaje      	= "";
	if($txtGrupo==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Grupo</div>";
	}else{
		
		if($id!=0){
			$slx  = "UPDATE grupos SET DESCRIPCION='".$txtGrupo."' WHERE ID='".$id."'";
			mysqli_query($conexion,$slx);			
			$mensaje = '<br/><div class="information-box round">'."Informacion Actualizada Correctamente</div>".$refresh;
		}
		if($id==0){
			$sqlx = "SELECT DESCRIPCION FROM grupos WHERE DESCRIPCION LIKE '".$txtGrupo."'";
			$rsx  = mysqli_query($conexion,$sqlx);
			if(mysqli_num_rows($rsx)!=0){
				$row = mysqli_fetch_assoc($rsx);
				$mensaje = '<br/><div class="error-box round">'." Existe un Grupo Similar: ".$row['DESCRIPCION']."</div>";
			}else{
				
				$sqls 	= "INSERT INTO grupos(DESCRIPCION) VALUES ('".$txtGrupo."')";
				mysqli_query($conexion,$sqls);			
				$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>".$refresh;
			}
		}
	}
	echo $mensaje;
?>