<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
include('sistema.inc.php');
$sys = new sistema();
$accion = 2;
//echo "<br>|  | idg:$id | img:$igm           | titulo:$titulo   | tipo:$tipo | id:$ida | fecha:$fecha |accion:$accion|||";
$sys->currentid = $id;
//$sys->conn->debug=true;
$sys->log( $_SESSION['id'] , USUARIO ,14);
switch ($accion){
	case 1: $cap="AGREGAR";  break;
	case 2: $cap="MODIFICAR ";  break;
	case 3: $cap= "ELIMINAR ";  break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>FORMULARIO USUARIOS</title>
<link href="cms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function validar(form){

if (form.pass1.value != form.pass2.value){ 
	alert ('LAS CONTRASEÑAS NO COINCIDEN'); 
	return false;
}

return true;
}
-->
</script> 
</head>
<body>
<?php 
echo "<center> <h1> $_SESSION[id] - $_SESSION[nombre] </h1> </center>";
 ?>
<form name="frmusuario" method="post" action="prc_password.php" onsubmit="return  validar(this);" > <!-- -->
  <input type="hidden" name="act" value="<?php echo $accion ?>">
  <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
  <p>&nbsp;</p>
  <p>Contrase&ntilde;a: 
    <input name="pass1" type="password" $dis maxlength="20">
  </p>
  <p>&nbsp;</p>
  <p>Repetir contrase&ntilde;a: 
    <input name="pass2" type="password" $dis maxlength="20" >
  </p>
  <input type="submit" value="<?php echo $cap ?>">
</p>
</form>
</body>
</html>
