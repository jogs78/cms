<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
$debug = true;
include('sistema.inc.php');
$sys = new sistema();
//$sys->conn->debug=true;
$e="";
if(!isset($_POST["permiso"]) || !isset($_POST["id"]) ){
	$e .= "error, no se han seleccionado permisos";
	$e .= "<BR><BR><A HREF=\"javascript:history.go(-1)\">REGRESAR...</A><BR>";
} else	{
	$id=$_POST["id"]; 
	$aLista=array_keys($_POST["permiso"]) ;
	$t =  sizeof ( $aLista);
	$sql = "DELETE FROM permisos WHERE usuario = $id;";
	if ($sys->conn->Execute($sql) === false) {
		$e .=  'error al insertar: '.$sys->conn->ErrorMsg() . " - $sql <BR>";
	}
	for($i=0; $i<$t; $i++){
		$val = $aLista[$i];
		$arr = explode('.' , $val);
		$sql = "INSERT INTO permisos  (usuario, objeto, accion) VALUES ($id, " . $arr[0] . "," . $arr[1] . ");";
		if ($sys->conn->Execute($sql) === false) {
			$e .=  'error al insertar: '. $sys->conn->ErrorMsg() . " - $sql <BR>";
		}
	}
	$sql = "UPDATE permisos SET menu=1 WHERE accion IN (1,5,6,8,9,14);";
	if ($sys->conn->Execute($sql) === false) {
		$e .=  'error al insertar: '.$sys->conn->ErrorMsg() . " - $sql <BR>";
	}
//	$recordSet = &$sys->conn->Execute($sQuery);
//	$sys->currentid = -100;
//	$sys->log( $_SESSION['user'] ,'COMENTARIO','BORRAR',$sQuery,"");
	echo "<br>SERA REDIRECCIONADO A LA LISTA DE COMENTARIOS EN SEGUNDOS.... SI NO DE CLICK <A HREF=\"lst_usuario.php\">AQUI </A>"; 
	$t=500;
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
	<title>PROCESO  COMENTARIO</title>
	<link href="cms.css" rel="stylesheet" type="text/css">
 </HEAD>
 <BODY><center> <h1>ASIGNAR PERMISOS</h1> </center>
<?php
if($e){
	$t=50000;
	echo $e;
} else $t=0;
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
setTimeout( "document.location='lst_usuario.php'", <?php echo $t ?> );
-->
</SCRIPT>
</body>
</html>
