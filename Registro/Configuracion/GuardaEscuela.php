<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	$txtEscuela   = strtoupper(trim($_POST['txtEscuela']));
	$txtDireccion = strtoupper(trim($_POST['txtDireccion']));
	$txtRFC		  = strtoupper(trim($_POST['txtRFC']));
	$txtTelefono  = trim($_POST['txtTelefono']);	
	$txtDirector  = strtoupper(trim($_POST['txtDirector']));
	$turno		  = $_POST['turno'];
	$idprepa	  = $_POST['idprepa'];
	$control	  = $_POST['control'];
	$mensaje      = "";
	if($txtEscuela==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Nombre de la Escuela</div>";
	}elseif($txtDirector==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Director</div>";
	}elseif($txtDireccion==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Direccion</div>";
	}elseif($txtRFC==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Clave</div>";
	}elseif($txtDireccion==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Direccion</div>";
	}elseif($txtTelefono==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Telefono</div>";
	}elseif(is_numeric($txtTelefono)==false){
		$mensaje = '<div class="error-box round">'."Campo Telefono Debe Ser Numerico</div>";
	}else{
		if($idprepa!=0 AND $control!=0){
			$sqls 	= "UPDATE escuelas SET NOMBRE='".$txtEscuela."',DIRECTOR='".$txtDirector."',RFC='".$txtRFC."',DIRECCION='".$txtDireccion."',TELEFONO='".$txtTelefono."',TURNO='".$turno."' WHERE ID='".$idprepa."'";
			mysql_query($sqls,$conexion);			
			$mensaje = '<br/><div class="information-box round">'."Registros Actualizados Correctamente</div>".$refresh;
		}
		if($idprepa==0 AND $control==0){
			$sqlx = "SELECT ID FROM escuelas WHERE RFC='".$txtRFC."'";
			$rsx  = mysql_query($sqlx,$conexion);
			if(mysql_num_rows($rsx)!=0){
				$mensaje = '<br/><div class="error-box round">'."Error: RFC En uso</div>";
			}else{				
				$sqls 	= "INSERT INTO escuelas(NOMBRE,DIRECTOR,RFC,DIRECCION,TELEFONO,TURNO) VALUES ('".$txtEscuela."','".$txtDirector."','".$txtRFC."','".$txtDireccion."','".$txtTelefono."','".$turno."')";
				mysql_query($sqls,$conexion);			
				$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>".$refresh;
			}
			
			
		}
	}
	echo $mensaje;
	
?>