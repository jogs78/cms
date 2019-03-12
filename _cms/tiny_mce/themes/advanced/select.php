<?php
	$sql=$_GET["cadsql"];
	$db="content";
	$dbsrv="localhost";
	$dbusr="content";
	$dbpwd="content";
	$ret=" ";
	$link = mysql_connect($dbsrv, $dbusr, $dbpwd) or die ("PROBLEMAS AL CONEXTAR:" . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	mysql_select_db($db, $link) or die ("PROBLEMAS AL SELECCIONAR: " . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	$result = mysql_query($sql, $link) or die ("PROBLEMAS AL CONSULTAR:" . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	if ($row = mysql_fetch_array($result)){
		do{
			$ret = $ret . "contenido.php?id=" .$row["id"] . "&libre=1," . $row["descripcion"] . "|" ;
		}while ($row = mysql_fetch_array($result));
	}else{
		$ret = "La base de datos esta vacia !";
	}
	mysql_close($link);
	echo $ret;

?>
