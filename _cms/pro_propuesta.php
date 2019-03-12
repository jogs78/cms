<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}else{
$uid=$_SESSION["id"];
}

include('sistema.inc.php');
$sys = new sistema();
$sys->log( $_SESSION['id'] , PROPUESTA , LISTAR );
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
<h1>LISTAR CONTENIDOS PARA PROPONER</h1>
<p>&nbsp;</p>
<div align="center">
<?php
//$sys->conn->debug=true;
$sql.="SELECT * FROM ponencias WHERE uid = $uid ;";
$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "ENTRADAS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<table align=\"center\">\n";
	echo "	<thead>\n<tr>\n";
	echo "		<th >DONDE ESTA: </th>\n";
	echo "		<th >TITULO</th>\n";
	echo "	</tr>\n</thead>\n";
	$i = 1;
	while (!$recordSet->EOF) {
		echo "<tbody>\n";
		if($recordSet->fields["modificado"]==1) $img = '<img src="../img/nuevorojo.gif" alt="nuevo">'; 
		else $img="";
		if ($i%2 == 0) echo "	 <tr class=\"odd\">\n";
		else echo "    <tr>\n";
		echo "		<td>" . $recordSet->fields["donde"] . "</td>\n";
		echo "		<td><a title=\"" . $recordSet->fields["nombre"] . "\" href=\"frm_propuesta.php?ide=" . $recordSet->fields["idc"] . "\">" .  $recordSet->fields["titulo"] . "</a></td>\n";
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
