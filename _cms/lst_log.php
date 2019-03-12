<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
include('sistema.inc.php');
$sys = new sistema();
//$sys->log( $_SESSION['user'] ,'ENTRADA',"LISTAR","","");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>LISTAR ENTRADA</title>
<link href="cms.css" rel="stylesheet" type="text/css"/>
<link href="tables.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="contenido">
<p>&nbsp;</p>
<h1>BITACORA</h1>
<p>&nbsp;</p>
<div align="center">
<?php
$ord = "d";
$ordb ="e.id";
if(isset($_GET["o"])) $ord = $_GET["o"];
$img[0]="none";
$img[1]="none";
$img[2]="down";
switch($ord){
	case "t":
	$img[0]="down";
	$img[2]="none";
	$ordb ="entrada.tipo";
	break;
	case "i":
	$img[1]="down";
	$img[2]="none";
	$ordb ="entrada.titulo";
	break;
	case "d":
	$ordb ="e.id";
	break;	
}

$debug = false;
//$sys->conn->debug=true;
$sql="SELECT entrada.id, entrada.tipo, descripcion , entrada.titulo as titulo, e.titulo as dentro  FROM entrada JOIN tipo ON entrada.tipo = tipo.id JOIN entrada as e ON e.id = entrada.id_padre ORDER BY $ordb;";
if($debug) echo $sql;

$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "ENTRADAS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<table>\n";
	echo "	<thead>\n<tr>\n";
	echo "		<th ><a href=\"lst_entrada.php?o=t\"><img src=\"imagenes/".$img[0].".png\" border=\"0\"></a> TIPO</th>\n";
	echo "		<th ><a href=\"lst_entrada.php?o=i\"><img src=\"imagenes/".$img[1].".png\" border=\"0\"></a> TITULO</th>\n";
	echo "		<th ><a href=\"lst_entrada.php?o=d\"><img src=\"imagenes/".$img[2].".png\" border=\"0\"></a> DENTRO DE SECCION</th>\n";
	echo "		<th >M</th>\n";
	echo "		<th >E</th>\n";
	echo "	</tr>\n</thead>";
	$i = 1;
	while (!$recordSet->EOF) {
		echo "<tbody>\n";
		if ($i%2 == 0)
		echo "	 <tr class=\"odd\">\n";
		else echo "    <tr>\n";
		echo "		<td>" . $recordSet->fields["descripcion"] . "</td>\n";
		echo "		<td>" . $recordSet->fields["titulo"] . "</td>\n";
		echo "		<td>" . $recordSet->fields["dentro"] . "</td>\n";
		echo "		<td><a href=\"frm_entrada.php?ide=" . $recordSet->fields["id"] . "&act=2\"><img src=\"imagenes/editar.png\" alt=\"E\" border=\"0\"></a></td>\n";
		echo "		<td><a href=\"frm_entrada.php?ide=" . $recordSet->fields["id"] . "&act=3\"><img src=\"imagenes/borrar.png\" alt=\"X\" border=\"0\"></a></td>\n";
		echo "	 </tr>\n</tbody>";
		$i++;
		$recordSet->MoveNext();
	}
	echo "<table>\n";
}
?>
</div>
<p>&nbsp;</p>
<a href="frm_entrada.php">AGREGAR</a>
<p>&nbsp;</p>
</div>
</body>
</html>
