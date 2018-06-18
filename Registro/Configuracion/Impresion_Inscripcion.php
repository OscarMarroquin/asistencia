<?php
	include('../Conexion_Abrir.php');
	$txtCurp	= $_GET['curp'];
?>
<script type="text/javascript">
function login(){
	window.location="./";
}
</script>
<style type="text/css">
.boton1{

	BORDER-RIGHT: #666666 1px solid;
 	BORDER-TOP: #666666 1px solid;
 	BORDER-LEFT: #666666 1px solid;
 	BORDER-BOTTOM: #666666 1px solid;
 	background-image:url(../ima/boot.gif);
}
</style>
<link rel="shortcut icon" href="images/logo.ico" />
<title>IMPRESION DE INSCRIPCIONES</title>
<link rel="stylesheet" type="text/css" href="css/reportes.css">
<center>

	<table cellspacing="1" cellpadding="1" width="80%">
	<tr>
	<td></td>
	<td></td>
	<td></td>
	</tr>
	
	<tr>
	<td colspan=3><center><input type="button" class="boton1" value="IMPRIMIR" onclick="print()"/> <input class="boton1" type="button"  value="LOGIN" onclick="login()"/></center></td>
	</tr>
	</table>

