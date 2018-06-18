<?php
	$txtNombre 			  = strtoupper($_POST["txtNombre"]);
	$txtApaterno 		  = strtoupper($_POST["txtApaterno"]);
	$txtMaterno	    	  = strtoupper($_POST["txtMaterno"]);
	$txtCarnet			  = strtoupper($_POST["txtCarnet"]);
	$txtSeccion			  = strtoupper($_POST["txtSeccion"]);
	$Semestre	          = trim($_POST["Semestre"]);
	$Grupo			      = trim($_POST["Grupo"]);
	$mensaje        	  = "";	
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	include('../DataExtra.php');
	if($txtCarnet==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Carnet</div>";
	}elseif($txtNombre==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Nombre</div>";
	}elseif($txtApaterno==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Apellido Paterno</div>";
	}elseif($txtMaterno==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Apellido Materno</div>";
	}elseif($txtSeccion==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Seccion</div>";
	}elseif($Grupo==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Grupo</div>";
	}elseif($Semestre==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Semestre</div>";
	}else{
		$bandera1 = 0;
		$sls  = "SELECT ID FROM alumnos WHERE CARNET ='".$txtCarnet."'";
		$rss  = mysqli_query($conexion,$sls);
		if(mysqli_num_rows($rss)!=0){
			$bandera1 = 1;
		}
				
		//echo "Bandera 1 alumnos: ".$bandera1." ---- BANDERA 2 USUARIOS: ".$bandera2."<BR/>";
		if($bandera1==1){			
			$mensaje = '<br/><div class="error-box round">'." El Carnet Ya esta en Uso</div>";
		}
		if($bandera1==0){
			$Id_SG  = 0;
			$Id_Alum= 0;
			$sqlx   = "INSERT INTO alumno_semestre_grupo(ID_GRUPO,ID_SEMESTRE) VALUES ('".$Grupo."',";
			$sqlx   = $sqlx."'".$Semestre."')";
			mysqli_query($conexion,$sqlx);
			$Id_SG = mysqli_insert_id();
			
			$sqls 	= "INSERT INTO alumnos(CARNET, NOMBRE, APATERNO, AMATERNO,SECCION, ID_SG)";
			$sqls   = $sqls." VALUES ('".$txtCarnet."','".$txtNombre."','".$txtApaterno."','".$txtMaterno."','".$txtSeccion."','".$Id_SG."')";
			mysqli_query($conexion,$sqls);
			$Id_Alum = mysqli_insert_id();
			
			$updte   = "UPDATE alumno_semestre_grupo SET ID_ALUMNO='".$Id_Alum."' WHERE ID='".$Id_SG."'";
			mysqli_query($conexion,$updte);
			
			$mensaje = '<br/><div class="information-box round">'."Registros Guardados Correctamente</div>".$refresh;
			
			
		}
		
	}
	echo $mensaje;
?>