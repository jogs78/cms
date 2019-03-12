<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}

include('sistema.inc.php');
$sys = new sistema();
if( !$sys->puede($_SESSION['id'] ,ENTRADA, ORDENAR) ) exit; 
$sys->log( $_SESSION['id'] ,ENTRADA ,ORDENAR);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ORDENAR ENTRADAS</title>
<link href="cms.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="ordenar.css">
<script type="text/javascript" src="ordenar.js"></script>
</head>
<body>
<?php
if (isset($_GET["id_padre"])) $id_padre=$_GET["id_padre"];
else $id_padre=1;
echo "<center>LISTAR ENTRADAS </center>";
$debug = false;
$sql="select orden, id, id_padre, titulo, activo, tipo from entrada where id_padre = $id_padre  order by orden;";
//$sql="SELECT entrada.id, entrada.tipo, descripcion , entrada.titulo as titulo, e.titulo as dentro  FROM entrada JOIN tipo ON entrada.tipo = tipo.id JOIN entrada as e ON e.id = entrada.id_padre;";
if($debug) echo $sql;
$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "ENTRADAS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<table align=\"center\" border=\"1\">\n";
	echo "	<tr>\n";
	echo "		<th >#</th>\n";
	echo "		<th >TITULO</th>\n";
	echo "	</tr>\n";
	while (!$recordSet->EOF) {
		$id = $recordSet->fields["id"] ;
		$i1=$i2="";
//		if($recordSet->fields["activo"]==1){ $i1 = "<I>**"; $i2 = "</I>";  }
		echo "	 <tr>\n";
		echo "		<td><span class=\"demodiv\" id=\"_$id\" onclick=\"creaInput(this.id, '$id' , '$id_padre' )\">" . $recordSet->fields["orden"] . "</span></td>\n";
		if($recordSet->fields["tipo"]==1)
		echo "		<td>$i1<a href='ord_entrada.php?id_padre=$id'>" . $recordSet->fields["titulo"] . "</a>$i2</td>\n";
		else
		echo "		<td>$i1" . $recordSet->fields["titulo"] . "$i2</td>\n";
		echo "	 </tr>\n";
		$recordSet->MoveNext();
	}
	echo "<table>\n";
	echo "<div class=\"mensaje\" id=\"error\"></div>\n";
}
?>
<BR>
<BR>
<A HREF="javascript:history.go(-1)">REGRESAR...</A><BR>
</body>
</html>
