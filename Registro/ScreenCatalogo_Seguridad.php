<?php
error_reporting(0);
session_start();
$usuario     = 0;
$usuario     = $_SESSION['USERCORE'];
$tipoUser    = $_SESSION['TIPOUSER'];
//echo "Login: ".strlen($usuario)."<br/>";
if (strlen($usuario)==0){
    //echo "entro a header";
?>
<script>
window.location="Login.php";
</script>
<?php
        //header('Location:Login.php');
}	
		
	$refresh = "<meta http-equiv='refresh' content='5'";
	$idEscuela = 0;
	$idUsuario = 0;
	
		
?>