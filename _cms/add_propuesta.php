<?php
/**
 * @name Agregar propuesta (Agregar Postor)
 * 
 * @abstract Este es un formulario para agregar una propuesta 
 * es decir establecer que un usuario puede propner un contenido
  * 
 */
session_start(      );
if (!isset($_SESSION["INCMS"])){
	exit;
}
include('sistema.inc.php');
$sys = new sistema();
if(isset($_GET["act"]) ) $accion=$_GET["act"]; else $accion=1; //1.- alta, 
if($accion!=1) if( !$sys->puede($_SESSION['id'] ,PROPUESTA, VER) ) exit; 
if ($accion!=1) $sys->log( $_SESSION['id'] , PROPUESTA , VER );

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>AGREGAR UNA PROPUESTA PARA UN CONTENIDO</title>
<script language="JavaScript" src="../extras/ajax.js"></script>
</head>
<body><center> <h1>PROPUESTA PARA UN CONTENIDO</h1> </center>
<form name="frmprop" method="post" action="prc_add_propuesta.php" enctype="multipart/form-data">
<input type="hidden" name="act" value="1">
TIPO <select  name="idc"> 
<?php echo $sys->conn->catalogo2("SELECT id, titulo FROM entrada WHERE id IN (SELECT id FROM contenido) AND id NOT IN (SELECT idc from propuesta) ;"); ?> 
</select> 
<!-- <script language="JavaScript" type="text/JavaScript"> document.frmprop.tipo.value = '< ?php //echo $tipo ?>';  </script> -->
<BR>  
TEMA: <SELECT  NAME="idu">  
<?php echo $sys->conn->catalogo2("SELECT id, nombre from  usuarios;"); ?> 
</SELECT>  
<HR>
<br>
<input type="submit" value="AGREGAR">
</form>
</body>
</html>
