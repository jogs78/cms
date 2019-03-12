<?php
	/*
CREATE USER 'reins'@'localhost' IDENTIFIED BY 'reins';
GRANT USAGE ON * . * TO 'reins'@'localhost' IDENTIFIED BY '*****' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;
CREATE DATABASE IF NOT EXISTS `reins` ;
GRANT ALL PRIVILEGES ON `reins` . * TO 'reins'@'localhost';
	*/
	$urls = array ("http://148.208.246.128/","http://148.208.246.129/","http://148.208.246.130/","http://148.208.246.131/","http://148.208.246.132/","http://148.208.246.133/");
	$control=$_POST["control"];
	$server = 'localhost';
	$user_db = 'reins';
	$password = 'reins';
	$data_base = 'reins';
	$error1 = "<h1><samp style='color:#990000'>No se pudo hacer la conexion</samp></h1>";
	$error2 = "<h1><samp style='color:#990000'>No se pudo conectar con la base de datos</samp></h1>";
	$hora_servidor = date("Gi",time());
	$error = 0;
	$debug = false;
	
	if( !is_numeric($control) ) {
		if($debug) echo "<HR>El n&uacute;mero de control no es un numerico.<HR>";
		else header("Location: index.php?error=1");
		return;
	}

	
	$conexion =@mysql_connect($server, $user_db, $password);// or die($error1);
if($conexion == false){
                                header("Location: http://pruebas.ittg.edu.mx/");
                                die("");
                        }

	$select = @mysql_select_db($data_base,$conexion) or die($error2);
	$sql = "SELECT * FROM  alumno  where aluctr = '$control' ; ";
	$result = mysql_query($sql , $conexion);
	$total = mysql_num_rows($result); 
    if ($total == 0){
		if($debug) echo "<HR>El alumno no se encuentra, revise el n&uacute;mero de control.<HR>";
		else header("Location: index.php?error=2");
		return;
	}

	$alumno = mysql_fetch_assoc($result);
	$last = $alumno["last"];
	$hora = $alumno["hora"];
	//$bloq = $alumno["bloqueado"];

/*
	if($last == ""){
		// case 4: 	echo "<HR>El alumno no actualizo sus datos.<HR>"; break;		
			//$error = 4;
			header("Location: index.php?error=4");
			return;
	}
*/
	
	if($hora > $hora_servidor ) {
		if($debug) echo "<HR>No es la hora de reinscripci&oacute;n del alumno. Su $hora y la de $hora_servidor.<HR>";
		else header("Location: index.php?error=3");
		return;	
	}else{
		if($debug) echo "<HR>Su $hora y la de $hora_servidor.<HR>";
	}

/*
	if($bloq != 0 ) {
		//$error = 5;
	// case 5: 	echo "<HR>Este alumno se encuentra bloqueado seguramente por adeudo de material.<HR>"; break;
		header("Location: index.php?error=5");
	}
*/	
	$sql = "select * from visitas;";
	$result2 = mysql_query($sql , $conexion);
	$visit   = mysql_fetch_assoc($result2);
	$cuantos = $visit["cuantos"];	
	$cuantos++;
	$sql = "UPDATE visitas SET cuantos = cuantos + 1 ;";
	$result2 = mysql_query($sql , $conexion);
	$url = $cuantos % 2;
	if($debug) echo "<HR>IR A " . $urls[$url] . ".<HR>";
	else 	header("Location: " . $urls[$url]  ) ; 
	return;

	//echo '$url = $cuantos % 2;' . "$url = $cuantos % 2;" . "= $url";

?>




 
