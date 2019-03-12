<?php
/**
 * @name Procesar Noticia
 * 
 * @abstract Esta página es utilizada para procesar
 * los datos enviados desde el formulario de noticia.
 * 
 * @param array $_POST En este arreglo se transmite
 * la información que debe ser procesada.
 * @param int $_POST['ide'] || null Indica el IDE de la noticia que se modifica y/o
 * elimina de la base de datos
 * @param int $_POST['act'] Indica la acción que ha de realazarse
 * 1.- Agregar 2.- Modificar 3.- Eliminar
 * 
 * @uses prc_noticia.php Esta se usa cuando se agrega una noticia nueva
 * @uses prc_noticia.php?ide=10&act=2 Esta se usa cuando ha de modificarse una noticia
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
if( !$sys->puede($_SESSION['id'] , AGREGADO, $accion) ) exit;
$id = $_POST["ide"];
$p01 = $_POST["p01"]; 
if(isset($_POST["activo"]) )	$activo="1";
else 	$activo="0";
$fecha = $_POST["fecha"];
$titulo= $_POST["titulo"];
$id_contenedor= $_POST["id_contenedor"];

$contenidos_es =$_POST["contenidos_es"];
if($contenidos_es == 2) $idc="_l";
else $idc="";
$inputs =explode(' ' , "img1 img2 img3 img4 img5 img6 img7 img8 img9 doc1 doc2 doc3 doc4 ima1 ima2 ima3 ima4 fot0 fot1 fot2 fot3 fot4 fot5 fot6 fot7 fot8 fot9");
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
	$sql = "DELETE FROM libre WHERE id = $id;";
}else {
	if ($accion ==1 ){
		$sys->conn->Execute("INSERT INTO libre VALUES ();");
		$id = $sys->conn->Insert_ID();
	}
	foreach( $inputs as $file ) {
	echo "SUBIR: $file <br>";
		if($_FILES[$file]['name']){
			if($up->proccess_file($file ,  $id , "agregado") ){ 
				$$file = $up->lastname;
				if($up->lastthumb != "") $msj .= "Thumbnail creado '$up->lastname':<br />  $up->lastthumb<br />";
				else $msj.="Se subio '$up->lastname'<br />";
			}else{
				$msj .= "Error al subir '$up->lastname': " .  $_FILES[$file]['name']  . " e:'$up->error'  <br />"; $$file = "";
			}
		}else $$file="";
	}
}

//1.- alta, 2.-modificacion,3.-borrar
if ($accion==2) {
//	$actualizado = date("d/m/Y");

		$sql="UPDATE libre SET ";
		$sql .= "titulo = '$titulo', ";

		if ($p01!="") $sql .= "p01 = '$p01', ";
	if ($img1!="") $sql .= "img1 = '$img1', ";
	if ($img2!="") $sql .= "img2 = '$img2', ";
	if ($img3!="") $sql .= "img3 = '$img3', ";
	if ($img4!="") $sql .= "img4 = '$img4', ";
	if ($img5!="") $sql .= "img5 = '$img5', ";
	if ($img6!="") $sql .= "img6 = '$img6', ";
	if ($img7!="") $sql .= "img7 = '$img7', ";
	if ($img8!="") $sql .= "img8 = '$img8', ";
	if ($img9!="") $sql .= "img9 = '$img9', ";
	if ($doc1!="") $sql .= "doc1 = '$doc1', ";
	if ($doc2!="") $sql .= "doc2 = '$doc2', ";
	if ($doc3!="") $sql .= "doc3 = '$doc3', ";
	if ($doc4!="") $sql .= "doc4 = '$doc4', ";
	if ($ima1!="") $sql .= "ima1 = '$ima1', ";
	if ($ima2!="") $sql .= "ima2 = '$ima2', ";
	if ($ima3!="") $sql .= "ima3 = '$ima3', ";
	if ($ima4!="") $sql .= "ima4 = '$ima4', ";
	if ($fot0!="") $sql .= "fot0 = '$fot0', ";
	if ($fot1!="") $sql .= "fot1 = '$fot1', ";
	if ($fot2!="") $sql .= "fot2 = '$fot2', ";
	if ($fot3!="") $sql .= "fot3 = '$fot3', ";
	if ($fot4!="") $sql .= "fot4 = '$fot4', ";
	if ($fot5!="") $sql .= "fot5 = '$fot5', ";
	if ($fot6!="") $sql .= "fot6 = '$fot6', ";
	if ($fot7!="") $sql .= "fot7 = '$fot7', ";
	if ($fot8!="") $sql .= "fot8 = '$fot8', ";
	if ($fot9!="") $sql .= "fot9 = '$fot9', ";
	if ($fecha!="") $sql .= "fecha = '$fecha',  ";
	$sql .= "id_contenedor = '$id_contenedor', ";
	//$sql .= "actualizado = '$actualizado', ";
	$sql .= "activo = '$activo' ";
	$sql.= " WHERE id = $id;";
}
if ($accion==1) {
		$sql1="INSERT INTO libre ( ";
		$sql2=" VALUES (  ";
		$sql1.="titulo, "; $sql2.="'$titulo', ";
		$sql1.="id_contenedor, "; $sql2.="'$id_contenedor', ";

	if($p01!="") { $sql1.="p01, "; $sql2.="'$p01', "; }
	if($img1!="") { $sql1.="img1, "; $sql2.="'$img1', "; }
	if($img2!="") { $sql1.="img2, "; $sql2.="'$img2', "; }
	if($img3!="") { $sql1.="img3, "; $sql2.="'$img3', "; }
	if($img4!="") { $sql1.="img4, "; $sql2.="'$img4', "; }
	if($img5!="") { $sql1.="img5, "; $sql2.="'$img5', "; }
	if($img6!="") { $sql1.="img6, "; $sql2.="'$img6', "; }
	if($img7!="") { $sql1.="img7, "; $sql2.="'$img7', "; }
	if($img8!="") { $sql1.="img8, "; $sql2.="'$img8', "; }
	if($img9!="") { $sql1.="img9, "; $sql2.="'$img9', "; }
	if($doc1!="") { $sql1.="doc1, "; $sql2.="'$doc1', "; }
	if($doc2!="") { $sql1.="doc2, "; $sql2.="'$doc2', "; }
	if($doc3!="") { $sql1.="doc3, "; $sql2.="'$doc3', "; }
	if($doc4!="") { $sql1.="doc4, "; $sql2.="'$doc4', "; }
	if($ima1!="") { $sql1.="ima1, "; $sql2.="'$ima1', "; }
	if($ima2!="") { $sql1.="ima2, "; $sql2.="'$ima2', "; }
	if($ima3!="") { $sql1.="ima3, "; $sql2.="'$ima3', "; }
	if($ima4!="") { $sql1.="ima4, "; $sql2.="'$ima4', "; }
	if($fot0!="") { $sql1.="fot0, "; $sql2.="'$fot0', "; }
	if($fot1!="") { $sql1.="fot1, "; $sql2.="'$fot1', "; }
	if($fot2!="") { $sql1.="fot2, "; $sql2.="'$fot2', "; }
	if($fot3!="") { $sql1.="fot3, "; $sql2.="'$fot3', "; }
	if($fot4!="") { $sql1.="fot4, "; $sql2.="'$fot4', "; }
	if($fot5!="") { $sql1.="fot5, "; $sql2.="'$fot5', "; }
	if($fot6!="") { $sql1.="fot6, "; $sql2.="'$fot6', "; }
	if($fot7!="") { $sql1.="fot7, "; $sql2.="'$fot7', "; }
	if($fot8!="") { $sql1.="fot8, "; $sql2.="'$fot8', "; }
	if($fot9!="") { $sql1.="fot9, "; $sql2.="'$fot9', "; }	
	$sql1.="activo, "; $sql2.="'$activo', ";
	if($fecha!="") { $sql1.="fecha ) "; $sql2.="'$fecha' ) ;"; }
	$sql = $sql1 . $sql2;
}
$sys->currentid = $id;
$sys->log($_SESSION['id'] ,AGREGADO, $accion, $sql);
//$sys->conn->debug=true;
$recordSet = &$sys->conn->Execute($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PROCESO  CONTENIDO</title>
<link href="cms.css" rel="stylesheet" type="text/css">
</head>
<body><center> <h1>PROCESO CONTENIDO</h1> </center>
<?php 
$t=0;
 if($e){	echo "<hr>$e<hr>";
 $t=10000;
 }else {
 $t=500;
 }
?>
<BR>REALIZADO... SERA REDIRECCIONADO A LA LISTA DE CONTENIDOS EN SEGUNDOS.... SI NO DE CLICK <A HREF="lst_agregado.php">AQUI </A>
<SCRIPT LANGUAGE="JavaScript">
<!--
//setTimeout( "document.location='lst_contenido.php'", <?php echo $t ?> );	
-->
</SCRIPT>
</body>
</html>
