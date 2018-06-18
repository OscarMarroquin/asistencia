<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtMateria   = strtoupper($_POST['txtMateria']);
	$Semestre     = strtoupper($_POST['Semestre']);	
	$id			  = trim($_POST['id']);
	$group		  = substr($_POST['group'],1);
	$txtCodigo	 = trim($_POST['txtCodigo']);

	$mensaje      = "";
	if($txtCodigo==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Codigo</div>";
	}elseif($txtMateria==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Materia</div>";
	}elseif($Semestre==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Semestre</div>";
	}elseif($group==""){
		$mensaje = '<div class="error-box round">'."Debes de Seleccionas al Menos un Grupo</div>";
	}else{
		
		if($id!=0){
			$sqs = "UPDATE materias SET CODIGO='".$txtCodigo."',DESCRIPCION='".$txtMateria."', ID_SEMESTRE='".$Semestre."', GRUPO='".$group."' WHERE ID='".$id."'";
			mysql_query($sqs,$conexion);			
			$mensaje = '<br/><div class="information-box round">'."Informacion Actualizada Correctamente</div>".$refresh;
		}
		if($id==0){
			$sqlx = "SELECT * FROM materias WHERE DESCRIPCION LIKE '%".$txtMateria."%' AND ID_SEMESTRE='".$Semestre."'";
			$rsx  = mysql_query($sqlx,$conexion);
			if(mysql_num_rows($rsx)!=0){
				$rows    = mysql_fetch_assoc($rsx);
				$mensaje = '<br/><div class="error-box round">'."Existe una Materia Similar: ".$rows['DESCRIPCION']."</div>";
			}else{
				
				$sqls 	= "INSERT INTO materias(CODIGO,DESCRIPCION,ID_SEMESTRE,GRUPO) VALUES (";
				$sqls   = $sqls."'".$txtCodigo."','".$txtMateria."','".$Semestre."','".$group."')";
				mysql_query($sqls,$conexion);			
				$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>".$refresh;
			}
		}
	}
	echo $mensaje;
	
?>