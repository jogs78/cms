<?php
session_start(); 
// $_SESSION['INCMS']="ON";
// var_dump($_SESSION);
// echo "::::";
 include 'auth.php';
// echo ":dd:";
$login = new Auth();
 // echo $login->getRedir();
 // exit;
if ( isset ($_SESSION['INCMS'])){
	Header("Location: ".$login->getRedir());
} else {
	// echo "formulario";
	$login ->setRedir("http://www.google.com.mx");
	$login -> autentificar();
} 	
?>
