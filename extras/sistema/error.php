<?php
include_once('sistema/funciones.php');
$file = __FILE__;
$pth = path_to( $file );

if(!isset($obj)){
/*	include_once('clase.php');
	$obj = new clase();*/
	echo "error en error.php";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>ERROR</title>
</head>
<body>
<?php 
echo $_head;
if ($obj->error!="") echo $obj->error;
else echo $error;
?>
<BR>SERA REDIRECCIONADO EN SEGUNDOS.... SI NO DE CLICK <A HREF="index.php">AQUI </A>
<SCRIPT LANGUAGE="JavaScript">
<!--
//setTimeout( "document.location='index.php'", 3000);	
//-->
</SCRIPT>
</div>
</body>
</html>
