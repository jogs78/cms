<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
include('sistema.inc.php');
$sys = new sistema();
if( !$sys->puede($_SESSION['id'] , POSTOR, LISTAR) ) exit; 
$sys->log( $_SESSION['id'] , POSTOR , LISTAR);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>LISTAR POSTORES</title>
<link href="cms.css" rel="stylesheet" type="text/css"/>
<link href="tables.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="contenido">
<p>&nbsp;</p>
<h1>LISTAR POSTORES</h1>
<p>&nbsp;</p>
<div align="center">
<?php
$sql="SELECT u.nombre, e.titulo,  r.idp from entrada e JOIN propuesta_usuario r ON e.id = r.idc JOIN usuarios u ON r.idu = u.id;";
$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "DUPLAS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<table align=\"center\" border=\"1\">\n";
	echo "	<tr>\n";
	echo "		<th >QUIEN </th>\n";
	echo "		<th >PROPONE </th>\n";
//	echo "		<th >E</th>\n";
	echo "	</tr>\n";
	while (!$recordSet->EOF) {
		echo "	 <tr>\n";
		echo "		<td><a href=\"frm_postor.php?idp=" . $recordSet->fields["idp"] . "&act=2\">" .  $recordSet->fields["nombre"]  . "</a></td>\n";
		echo "		<td><a href=\"frm_postor.php?idp=" . $recordSet->fields["idp"] . "&act=2\">" . $recordSet->fields["titulo"] . "</a></td>\n";
//		echo "		<td><a href=\"frm_postor.php?idp=" . $recordSet->fields["idp"] . "&act=3\"><img src=\"imagenes/borrar.png\" alt=\"X\" border=\"0\"></a></td>\n";
		echo "	 </tr>\n";
		$recordSet->MoveNext();
	}
	echo "<table>\n";
}
?>
</div><p>&nbsp;</p>
<a href="frm_postor.php">AGREGAR</a>
<p>&nbsp;</p>
</div>
</body>
</html>
