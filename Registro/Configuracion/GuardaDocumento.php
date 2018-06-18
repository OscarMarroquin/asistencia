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
			mysql_query($sqs,$conexion);			
			$mensaje = '<br/><div class="information-box round">'."Informacion Actualizada Correctamente</div>".$refresh;
		}
		if($id==0){
			$sqlx = "SELECT DESCRIPCION FROM documentos WHERE DESCRIPCION LIKE '".$txtDocumento."'";
			$rsx  = mysql_query($sqlx,$conexion);
			if(mysql_num_rows($rsx)!=0){
				$row = mysql_fetch_assoc($rsx);
				$mensaje = '<br/><div class="error-box round">'." Existe un Documento Similar: ".$row['DESCRIPCION']."</div>";
			}else{
				
				$sqls 	= "INSERT INTO documentos(DESCRIPCION,ID_ESCUELA) VALUES ('".$txtDocumento."','".$idEscuela."')";
				mysql_query($sqls,$conexion);			
				$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>".$refresh;
			}
		}
	}
	echo $mensaje;

?>