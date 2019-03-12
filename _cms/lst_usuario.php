<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}

include('sistema.inc.php');
$sys = new sistema();
$sys->log( $_SESSION['user'] ,'CONTENIDO',"LISTAR","","");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>LISTAR CONTENDIO</title>
<link href="cms.css" rel="stylesheet" type="text/css"/>
<link href="tables.css" rel="stylesheet" type="text/css"/>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
</head>
<body>
<div class="contenido">
<p>&nbsp;</p>
<h1>LISTAR USUARIOS</h1>
<p>&nbsp;</p>
<div align="center">
<?php
$debug = false;
$sql="SELECT *, ID as id FROM usuarios;";
if($debug) echo $sql;
$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "ENTRADAS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<table align=\"center\" border=\"1\">\n";
	echo "	<tr>\n";
	echo "		<th >NOMBRE</th>\n";
	echo "		<th >E</th>\n";
	echo "		<th >E</th>\n";
	echo "	</tr>\n";
	while (!$recordSet->EOF) {
		echo "	 <tr>\n";
		echo "		<td><a href=\"frm_usuario.php?id=" . $recordSet->fields["id"] . "&act=2\">" .$recordSet->fields["nombre"] . "</a></td>\n";
		echo "		<td><a href=\"per_usuario.php?id=" . $recordSet->fields["id"] . "&act=3\"><img src=\"imagenes/editar.png\" alt=\"X\" border=\"0\"></a></td>\n";
		echo "		<td><a href=\"frm_usuario.php?id=" . $recordSet->fields["id"] . "&act=3\"><img src=\"imagenes/borrar.png\" alt=\"X\" border=\"0\"></a></td>\n";
		echo "	 </tr>\n";
		$recordSet->MoveNext();
	}
	echo "<table>\n";
}
?>
</div><p>&nbsp;</p>
<a href="frm_usuario.php">AGREGAR</a>
<p>&nbsp;</p>
</div>
</body>
</html>
