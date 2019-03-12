<?php
//solo necesitaran poner: include('bd.php');
include_once('../extras/adodb496a/adodb.inc.php');
$conn = ADONewConnection('mysql');
$conn->PConnect('localhost','content2_root','content2_password','content2');
?>