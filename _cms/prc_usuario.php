<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
$debug = false;

include('sistema.inc.php');
$sys = new sistema();
//$sys->conn->debug=true;
$accion=$_POST["act"];
$id = $_POST["id"];
$nombre = $_POST["nombre"];
if(isset($_POST["login"])) $login = $_POST["login"];
else $login ="";
$pass = $_POST["pass1"];
$email = $_POST["email"];
$depto = $_POST["depto"];
$e="";
if( !$sys->puede($_SESSION['id'] ,USUARIO, $accion) ) exit; 

if ($accion==3){
	$sql = "DELETE FROM usuarios WHERE id = $id;";
}
if ($accion==2)  {  //echo "accion==$accion";
	$sql="UPDATE usuarios SET nombre = '$nombre', ";
	if ($pass!="") $sql .= "pass = '$pass', ";
	if ($depto!="") $sql .= "depto = $depto, ";
	$sql.= " email = '$email' WHERE id = $id;";
}
if ($accion==1) {
	$sql1="INSERT INTO usuarios (nombre,usuario,pass,email,depto) ";
	$sql2=" VALUES ( '$nombre' , '$login' , md5('$pass'), '$email',$depto);";
	$sql = $sql1 . $sql2 ;
}
if ($sys->conn->Execute($sql) === false) {
	$e .= 'Error al insertar Usuario: '.$sys->conn->ErrorMsg().'<BR>';
}

$sys->currentid = $id;
$sys->log($_SESSION['user'] ,'ENTRADA', $accion, $sql, "");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PROCESO  ENTRADA</title>
<link href="cms.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
echo "<center> <h1>PROCESO AGREGAR USUARIO</h1> </center>";
$t=0;
 if($e){	echo "<hr>$e<hr>";
 $t=10000;
 }else {
 $t=500;
 }
?>
REALIZADO 
<SCRIPT LANGUAGE="JavaScript">
<!--
//setTimeout( "document.location='lst_usuario.php'", <?php echo $t ?> );	
//-->
</SCRIPT>
</body>
</html>
