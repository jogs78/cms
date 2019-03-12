<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}

include('sistema.inc.php');
$sys = new sistema();
if( !$sys->puede($_SESSION['id'] ,AVISO, LISTAR) ) exit; 
$sys->log( $_SESSION['id'] ,AVISO,LISTAR);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>LISTAR AVISOS</title>
<link href="cms.css" rel="stylesheet" type="text/css" />
<link href="tables.css" rel="stylesheet" type="text/css" />
</head>
<body><div class="contenido">
<p>&nbsp;</p>
<h1>LISTAR AVISOS</h1><p>&nbsp;</p>
<div align="center">
<?php
$debug = false;
$sql="SELECT id, fecha, titulo FROM anuncio ORDER BY fecha DESC;";
if($debug) echo $sql;
$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "AVISOS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<table>\n";
	echo "	<thead>\n<tr>\n";
	echo "		<th >FECHA</th>\n";
	echo "		<th >TITULO</th>\n";
//	echo "		<th >M</th>\n";
	echo "		<th >E</th>\n";
	echo "		<th >C</th>\n";
	echo "	</tr>\n</thead>";
	$i = 1;
	while (!$recordSet->EOF) {
		echo "<tbody>\n";
		if ($i%2 == 0)
		echo "	 <tr class=\"odd\">\n";
		else echo "    <tr>\n";
		echo "		<td>" . $recordSet->fields["fecha"] . "</td>\n";
//		echo "		<td>" . $recordSet->fields["titulo"] . "</td>\n";
		echo "		<td><a href=\"frm_anuncio.php?ide=" . $recordSet->fields["id"] . "&act=2\">" . $recordSet->fields["titulo"] . "</a></td>\n";
		echo "		<td><a href=\"frm_anuncio.php?ide=" . $recordSet->fields["id"] . "&act=3\"><img src=\"imagenes/borrar.png\" alt=\"X\" border=\"0\"></a></td>\n";
		echo "		<td><a href=\"frm_noticia.php?ide=" . $recordSet->fields["id"] . "&act=4\"><img src=\"imagenes/export.png\" alt=\"C\" border=\"0\"></a></td>\n";
		echo "	 </tr>\n</tbody>\n";
		$i++;
		$recordSet->MoveNext();
	}
	echo "<table>\n";
}
?>
</div><p>&nbsp;</p>
</div>
<p><a href="frm_anuncio.php">AGREGAR</a></p>
<p>&nbsp;</p>
</body>
</html>
