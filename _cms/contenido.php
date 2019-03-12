<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Contenido</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<p><strong><?php echo $_SESSION['id'] . ".- " . $_SESSION['nombre'];?></strong>, Bienvenido al CMS del ITTG</p>
</body>
</html>
