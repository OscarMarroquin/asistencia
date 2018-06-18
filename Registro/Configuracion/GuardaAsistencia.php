<?php
	include('../DataExtra.php');
	include('../Conexion_Abrir.php');
	include('../ScreenCatalogo_Seguridad.php');
	include('DibujaVentana.php');
	
	$total		= $_POST['asistencia'];
	 foreach ($total as $valor){
		$datos  	 = explode("|",$valor);
		$semestre 	 = $datos[0];
		$grupo    	 = $datos[1];
		$alumno      = $datos[2];
		$lista		 = $datos[3];
		$materia	 = $datos[4];
		$fecha		 = hoy();
		$hora        = horaactual();
		/*VERIFICAMOS SI YA EXISTE EL ALUMNO LO ACTUALIZAMOS SOLAMENT D ESE DIA*/
		$slx = "SELECT ID FROM asistencia WHERE ID_BIMESTRE='".$semestre."' AND ID_GRUPO='".$grupo."' AND ID_ALUMNO='".$alumno."' AND FECHA='".$fecha."' AND ID_MATERIA='".$materia."' AND ID_DOCENTE='".$usuario."'";
		$rsx = mysqli_query($conexion,$slx);
		if(mysqli_num_rows($rsx)!=0){
			$row = mysqli_fetch_assoc($rsx);
			$id  = $row['ID'];
			$sql = "UPDATE asistencia SET HORA='".$hora."', DESCRIPCION='".$lista."' WHERE ID='".$id."'";
			mysqli_query($sql,$conexion);
		}else{
			/*Guardamos Lista*/
			$sql = "INSERT INTO asistencia (ID_BIMESTRE, ID_GRUPO, ID_ALUMNO, ID_MATERIA,ID_DOCENTE, FECHA, HORA, DESCRIPCION) VALUES ('".$semestre."','".$grupo."','".$alumno."','".$materia."','".$usuario."','".$fecha."','".$hora."','".$lista."')";
			mysqli_query($conexion,$sql);
		}
	}
	Cabecera("pase de lista");
	echo '<center><table><tr><td><div class="information-box round">Se ha Realizado el Pase de Lista del dia '.FormatDate(hoy()).'</div></td></tr></table></center>';
	Pie("Aceptar","aceptar()");
?>
<script>
function aceptar(){
	window.location='../Contenido.php';
}
</script>