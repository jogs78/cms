<?php
/**
 * @name Listar Noticia
 * 
 * @abstract Esta página es utilizada para listar las noticias
 * 
 * @uses lst_noticia.php Esta se usa cuando se listan  las  noticia noticias
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
if( !$sys->puede($_SESSION['id'] ,NOTICIA, LISTAR) ) exit; 
$sys->log( $_SESSION['id'] ,NOTICIA,LISTAR);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>LISTAR NOTICIA</title>
<link href="cms.css" rel="stylesheet" type="text/css"/>
<link href="tables.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="contenido">
<p>&nbsp;</p>
<h1>LISTAR NOTICIAS</h1>
<p>&nbsp;</p>
<div align="center">
<?php
$debug = false;
$sql="SELECT id, fecha, titulo FROM noticia ORDER BY fecha DESC;";
if ($debug ) echo $sql;
$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "NOTICIAS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<table align=\"center\" border=\"1\">\n";
	echo "	<thead>\n<tr>\n";
	echo "		<th >FECHA</th>\n";
	//echo "		<th> NUEVO</th>\n";
	echo "		<th >TITULO</th>\n";
	echo "		<th >E</th>\n";
	echo "		<th >C</th>\n";
	echo "	</tr>\n</thead>\n";
	$i = 1;
	while (!$recordSet->EOF) {
		echo "<tbody>\n";
		if ($i%2 == 0)
		echo "	 <tr class=\"odd\">\n";
		else echo "    <tr>\n";
		echo "		<td>" . $recordSet->fields["fecha"] . "</td>\n";
		//echo "		<td>" . $recordSet->fields["nuevo"] . "</td>\n";
		echo "		<td><a href=\"frm_noticia.php?ide=" . $recordSet->fields["id"] . "&act=2\">" . utf8_decode ($recordSet->fields["titulo"]) . "</a></td>\n";
		echo "		<td><a href=\"frm_noticia.php?ide=" . $recordSet->fields["id"] . "&act=3\"><img src=\"imagenes/borrar.png\" alt=\"X\" border=\"0\"></a></td>\n";
		echo "		<td><a href=\"frm_anuncio.php?ide=" . $recordSet->fields["id"] . "&act=4\"><img src=\"imagenes/export.png\" alt=\"C\" border=\"0\"></a></td>\n";
		echo "	 </tr>\n</tbody>\n";
		$i++;
		$recordSet->MoveNext();
	}
	echo "<table>\n";
}
?>
</div>
<p>&nbsp;</p>
<a href="frm_noticia.php">AGREGAR</a>
<p>&nbsp;</p>
</div>
</body>
</html>
