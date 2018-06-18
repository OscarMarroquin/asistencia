<script src="js/ajax.js" type="text/javascript"></script>
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/tablasmostrar.css">
<script LANGUAGE="JavaScript">
function ValidarRequeridos(){
	
	divResultado 		= document.getElementById('resultado');
	var sg		 		= document.formularios.sg.value;
	var Semestre 	    = document.formularios.Semestre.value;
	var id				= document.formularios.id.value;
	var Grupo			= document.formularios.Grupo.value;
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/UpdateSemestreActual.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id="+id+"&Semestre="+Semestre+"&Grupo="+Grupo+"&sg="+sg);
	
}
</script>
<?php
	include('DibujaVentana.php');
	include('Conexion_Abrir.php');
	include('ScreenCatalogo_Seguridad.php');
	include('DataExtra.php');
	Cabecera("cambiar BIMESTRE y grupo");
	$boton		= "salvar";
	$javascript = "";
	$id			= $_GET['id'];
	$sg			= $_GET['sg'];
	$grupo      = TraeSemestreGrupo($sg,"ID_GRUPO",$conexion);
	$semestre   = TraeSemestreGrupo($sg,"ID_SEMESTRE",$conexion);
	echo '<form name="formularios" id="formularios" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	echo '<center>';
	echo '<input type="hidden" name="id" value="'.$id.'"/>';
	echo '<input type="hidden" name="sg" value="'.$sg.'"/>';
	echo '<table border=0>';
	echo '<tr><td colspan="2"><div id="resultado"></div></td></tr>';
	echo '<tr><td colspan="2"><small><strong>Bimestre Actual: </strong>'.DatosSemestre($semestre,"DESCRIPCION",$conexion).' <strong>Grupo Actual: </strong>'.DatosGrupo($grupo,"DESCRIPCION",$conexion).'</small></td></tr>';	
	echo '<tr>';
	echo '	<td><strong>Bimestre:</strong></td>';
	echo '	<td>';
	echo '<select name="Semestre">';
	echo '<option value="'.$semestre.'">'.DatosSemestre($semestre,"DESCRIPCION",$conexion).'</option>';	
	$sqlx = "SELECT * FROM semestre where ID_ESCUELA='".$idEscuela."' order by DESCRIPCION";
	$rsx  = mysqli_query($conexion,$sqlx);
	if(mysqli_num_rows($rsx)!=0){
		while($rows = mysqli_fetch_assoc($rsx)){
			echo '<option value="'.$rows['ID'].'">'.$rows['DESCRIPCION'].'</option>';
		}
	}else{
		echo '<option value="">---SIN OPCIONES---</option>';
	}
	echo '</select>';
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Grupo:</strong></td>';
	echo '	<td>';
	echo '<select name="Grupo">';
	echo '<option value="'.$grupo.'">'.DatosGrupo($grupo,"DESCRIPCION",$conexion).'</option>';
	$sqlx = "SELECT * FROM grupos where ID_ESCUELA='".$idEscuela."' order by DESCRIPCION";
	$rsx  = mysqli_query($conexion,$sqlx);
	if(mysqli_num_rows($rsx)!=0){
		while($rows = mysqli_fetch_assoc($rsx)){
			echo '<option value="'.$rows['ID'].'">'.$rows['DESCRIPCION'].'</option>';
		}
	}else{
		echo '<option value="">---SIN OPCIONES---</option>';
	}
	echo '</select>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';

?>