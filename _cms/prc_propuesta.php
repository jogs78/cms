<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
$e="";
include ("toup.php");
$up = new toup();
$up->wwwroot = realpath("..") ;
$up->pimg = "pimagenes";
$up->pdoc = "pdocumentos";

include('sistema.inc.php');
$sys = new sistema();
$accion=2;
//if( !$sys->puede($_SESSION['user'] ,'PROPUESTA', $accion) ) exit;

$p01 = $_POST["p01"]; 
$nota = $_POST["nota"]; 
$id = $_POST["id"]; 

$inputs =explode(' ' , "img1 img2 img3 img4 img5 img6 img7 img8 img9 doc1 doc2 doc3 doc4 ima1 ima2 ima3 ima4");
foreach( $inputs as $file ) {
	if($_FILES[$file]['name']){
		if($accion==1) continue;
		if($up->proccess_file($file ,  $id , "contenido") ){ 
			$$file = $up->lastname;
			if($up->lastthumb != "") echo "Thumbnail creado '$up->lastname':  $up->lastthumb<br>";
			else echo "Se subio '$up->lastname'<br>";
		}else{
			echo "Error al subir '$up->lastname': " .  $_FILES[$file]['name']  . " e:'$up->error'  <br>"; $$file = "";
		}
	}else $$file="";
}

$sql="UPDATE propuesta SET modificado = 1 ";
if ($img1!="") $sql .= ", img1 = '$img1' ";
if ($img2!="") $sql .= ", img2 = '$img2' ";
if ($img3!="") $sql .= ", img3 = '$img3' ";
if ($img4!="") $sql .= ", img4 = '$img4' ";
if ($img5!="") $sql .= ", img5 = '$img5' ";
if ($img6!="") $sql .= ", img6 = '$img6' ";
if ($img7!="") $sql .= ", img7 = '$img7' ";
if ($img8!="") $sql .= ", img8 = '$img8' ";
if ($img9!="") $sql .= ", img9 = '$img9' ";
if ($doc1!="") $sql .= ", doc1 = '$doc1' ";
if ($doc2!="") $sql .= ", doc2 = '$doc2' ";
if ($doc3!="") $sql .= ", doc3 = '$doc3' ";
if ($doc4!="") $sql .= ", doc4 = '$doc4' ";
if ($ima1!="") $sql .= ", ima1 = '$ima1' ";
if ($ima2!="") $sql .= ", ima2 = '$ima2' ";
if ($ima3!="") $sql .= ", ima3 = '$ima3' ";
if ($ima4!="") $sql .= ", ima4 = '$ima4' ";
if ($nota!="") $sql .= ", nota = '$nota'  ";
if ($p01!="")  $sql .= ", p01  = '$p01'  ";
$sql.= " WHERE idc = $id;";
//echo "SQL: $sql <hr>";
//$sys->conn->debug=true;
$recordSet = $sys->conn->Execute($sql);
$sys->currentid = $id;
$sys->log($_SESSION['user'] ,'PROPUESTA', $accion, $sql, "");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PROCESO PROPUESTA DE UN CONTENIDO</title>
<link href="cms.css" rel="stylesheet" type="text/css">
</head>
<body>
<center> <h1>PROCESO PROPUESTA DE UN CONTENIDO</h1> </center>
<?php 
$t=0;
if($e){	echo "<hr>$e<hr>";
	$t=100000;
}else {
	$t=500;
}
?>
<BR>REALIZADO... SERA REDIRECCIONADO A LA LISTA DE CONTENIDOS PROPUESTOS EN SEGUNDOS.... SI NO DE CLICK <A HREF="pro_propuesta.php">AQUI </A>
<SCRIPT LANGUAGE="JavaScript">
<!--
//setTimeout( "document.location='pro_propuesta.php'", <?php echo $t ?> );	
//-->
</SCRIPT>
</body>
</html>