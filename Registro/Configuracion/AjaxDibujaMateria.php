<?php
	include('../ScreenCatalogo_Seguridad.php');
	include('../Conexion_Abrir.php');
	include('../DataExtra.php');
	$filtro   	= explode("|",$_GET["llaveabuscar"]);
    $bimestre 	= $filtro[1];
	$grupo    	= $filtro[0];
	$materias 	= "";
	$arrayMat 	= "";
	$habilitado = "";
	if($bimestre==0 OR $grupo==0){$habilitado = "disabled";}
	/*OBTENEMOS LOS GRUPOS*/
	$sxl 	  = "select * from materias where ID_SEMESTRE='".$bimestre."'";
	$rsx      = mysqli_query($conexion,$sxl);
	if(mysqli_num_rows($rsx)!=0){
		while($rows = mysqli_fetch_assoc($rsx)){
			$arrayMat = $arrayMat."|".$rows['ID']."-".$rows['GRUPO'];
		}
	}
	/*RECORREMOS ARRAY*/
	$cuantosHay = explode("|",$arrayMat);
	$cuantos    = count($cuantosHay);
	for($i=1;$i<=count($cuantosHay)-1;$i++){
		$separaMat = explode("-",$cuantosHay[$i]);
		$idMateria = $separaMat[0];
		$idGrupos  = $separaMat[1];
		$cuantosGr = explode(",",$idGrupos);
		for($j=0;$j<=count($cuantosGr)-1;$j++){
			if($grupo==$cuantosGr[$j]){
				$materias = $materias.$idMateria.",";
			}
		}
	}
	/*DIBUJAMOS COMBO*/
	echo '<select name="materia" '.$habilitado.'>';
	echo '<option value="0">---SELECCIONE OPCION---</option>';
	$sqlx = "select * from materias where ID IN (".$materias."0)";
	$rsx  = mysqli_query($conexion,$sqlx);
	if(mysqli_num_rows($rsx)!=0){
		while($rows = mysqli_fetch_assoc($rsx)){
			echo '<option value="'.$rows['ID'].'">'.$rows["DESCRIPCION"].'</option>';
		}
	}
?>  