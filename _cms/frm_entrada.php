<?php
/**
 * @name Formulario de Noticias
 * @author Ing. Jorge Octavio Gúzman Sánchez
 * @package _cms
 * @version 2.0.1
 * 
 * @abstract Esta página es utilizada para dar de alta,
 *modificar o eliminar una entrada de la
 * base de datos.
 * 
 * @param int $_GET['ide'] Ide de la noticia
 * @param int $_GET['act'] Acción a realizar  2 -> Modificar, 3 -> Eliminar 
 * @param null cuando esta página no recibe ningun parametro entra en el modo
 * de Agregar Nueva noticia.
 */
session_start();
/**
 * Aquí se verifica que se haya iniciado una session de administración
 */
if (!isset($_SESSION["INCMS"])){
	exit;
}
/**
 * Se crea el objeto $sys para grabar un log de actividad
 */
include('sistema.inc.php');
$sys = new sistema();
if(isset($_GET["act"]) ){	$accion=$_GET["act"]; }else 	$accion=1; //1.- alta, 2.-modificacion,3.-borrar 
if($accion!=1) if( !$sys->puede($_SESSION['id'] ,ENTRADA, VER) ) exit; 
if(isset($_GET["ide"])){ 	$id=$_GET["ide"]; }else{ 	$id=""; }
$id_padre = "";
$titulo = "";
$tipo = "";
$url = "";
$intra="0";
$activo="1";
$fecha = date("Y-m-d"); 
if ($accion==3) $dis = " disabled "; else $dis ="";
if($accion !=1 ){
	if(!$id) exit;
	$sql="SELECT * FROM entrada WHERE id=$id";
	$row = $sys->conn->GetRow($sql);
	if (!$row){ 
		print $sys->conn->ErrorMsg();
		exit;
	}else{
		$id_padre=$row["id_padre"];
		$titulo=$row["titulo"];
		$tipo=$row["tipo"];
		$url=$row["url"];
		$fecha=$row["fecha"];
		$intra=$row["intra"];
		$activo=$row["activo"];
	}
}
$sys->currentid = $id;
if ($accion!=1) $sys->log( $_SESSION['id'] , ENTRADA , VER );

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>FROMULARIO ENTRADA</title>
<script language="JavaScript" src="../extras/selects.js"></script>
<script language="JavaScript" src="../extras/validate.js"></script>
<style  type="text/css">@import url(../extras/jscalendar-1.0/calendar-ittg.css);</style>
<script type="text/javascript" src="../extras/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="../extras/jscalendar-1.0/lang/calendar-es.js"></script>
<script type="text/javascript" src="../extras/jscalendar-1.0/calendar-setup.js"></script>

</head>
<body> 
<?php
echo "<center> <h1>";
switch ($accion){
	case 1: $cap="AGREGAR "; break;
	case 2: $cap="MODIFICAR "; break;
	case 3: $cap="ELIMINAR "; break;
}
echo "$cap ENTRADA </h1> </center>";
//echo "SELECT id, titulo as descripcion FROM entrada WHERE id > 1 AND tipo = 1"; ?> 
<form name="frmentrada" method="post" action="prc_entrada.php" enctype="multipart/form-data"> 
  <input type="hidden" name="act" value="<?php echo $accion ?>"> 
  <input type="hidden" name="ide" value="<?php echo $id ?>"> 
  SECCION A LA QUE PERTENECE
  <select <?php echo $dis ?> name="id_padre"> 
	
    <?php 
	$sql = "SELECT id, titulo as descripcion  FROM entrada WHERE  tipo = 1";
    echo $sys->conn->catalogo($sql); 
?> 
  </select> 
  <BR> 
  <script language="JavaScript" type="text/JavaScript"> document.frmentrada.id_padre.value = <?php echo ($id_padre + 0) ?>; </script> 
  TITULO
  <input <?php echo $dis ?> type="text"  name="titulo" alt="R,texto,mayusculas,El titulo " value="<?php echo $titulo ?>" maxlength="70"> 
  <BR> 
  TIPO
  <select <?php echo $dis ?> name="tipo" onchange="chn(tipo,url) "> 
    <?php 
	$sql = "SELECT * FROM tipo";
    echo $sys->conn->catalogo($sql); 

	
	?> 
  </select> 
  <BR> 
  <script language="JavaScript" type="text/JavaScript"> document.frmentrada.tipo.value = <?php echo ($tipo + 0 ) ?>; </script> 
  URL DEL SISTEMA
  <input <?php echo $dis ?> type="text" name="url" <?php if($tipo!=999  && $tipo !=1000) echo "DISABLED"; ?>  value="<?php echo $url ?>"> 
  <BR> 
  INTRANET:
  <INPUT TYPE="checkbox" NAME="intra" <?php if($intra) echo "checked" ?>> 
  <BR> 
  ACTIVO:
  <INPUT TYPE="checkbox" NAME="activo" <?php if($activo) echo "checked" ?>> 
  <br> 
  FECHA ENTRA EN VIGENCIA<font color="#FF0000">*</font> 
   <input type="text"   id="data3" name="fecha" value="<?php echo $fecha ?>" />
   <script type="text/javascript">
  Calendar.setup(
    {
      inputField  : "data3",         // ID of the input field
      ifFormat    : "%Y-%m-%d",    // the date format
 	  weekNumbers : false,
	  singleClick : false,
	  range       : [2000,2015],
    eventName     : "focus",
//      button      : "trigger",       // ID of the button
	  step        :  1
    }
  );
</script>
  <input type="submit" value="<?php echo $cap ?>"> 
</form> 
</body>
</html>
