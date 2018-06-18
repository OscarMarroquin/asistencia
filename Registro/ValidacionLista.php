<?php
	$grupo		= $_POST['grupo'];
	$semestre	= $_POST['semestre'];
	$idmateria  = $_POST['idmateria'];
	if($grupo==""){
		$mensaje = '<div class="error-box round">'."Campo Obligatorio: Grupo</div>";
	}else{
		//header("Location:ListarAlumnosAsistencia.php?grupo=".$grupo."&semestre=".$semestre);
		$mensaje = '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=ListarAlumnosAsistencia.php?grupo='.$grupo.'&semestre='.$semestre.'&idmateria='.$idmateria.'">';
	}
	echo $mensaje;
?>