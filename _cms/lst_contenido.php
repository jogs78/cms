<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}

include('sistema.inc.php');
$sys = new sistema();
if( !$sys->puede($_SESSION['id'] , CONTENIDO, LISTAR) ) exit; 
$sys->log( $_SESSION['id'] , CONTENIDO, LISTAR);
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
<h1>LISTAR CONTENIDOS</h1>
<p>&nbsp;</p>
<div align="center">
<?php
$debug = false;
$sql="SELECT x.id,  x.titulo, e.titulo as dentro FROM entrada as e left JOIN entrada as x ON e.id = x.id_padre WHERE x.id IN (select id from contenido);";
$sql="SELECT x.id,  x.titulo, e.titulo as dentro FROM entrada as e left JOIN entrada as x ON e.id = x.id_padre WHERE x.id IN (select id from contenido) ORDER BY e.id;";
if($debug) echo $sql;
$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "ENTRADAS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<table align=\"center\">\n";
	echo "	<thead>\n<tr>\n";
	echo "		<th >TITULO</th>\n";
	echo "		<th >DENTRO DE SECCION </th>\n";
	echo "		<th >E</th>\n";
	echo "	</tr>\n</thead>\n";
	$i = 1;
	while (!$recordSet->EOF) {
		echo "<tbody>\n";
		if ($i%2 == 0)
		echo "	 <tr class=\"odd\">\n";
		else echo "    <tr>\n";
		echo "		<td><a href=\"frm_contenido.php?ide=" . $recordSet->fields["id"] . "&act=2&lib=0\">" . utf8_encode($recordSet->fields["titulo"]) . "</a></td>\n";
		echo "		<td>" . $recordSet->fields["dentro"] . "</td>\n";
		echo "		<td><a href=\"frm_contenido.php?ide=" . $recordSet->fields["id"] . "&act=3&lib=0\"><img src=\"imagenes/borrar.png\" alt=\"X\" border=\"0\"></a></td>\n";
		echo "	 </tr>\n</tbody>\n";
		$i++;
		$recordSet->MoveNext();
	}
	echo "<table>\n";
}
echo "<br>";
$sql="SELECT id,   titulo FROM libre where titulo <> '';";
if($debug) echo $sql;
$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "ENTRADAS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<table align=\"center\" border=\"1\">\n";
	echo "	<tr>\n";
	echo "		<th >TITULO</th>\n";
	echo "		<th >E</th>\n";
	echo "	</tr>\n";
	while (!$recordSet->EOF) {
		echo "	 <tr>\n";
		echo "		<td><a href=\"frm_anuncio.php?ide=" . $recordSet->fields["id"] . "&act=2\">" . $recordSet->fields["titulo"] . "</a></td>\n";
		echo "		<td><a href=\"frm_anuncio.php?ide=" . $recordSet->fields["id"] . "&act=3\"><img src=\"imagenes/borrar.png\" alt=\"X\" border=\"0\"></a></td>\n";
		echo "	 </tr>\n";
		$recordSet->MoveNext();
	}
	echo "<table>\n";
}
?>
</div><p>&nbsp;</p>
<a href="frm_contenido.php">AGREGAR</a>
<p>&nbsp;</p>
</div>
</body>
</html>
