<?php
/**
 * @name Procesar Anuncio
 * 
 * @abstract Esta página es utilizada para procesar
 * los datos enviados desde el formulario de anuncio.
 * 
 * @param array $_POST En este arreglo se transmite
 * la información que debe ser procesada.
 * @param int $_POST['ide'] || null Indica el IDE del aununcio que se modifica y/o
 * elimina de la base de datos
 * @param int $_POST['act'] Indica la acción que ha de realazarse
 * 1.- Agregar 2.- Modificar 3.- Eliminar
 * 
 * @uses prc_anuncio.php Esta se usa cuando se agrega un aununcio nuevo
 * @uses prc_anuncio.php?ide=10&act=2 Esta se usa cuando ha de modificarse una aununcio
 * 
 */
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
/**
 * Llamada a la clases 'sistema.inc.php'
 * y a continuación se crea un objeto de esta
 */
include('sistema.inc.php');
$sys = new sistema();
$accion=$_POST["act"];
$publico = $_SESSION['id'];
if( !$sys->puede($_SESSION['id'] , AVISO, $accion) ) exit;
$fecha = $_POST["fecha"];
$id = $_POST["ide"];
$titulo = $_POST["titulo"]; 
$nuevo = $_POST["nuevo"];
/* Se agrega dos saltos de linea para completar */
/*if ( $action == 2 && $action == 3)
	$p01 = $_POST["p01"];
else if ($action == 1 )
	$p01 = $_POST["p01"] . "<p>&nbsp;</p><p>&nbsp;</p>";*/
$p01 = $_POST["p01"]; 
$inputs =explode(' ' , "img1 img2 img3 img4 img5 img6 img7 img8 img9 doc1 doc2 doc3 doc4 ima1 ima2 ima3 ima4 ima5");
$msj = "";
$e="";
/**
 * Se llama a la clase 'toup.php'
 * y se crea un objeto $up de esta clase. 
 */
include ("toup.php");
$up = new toup();
$up->wwwroot = realpath("..") ;
$up->pimg = "imagenes";
$up->pdoc = "documentos";


if ($accion==3){
	$sql = "DELETE FROM anuncio WHERE id = $id;";
}else {
    if ($accion ==1 ){
		$sys->conn->Execute("INSERT INTO anuncio VALUES ();");
		$id = $sys->conn->Insert_ID();
		$accion = 2;
	}
	foreach( $inputs as $file ) {
		if($_FILES[$file]['name']){
			if($up->proccess_file($file ,  $id , "anuncio") ){ 
				$$file = $up->lastname;
				if($up->lastthumb != "") echo "Thumbnail creado '$up->lastname':  $up->lastthumb<br>";
				else echo "Se subio '$up->lastname'<br>";
			}else{
				echo "Error al subir '$up->lastname': " .  $_FILES[$file]['name']  . " e:'$up->error'  <br>"; $$file = "";
			}
		}else $$file="";
	}
}


if($accion!=3){
	$sql="UPDATE anuncio SET ";
	$sql .= "titulo = '$titulo', ";
	$sql .= "publico = '$publico' ";
	if ($p01!="") $sql .= ", p01 = '$p01'  ";
	if ($img1!="") $sql .= ", img1 = '$img1'";
	if ($img2!="") $sql .= ", img2 = '$img2'";
	if ($img3!="") $sql .= ", img3 = '$img3'";
	if ($img4!="") $sql .= ", img4 = '$img4'";
	if ($img5!="") $sql .= ", img5 = '$img5'";
	if ($img6!="") $sql .= ", img6 = '$img6'";
	if ($img7!="") $sql .= ", img7 = '$img7'";
	if ($img8!="") $sql .= ", img8 = '$img8'";
	if ($img9!="") $sql .= ", img9 = '$img9'";
	if ($doc1!="") $sql .= ", doc1 = '$doc1'";
	if ($doc2!="") $sql .= ", doc2 = '$doc2'";
	if ($doc3!="") $sql .= ", doc3 = '$doc3'";
	if ($doc4!="") $sql .= ", doc4 = '$doc4'";
	if ($ima1!="") $sql .= ", ima1 = '$ima1'";
	if ($ima2!="") $sql .= ", ima2 = '$ima2'";
	if ($ima3!="") $sql .= ", ima3 = '$ima3'";
	if ($ima4!="") $sql .= ", ima4 = '$ima4', ";
	if ($nuevo!="") $sql .= ", nuevo = '$nuevo'";
	if ($fecha!="") $sql .= ", fecha = '$fecha'";
	$sql.= " WHERE id = $id;";
}
$sys->conn->Execute($sql);
$sys->currentid = $id;
$sys->log($_SESSION['id'] ,AVISO, $_POST["act"], $sql, "");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PROCESO  ANUNCIO</title>
<link href="cms.css" rel="stylesheet" type="text/css">
</head>
<body>
<center> <h1>PROCESO ANUNCIO</h1> </center>
<?php
if($e){
	echo "<hr>$e<hr>";
	$t=10000;
}else {
	$t=500;
}
?>
<BR>REALIZADO... SERA REDIRECCIONADO A LA LISTA DE ANUNCIOS EN SEGUNDOS.... SI NO DE CLICK <A HREF="lst_anuncio.php">AQUI </A>
<SCRIPT LANGUAGE="JavaScript">
<!--
//setTimeout( "document.location='lst_anuncio.php'", <?php echo $t ?> );	
//-->
</SCRIPT>
</body>
</html>
