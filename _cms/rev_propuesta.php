<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}

include('sistema.inc.php');
$sys = new sistema();
$sys->log( $_SESSION['id'] , PROPUESTA , LISTAR );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>REVISAR PROPUESTAS</title>
<link href="cms.css" rel="stylesheet" type="text/css"/>
<link href="tables.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="contenido">
<p>&nbsp;</p>
<h1>REVISAR PROPUESTAS</h1>
<p>&nbsp;</p>
<div align="center">
<?php
//$sys->conn->debug=true;
/*
CREATE VIEW ponencias AS
SELECT ep.titulo donde, nombre, modificado, r.idc, e.titulo FROM ( (entrada e JOIN propuesta p ON e.id = p.idc) JOIN propuesta_usuario r ON r.idc = p.idc) JOINusuarios u ON u.id = r.idu JOIN entrada ep on e.id_padre = ep.id;   
*/
$sql = "SELECT * FROM ponencias;";

$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "ENTRADAS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<table align=\"center\">\n";
	echo "	<thead>\n<tr>\n";
	echo "		<TD>DONDE ESTA:</TD>\n";
	echo "		<TD>TITULO</TD>\n";
	echo "	</tr>\n</thead>\n";
	$i = 1;
	while (!$recordSet->EOF) {
		if($recordSet->fields["modificado"]==1) $img = '<img src="../img/nuevorojo.gif" alt="nuevo">'; 
		else $img = "";
		echo "<tbody>\n";
		if ($i%2 == 0)	echo "	 <tr class=\"odd\">\n";
		else echo "    <tr>\n";
		echo "		<td>" . $recordSet->fields["donde"] . "</td>\n";
		echo "<td>$img<a title=\"" . $recordSet->fields["nombre"] . "\" href=\"frm_rev_propuesta.php?ide=" . $recordSet->fields["idc"] . "\">" .  $recordSet->fields["titulo"] . "</a></td>\n";
		echo "	 </tr>\n</tbody>\n";
		$i++;
		$recordSet->MoveNext();
	}
	echo "<table>\n";
}
?>
</div>
</div>
</body>
</html>
