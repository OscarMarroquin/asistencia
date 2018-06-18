<?php
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta content="IE=edge,requiresActiveX=true" http-equiv="X-UA-Compatible" />
<link rel="shortcut icon" href="imagenes/logo.ico" />
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>	
<script src="js/ajax.js" type="text/javascript"></script>
<title>LOGIN</title>
<script LANGUAGE="JavaScript">
	function login(){
		login.submit();
	}

function ValidarRequeridos(){
	
	divResultado 		= document.getElementById('resultado');
	var Usuario 		= document.login.Usuario.value;
	var Password 	    = document.login.Password.value;
	ajax = newAjax();	
	
	ajax.open("POST", "Login_Verify.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("Usuario="+Usuario+"&Password="+Password);
	
}
</script>
</head>
<body style="background-image: url(imagenes/Fondo.jpg);">
<center>
<!-- tabla login --->
<form name="login" id="login" method="post" action="Login_Verify.php" onsubmit="ValidarRequeridos(); return false">
<table width='350' border='0' class='ventanas' cellspacing='0' cellpadding='0'>
<tr>
	<td colspan='3' class='tabla_ventanas' height='10' colspan='3' align='center'>::: LOGIN ::: </td>
</tr>
<tr><td colspan=3><br/></td></tr>
<tr>
<td colspan='3'>
	<div id="resultado"></div>
	<center>
	<table>
	<tr>
		<td><strong>Usuario:</strong></td>
		<td><input type="text" name="Usuario" class="CajaTexto" value="juan@hotmail.com" enabled size="30" x-webkit-speech="true"/></td>
	</tr>
	<tr>
		<td><strong>Password:</strong></td>
		<td><input type="password" name="Password" class="CajaTexto" value="123" enabled size="30" x-webkit-speech="true"/></td>
	</tr>
	</table>
	</center>
</td>
</tr>
<tr>
<td colspan=3 align='center'><img src='imagenes/HRline200.png' width='250'></td>
</tr>
<tr>
<td height='50' colspan=3 align='center'><button class="clean-gray"> LOGIN </button></td>
</tr>
</table>
</form>
</center>
</body>
</html>