<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
$dato=$_GET['dato'];
$id=$_GET['id'];
$id_padre=$_GET['id_padre'];


// Si los campos son validos, se procede a actualizar los valores en la DB
mysql_connect("localhost", "content2_root", "content2_pasword");
mysql_select_db("content2");

// Actualizo el campo recibido por GET con la informacion que tambien hemos recibido
$sql="UPDATE entrada SET orden=$dato  WHERE id=$id and id_padre=$id_padre;";
mysql_query($sql) or die(mysql_error());
mysql_close();

// No retorno ninguna respuesta
?>