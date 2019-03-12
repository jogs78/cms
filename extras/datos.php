<?php
	$d_db="datos";
	$d_dbsrv="localhost";
	$d_dbusr="datos";
	$d_dbpwd="datos";


function catalogo($sql){
	global $d_db, $d_dbsrv, $d_dbusr, $d_dbpwd;
	$ret=" ";
	$link = mysql_connect($d_dbsrv, $d_dbusr, $d_dbpwd) or die ("PROBLEMAS AL CONEXTAR:" . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	mysql_select_db($d_db, $link) or die ("PROBLEMAS AL SELECCIONAR: " . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	$result = mysql_query($sql, $link) or die ("PROBLEMAS AL CONSULTAR:" . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	if ($row = mysql_fetch_array($result)){
		do{
			$ret = $ret . "<option value=\"" . $row["id"] . "\">" . $row["descripcion"] . "</option>\n" ;
		}while ($row = mysql_fetch_array($result));
	}else{
		$ret = "La base de datos esta vacia !";
	}
	mysql_close($link);
	return $ret;
}

function valor($sql){
	global $d_db, $d_dbsrv, $d_dbusr, $d_dbpwd;
	$ret=" ";
	$link = mysql_connect($d_dbsrv, $d_dbusr, $d_dbpwd) or die ("PROBLEMAS AL CONEXTAR:" . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	mysql_select_db($d_db, $link) or die ("PROBLEMAS AL SELECCIONAR: " . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	$result = mysql_query($sql, $link) or die ("PROBLEMAS AL CONSULTAR:" . mysql_error() . " A: " . __FILE__ . " L: " . __LINE__ );
	$row = mysql_fetch_array($result);
	$ret =  $row[0];
	mysql_close($link);
	return $ret;
}

function val($str){
	if (isset($_POST[$str]))
	{
			  return $_POST[$str] ;
	}else return "999";
}


function val2($str){
	if (isset($_POST[$str]))
	{
			  return $_POST[$str] ;
	}else return "";
}

function spost($str){
	if (isset($_POST[$str]))
	{
			  return $_POST[$str] ;
	}else return "";
}
function sget($str){
	if (isset($_GET[$str]))
	{
			  return $_GET[$str] ;
	}else return "";
}

?>
