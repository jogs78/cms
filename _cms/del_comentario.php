<?php
/**
 * @name Vaciar los comentarios
 * 
 * @abstract Esta página elimina los comentarios que fueron seleccionados en lst_comentario.php
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
 */session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
include('sistema.inc.php');
$sys = new sistema();
$e = "";
if( !$sys->puede($_SESSION['id'] , COMENTARIO, ELIMINAR) ) exit; 
if(!isset($_POST["campos"]) ){
	$e .=  "error, no se han seleccionado correos a eliminar";
	$e .=  "<BR><BR><A HREF=\"javascript:history.go(-1)\">REGRESAR...</A><BR>";
	$t=50000;
} else	{
	$aLista=array_keys($_POST["campos"]) ;
	$sQuery="DELETE FROM comentario WHERE id IN (" . implode(',',$aLista) . ")";
	$recordSet = &$sys->conn->Execute($sQuery);
	$sys->currentid = -100;
	$sys->log( $_SESSION['user'] ,'COMENTARIO','BORRAR',$sQuery,"");
	$e .=  "<br>SERA REDIRECCIONADO A LA LISTA DE COMENTARIOS EN SEGUNDOS.... SI NO DE CLICK <A HREF=\"lst_comentario.php\">AQUI </A>"; 
	$t=3000;
} 
$sys->log( $_SESSION['id'] ,COMENTARIO,ELIMINAR,$sql);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
	<title>PROCESO  COMENTARIO</title>
	<link href="cms.css" rel="stylesheet" type="text/css">
 </HEAD>
 <BODY><center> <h1>ELMINAR COMENTARIOS</h1> </center>
<?php echo $e; ?>
<SCRIPT LANGUAGE="JavaScript">
<!--
setTimeout( "document.location='lst_comentario.php'", <?php echo $t ?> );
-->
</SCRIPT>
</body>
</html>
