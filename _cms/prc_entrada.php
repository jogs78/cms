<?php
/**
 * @name Procesar Noticia
 * 
 * @abstract Esta página es utilizada para procesar
 * los datos enviados desde el formulario de entrada.
 * 
 * @param array $_POST En este arreglo se transmite
 * la información que debe ser procesada.
 * @param int $_POST['ide'] || null Indica el IDE de la entrada que se modifica y/o
 * elimina de la base de datos
 * @param int $_POST['act'] Indica la acción que ha de realazarse
 * 1.- Agregar 2.- Modificar 3.- Eliminar
 * 
 * @uses prc_entrada.php Esta se usa cuando se agrega una entrada nueva
 * @uses prc_entrada.php?ide=10&act=2 Esta se usa cuando ha de modificarse una entrada
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
if( !$sys->puede($_SESSION['id'] ,ENTRADA, $accion) ) exit;
$id = $_POST["ide"];
$e="";
if ($accion==3){
	$sql = "DELETE FROM entrada WHERE id = $id;";
}else  {
	$id_padre = $_POST["id_padre"];
	$titulo = $_POST["titulo"];
	$tipo = $_POST["tipo"];
	if(isset($_POST["url"]) )	$url = $_POST["url"];
	else 	$url = "";
	if(isset($_POST["intra"]) )	$intra="1";
	else 	$intra="0";
	if(isset($_POST["activo"]) )	$activo="1";
	else 	$activo="0";
	$fecha = $_POST["fecha"]; 
}
//1.- alta, 2.-modificacion,3.-borrar
//echo "accion==$accion";
if ($accion==2) {
	$sql="UPDATE entrada SET ";
	if ($id_padre!="") $sql .= "id_padre = '$id_padre', ";
	if ($titulo!="") $sql .= "titulo = '$titulo', ";
	if ($tipo!="") $sql .= "tipo = '$tipo', ";
	if ($url!="") $sql .= "url = '$url', ";
	$sql .= "intra = '$intra', ";
	$sql .= "activo = '$activo', ";
	if ($fecha!="") $sql .= "fecha = '$fecha'  ";
	$sql.= " WHERE id = $id;";
}
if ($accion==1) {
	$sql1="INSERT INTO entrada ( ";
	$sql2=" VALUES ( ";
	if($id_padre!="") { $sql1.="id_padre, "; $sql2.="'$id_padre', "; }
	if($titulo!="") { $sql1.="titulo, "; $sql2.="'$titulo', "; }
	if($tipo!="") { $sql1.="tipo, "; $sql2.="'$tipo', "; }
	if($url!="") { $sql1.="url, "; $sql2.="'$url', "; }
	$sql1.="intra, "; $sql2.="'$intra', ";
	$sql1.="activo, "; $sql2.="'$activo', ";
	if($fecha!="") { $sql1.="fecha ) "; $sql2.="'$fecha' ) ;"; }
	$sql = $sql1 . $sql2;
}
$recordSet = &$sys->conn->Execute($sql);
$sys->currentid = $id;
$sys->log($_SESSION['id'] ,ENTRADA, $accion, $sql, "");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PROCESO  ENTRADA</title>
<link href="cms.css" rel="stylesheet" type="text/css">
</head>
<body><center> <h1>PROCESO ENTRADA</h1> </center>
<?php
$t=0;
 if($e){	echo "<hr>$e<hr>";
 $t=10000;
 }else {
 $t=500;
 }
?>
<BR>REALIZADO... SERA REDIRECCIONADO A LA LISTA DE ENTRADAS EN SEGUNDOS.... SI NO DE CLICK <A HREF="lst_entrada.php">AQUI </A>
<SCRIPT LANGUAGE="JavaScript">
<!--
setTimeout( "document.location='lst_entrada.php'", <?php echo $t ?> );	
//-->
</SCRIPT>
</body>
</html>