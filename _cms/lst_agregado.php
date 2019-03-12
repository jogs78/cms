<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}

include('sistema.inc.php');
$sys = new sistema();
if( !$sys->puede($_SESSION['id'] , AGREGADO, LISTAR) ) exit; 
$sys->log( $_SESSION['id'] , AGREGADO, LISTAR);
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
<h1>LISTAR AGREGADOS</h1>
<p>&nbsp;</p>
<div align="center">
<?php
$debug = false;
echo "<br>";
$sql="SELECT id,   titulo FROM libre WHERE not isnull(id_contenedor);";
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
		echo "		<td><a href=\"frm_agregado.php?ide=" . $recordSet->fields["id"] . "&act=2\">" . $recordSet->fields["titulo"] . "</a></td>\n";
		echo "		<td><a href=\"frm_agregado.php?ide=" . $recordSet->fields["id"] . "&act=3\"><img src=\"imagenes/borrar.png\" alt=\"X\" border=\"0\"></a></td>\n";
		echo "	 </tr>\n";
		$recordSet->MoveNext();
	}
	echo "<table>\n";
}
?>
</div><p>&nbsp;</p>
<a href="frm_agregado.php">AGREGAR</a>
<p>&nbsp;</p>
</div>
</body>
</html>
