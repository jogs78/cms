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
//$sys->conn->debug=true;
$accion=$_POST["act"];
if( !$sys->puede($_SESSION['id'] , ANUNCIOG, $accion) ) exit; 
$id = $_POST["idg"];
$fecha = $_POST["fecha"];
$ida = $_POST["ida"];
$titulo = $_POST["titulo"];
$tipo =$_POST["tipo"];
$lugar =$_POST["lugar"];
$url =$_POST["url"];
$orden =$_POST["orden"];
if($url!="") $titulo = $_POST["titulo_url"];
$centro=0;
$izq=0;
$der=0;
switch ($lugar){
	case 'centro': $centro=1;
	break;
	case 'izq': $izq=1;
	break;
	case 'der': $der=1;
	break;
}
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
$sys->conn->StartTrans();
if ($accion==1) {
	$sql="INSERT INTO anunciog ( ) VALUES () ;";
}
if ($accion==2) {
	$sql = "SELECT 1";
}
if ($accion==3){
	$sql = "DELETE FROM anunciog WHERE idg = $id;";
}
if ($sys->conn->Execute($sql) === false) {
	$e = 'error al insertar: '.$sys->conn->ErrorMsg().'<BR>';
}else{
	if($accion == 1) $id = $sys->conn->Insert_ID( );
}
if($accion!=3){
	$inputs =explode(' ' , "img");
	foreach( $inputs as $file ) {
		if($_FILES[$file]['name']){
			if($up->proccess_file($file ,  $id , "grafico") ){ 
				$$file = $up->lastname;
				if($up->lastthumb != "") echo "Thumbnail creado '$up->lastname':  $up->lastthumb<br>";
				else echo "Se subio '$up->lastname'<br>";
			}else{
				echo "Error al subir '$up->lastname': " .  $_FILES[$file]['name']  . " e:'$up->error'  <br>"; $$file = "";
			}
		}else{
			$$file="";	
		 } 
	}
	$sql="UPDATE anunciog SET ";
	$sql .= "titulo = '$titulo' ";
	if ($$file !="") $sql .= ", img = '" . $$file ."'";
	if ($fecha !="") $sql .= ", fecha = '$fecha'";
	if ($tipo !="") $sql .= ", tipo = '$tipo'";
	if ($ida !="") $sql .= ", id = '$ida'";
	if ($url !="") $sql .= ", url = '$url'";
	$sql .= ", central = '$centro'";
	$sql .= ", izq = '$izq'";
	$sql .= ", der = '$der'";
	$sql .= ", orden = '$orden'";
	$sql.= " WHERE idg = $id ;";
//	$sys->conn->debug=true;
	$sys->conn->Execute($sql);
	$sys->conn->debug=false;
}

if( $sys->conn->HasFailedTrans())  {
	$e .= "sucedio un error.";
}
$sys->conn->CompleteTrans();
$sys->currentid = $id;
$sys->log($_SESSION['id'] , ANUNCIOG, $accion, $sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PROCESO  ANUCNCIO GRAFICO</title>
<link href="cms.css" rel="stylesheet" type="text/css">
</head>
<body>
<center> <h1>PROCESO ANUNCIO GRAFICO</h1> </center>
<?php
 if($e){	echo "<hr>$e<hr>";
 $t=10000;
 }else {
 $t=500;
 }
?>
<BR>REALIZADO... SERA REDIRECCIONADO A LA LISTA DE ANUNCIOS GRAFICOS EN SEGUNDOS.... SI NO DE CLICK <A HREF="lst_anunciog.php">AQUI </A>
<SCRIPT LANGUAGE="JavaScript">
<!--
//setTimeout( "document.location='lst_anunciog.php'", <?php echo $t ?> );	
//-->
</SCRIPT>
</body>
</html>
