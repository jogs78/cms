<?php
include('sistema.inc.php');
$sys = new sistema();
session_start();
//$sys->log( $_SESSION['user'] ,'SISTEMA','SALIDA');
$_SESSION = array();
$PHPSESSID = null;
session_unset();
session_destroy();
//header("Location: about:blanck");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
 parent.location='index.php';
-->
</SCRIPT>