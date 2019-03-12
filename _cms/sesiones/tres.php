<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 5)) {
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
	echo 'session murio!!!<br><a href="uno.php">uno</a>';
var_dump($_SESSION);
	die;
	
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>uno</title>
</head>
<body>
<?php
print_r($_SESSION);
?>
<a href="uno.php">uno</a>
</body>
</html>
<?php
session_destroy();
?>
