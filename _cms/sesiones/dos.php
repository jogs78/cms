<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 5)) {
    session_unset();     
    session_destroy();  
	echo 'session murio!!!<br><a href="uno.php">uno</a>';
	die;
}
var_dump($_SESSION);
$nombre = $_SESSION["nombre"];
$password = $_SESSION["password"];
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>uno</title>
</head>
<body>
<?php echo $nombre . " " . $password . "<br>"; ?>
<a href="tres.php">tres</a>
	
</body>
</html>