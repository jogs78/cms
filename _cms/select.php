<?php
	$sql=$_GET["cadsql"];
	$db="content2";
	$dbsrv="localhost";
	$dbusr="content2_root";
	$dbpwd="content2_password";
	$ret=" ";
//	echo $sql . "<hr>";
	
	$link = mysql_connect($dbsrv, $dbusr, $dbpwd) or die ("PROBLEMAS AL CONEXTAR:" . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	mysql_select_db($db, $link) or die ("PROBLEMAS AL SELECCIONAR: " . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	$result = mysql_query($sql, $link) or die ("PROBLEMAS AL CONSULTAR:" . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	if ($row = mysql_fetch_array($result)){
		do{
			$ret = $ret . $row[0] . "," . utf8_encode($row[1]) . "|" ;
		}while ($row = mysql_fetch_array($result));
	}else{
		$ret = "La base de datos esta vacia !";
	}
	mysql_close($link);
	echo $ret;

?>
