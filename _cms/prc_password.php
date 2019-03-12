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
$accion=14;
$id = $_POST["id"];
$pass = $_POST["pass1"];
$e="";
//$sys->conn->debug=true;
if( !$sys->puede($_SESSION['id'] ,USUARIO, $accion) ) exit; 

if ($accion==14)  {  //echo "accion==$accion";
	$sql="UPDATE usuarios SET pass = '$pass' WHERE id = $id;";
}
if ($sys->conn->Execute($sql) === false) {
	$e .= 'Error al CAMBIAR PASSWORD  Usuario: '.$sys->conn->ErrorMsg().'<BR>';
}
$sys->currentid = $id;
$sys->log($_SESSION['user'] ,'USUARIOS', $accion, $sql, "");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>PROCESO  ENTRADA</title>
<link href="cms.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
echo "<center> <h1>PROCESO MOFICIAR CONTRASEÑA</h1> </center>";
$t=0;
 if($e){	echo "<hr>$e<hr>";
 $t=10000;
 }else {
 $t=500;
 }
?>
<BR>REALIZADO... SERA REDIRECCIONADO A LA LISTA DE ENTRADAS EN SEGUNDOS.... SI NO DE CLICK <A HREF="contenido.php">AQUI </A>
<SCRIPT LANGUAGE="JavaScript">
setTimeout( "document.location='lst_usuario.php'", <?php echo $t ?> );	
</SCRIPT>
</body>
</html>
