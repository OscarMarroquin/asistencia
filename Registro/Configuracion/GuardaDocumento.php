<?php
	
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtDocumento	= strtoupper($_POST['txtDocumento']);
	$id			    = trim($_POST['id']);
	$mensaje        = "";
	if($txtDocumento==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Documentos</div>";
	}else{
		if($id!=0){
			$sqs = "UPDATE documentos SET DESCRIPCION='".$txtDocumento."' WHERE ID='".$id."'";
			mysqli_query($conexion,$sqs);			
			$mensaje = '<br/><div class="information-box round">'."Informacion Actualizada Correctamente</div>".$refresh;
		}
		if($id==0){
			$sqlx = "SELECT DESCRIPCION FROM documentos WHERE DESCRIPCION LIKE '".$txtDocumento."'";
			$rsx  = mysqli_query($conexion,$sqlx);
			if(mysqli_num_rows($rsx)!=0){
				$row = mysqli_fetch_assoc($rsx);
				$mensaje = '<br/><div class="error-box round">'." Existe un Documento Similar: ".$row['DESCRIPCION']."</div>";
			}else{
				
				$sqls 	= "INSERT INTO documentos(DESCRIPCION,ID_ESCUELA) VALUES ('".$txtDocumento."','".$idEscuela."')";
				mysqli_query($conexion,$sqls);			
				$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>".$refresh;
			}
		}
	}
	echo $mensaje;

?>