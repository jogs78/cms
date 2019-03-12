<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 5)) {
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
	echo 'session murio!!!<br><a href="uno.php">uno</a>';
	die;
}
$_SESSION['LAST_ACTIVITY'] = time(); 
$_SESSION["nombre"]="JORGE OCTAVIO";
$_SESSION["password"]="secreto";
var_dump($_SESSION);
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>uno</title>
</head>
<body>
SESION CREADA: <?php echo session_id(); ?> 
<hr>
<a href="dos.php">dos</a>
	
</body>
</html>