<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}

include('sistema.inc.php');
$sys = new sistema();
$sysl = new sistema("login");

include_once ('../extras/adodb496a/adodb-pager.inc.php');	 
$t=0;
if(isset($_POST["usuario"])){
	$usuario = $_POST["usuario"];
	$_SESSION["busuario"] = $usuario;
}else{ 
	if(isset($_SESSION["busuario"])) $usuario = $_SESSION["busuario"];
	else $usuario = 999;
}
if(isset($_POST["objeto"])){
	$objeto = $_POST["objeto"];
	$_SESSION["bobjeto"] = $objeto;
}else{ 
	if(isset($_SESSION["bobjeto"])) $objeto = $_SESSION["bobjeto"];
	else $objeto = 999;
}
if(isset($_POST["accion"])){
	$accion = $_POST["accion"];
	$_SESSION["baccion"] = $accion;
}else{ 
	if(isset($_SESSION["baccion"])) $accion = $_SESSION["baccion"];
	else $accion = 999;
}

if($usuario!=999) $t++;
if($objeto!=999) $t++;
if($accion!=999) $t++;

$sys->log( $_SESSION['user'] ,'CONTENIDO',"LISTAR","","");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>LISTAR CONTENDIO</title>
<link href="cms.css" rel="stylesheet" type="text/css"/>
<link href="tables.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<div class="contenido">
<p>&nbsp;</p>
<h1>BITACORA DE USO</h1>
<FORM NAME="filtrado" method="POST">
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
$sys->debug=true;
?>
<table width="100%" border="0">
  <tr>
    <td>USUARIO
      <select name="usuario">
	  <?php 
		echo "SELECT 999 as id, '----' as usuario UNION SELECT id, usuario FROM usuarios ;";
		$sysl->conn->catalogo("SELECT 999 as id, '----' as usuario UNION SELECT id, usuario FROM usuarios ;");
	
	  ?>
      </select>
     <script language="JavaScript" type="text/JavaScript"> document.filtrado.usuario.value = <?php echo $usuario ?>; </script>
      </td>
    <td>OBJETO
      
      <select name="objeto" >
	  <?php $sys->conn->catalogo("SELECT 999 as id, '----' as descripcion UNION SELECT id, descripcion FROM objeto ;"); ?>
      </select>
     <script language="JavaScript" type="text/JavaScript"> document.filtrado.objeto.value = <?php echo $objeto ?>; </script>
      </td>
    <td>ACCION
      
      <select name="accion" >
	  <?php $sys->conn->catalogo("SELECT 999 as id, '----' as descripcion UNION SELECT id, descripcion FROM accion ;"); ?>
      </select>
     <script language="JavaScript" type="text/JavaScript"> document.filtrado.accion.value = <?php echo $accion ?>; </script>
      </td>
  </tr>
</table>
<p>&nbsp;</p>
<input type="submit" value="FILTRAR"><BR>
</FORM>
<p>&nbsp;</p>
<div align="center">
<?php

$sql = "SELECT fecha AS FECHA, hora AS HORA , u.usuario AS USUARIO, o.descripcion AS OBJETO, a.descripcion AS ACCION, l.query as QUERY, l.id as ID FROM log AS l JOIN usuarios AS u ON  ";
$sql.= "l.usuario=u.id JOIN objeto AS o ON l.objeto = o.id JOIN accion AS a ON l.accion = a.id ";
//$sql = "SELECT * FROM log ";
$w="";
if($t==1){
	if($usuario!=999) $w = " l.usuario = $usuario "; 
	if($objeto!=999) $w = " l.objeto = $objeto "; 
	if($accion!=999) $w = " l.accion = $accion "; 
}
if($t==2){
	if($usuario!=999 && $objeto!=999) $w = " l.usuario = $usuario AND l.objeto = $objeto "; 
	if($objeto!=999 && $accion!=999) $w = " l.objeto = $objeto AND l.accion = $accion "; 
}
if($t==3)
	$w = " l.usuario = $usuario AND l.objeto = $objeto AND l.accion = $accion ";
if($w) $sql = $sql . " WHERE $w ";

$sql = $sql . " ORDER BY fecha, hora ";
//echo $sql;
$pager = new ADODB_Pager($sys->conn,$sql);
//$pager->rows=10;
$pager->Render($rows_per_page=10);
?>
</div>
<p>&nbsp;</p>
<a href="frm_usuario.php">AGREGAR</a>
<p>&nbsp;</p>
</div>
</body>
</html>
