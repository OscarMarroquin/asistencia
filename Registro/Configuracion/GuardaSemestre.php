<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtSemestre	= strtoupper($_POST['txtSemestre']);
	$id				= trim($_POST['id']);
	$mensaje      	= "";
	if($txtSemestre==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Bimestre</div>";
	}else{
		if($id!=0){
			$sql = "UPDATE semestre SET DESCRIPCION='".$txtSemestre."' WHERE ID='".$id."'";
			mysqli_query($conexion,$sql);			
			$mensaje = '<br/><div class="information-box round">'."Informacion Actualizada Correctamente</div>".$refresh;
		}
		if($id==0){		
			$sqlx = "SELECT DESCRIPCION FROM semestre WHERE DESCRIPCION LIKE '".$txtSemestre."'";
			$rsx  = mysqli_query($conexion,$sqlx);
			if(mysqli_num_rows($rsx)!=0){
				$row = mysqli_fetch_assoc($rsx);
				$mensaje = '<br/><div class="error-box round">'." Existe un Bimestre Similar: ".$row['DESCRIPCION']."</div>";
			}else{
				
				$sqls 	= "INSERT INTO semestre(DESCRIPCION) VALUES ('".$txtSemestre."')";
				mysqli_query($conexion,$sqls);			
				$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>".$refresh;
			}
		}
	}
	echo $mensaje;
?>