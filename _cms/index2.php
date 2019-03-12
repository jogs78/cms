<?php
/*$valid_passwords = array ("web" => "master");
$valid_users = array_keys($valid_passwords);
$user =  isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : "" ;
$pass =  isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : "" ;
$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
  header('WWW-Authenticate: Basic realm="Usuario y contraseña por favor..."');
  header('HTTP/1.0 401 Unauthorized');
  die ("<p><a href=\"../index.php\" ><img src=\"imagenes/salir.jpg\"></a></p>");
}*/
session_start();
?> 
<html>
<head>
<title>Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez</title>
</script>
</head>
 <frameset rows="143,*" frameborder="NO" border="0" framespacing="0">
  <frame src="titulo.html" name="topFrame" scrolling="NO" noresize >
  <frameset  cols="241,*" framespacing="0" frameborder="NO" border="0">
     <frame src="vinculo.php" name="leftFrame" scrolling="NO" noresize>
     <frame src="contenido.php" name="intframe">
   </frameset>
  </frameset>
<noframes><body>
</body></noframes>
</html>
<?php
 ?>
