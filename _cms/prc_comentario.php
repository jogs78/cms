<?php
/**
 * @name Procesar Comenario
 * 
 * @abstract Esta página es utilizada para procesar
 * los comentarios, ya sea eliminarlo o mandarlo  por correo a quien corresponda
 * 
 * @param array $_POST En este arreglo se transmite
 * la información que debe ser procesada.
 * @param int $_POST['ide'] || null Indica el IDE de la noticia que se modifica y/o
 * elimina de la base de datos
 * @param int $_POST['act'] Indica la acción que ha de realazarse
 * 1.- Agregar 2.- Modificar 3.- Eliminar
 * 
 * @uses prc_noticia.php Esta se usa cuando se agrega una noticia nueva
 * @uses prc_noticia.php?ide=10&act=2 Esta se usa cuando ha de modificarse una noticia
 * 
 */
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
/**
 * Llamada a la clases 'sistema.inc.php'
 * y a continuación se crea un objeto de esta
 */
$debug = false;
include('sistema.inc.php');
$sys = new sistema();
$accion=$_POST["act"];
if ($accion!=3)$accion=4;

$cc = $_POST["cc"];
if($cc==-2)$accion=3;
if( !$sys->puede($_SESSION['id'] , COMENTARIO, $accion) ) exit; 
$id = $_POST["ide"];
$t=0;
$e="";
/**
 * Llamada a la clases 'phpmailer'
 * para mandar correos
 */
require "includes/class.phpmailer.php";
$mail = new phpmailer();
$mail->PluginDir = "includes/";
$mail->Mailer = "smtp";
$mail->Host = "148.208.246.4";
$mail->SMTPAuth = false;
$mail->Username = "micuenta@HotPOP.com"; 
$mail->Password = "mipassword";
$mail->From = "webmaster@ittg.edu.mx";
$mail->FromName = "WEBMASTER DEL ITTG";
$mail->Timeout=100;
$mail->SMTPDebug = false; 
$sys->currentid = $id;


if ($accion==3){
	$sql = "DELETE FROM comentario WHERE id = $id;";
	$sys->conn->Execute($sql);
	$sys->log( $_SESSION['id'] ,COMENTARIO,ELIMINAR,$sql);
}else{
	$mcc="";
	$ncc="";
	$titulo = $_POST["titulo"];
	$email = $_POST["email"]; 
	$respuesta = $_POST["respuesta"]; 
	$comentario = $_POST["comentario"];
	$nombre = $_POST["nombre"];
	
	$mail->AddAddress("$nombre<$email>");
	$mail->Subject = "RESPUESTA A: $titulo";
	$t=1000000;
	
	if($cc!=-1){
		//con  cc
		//$sqlc = "SELECT correo FROM correos WHERE id=$cc;";
		$sqlc = "SELECT email AS correo  FROM usuarios WHERE id=$cc;";
		$rsc = $sys->conn->Execute($sqlc);
		$mcc = $rsc->fields["correo"];
		$ncc = $mcc;
		$body_mail = "<strong>INDICADO:</strong>$ncc - $mcc ";
		$mail->AddAddress("$ncc<$mcc>");
	}



	$body_mail .= "<br>$comentario\n<B>>>>>>>>>>>>>></B><br>\n$respuesta";

	if($debug){
		echo "<br>$sqlc ";
		echo "mcc: $mcc, ncc $ncc<br>";
	}
	$msj= "CORREO:<hr>$body_mail<hr>";
	
	
 //	$mail->AddCC ($mcc,$ncc);
	$mail->Body = $body_mail;
	$mail->AltBody = $body_mail;
	$exito = $mail->Send();
	$intentos=1; 
	while ((!$exito) && ($intentos < 3)) {
		sleep(5);
		$e .= "INTENTO: $intentos " . $mail->ErrorInfo . "<br>" ;
		$exito = $mail->Send();
		$intentos=$intentos+1;	
	}

	if(!$exito){
		$e .= "Problemas enviando correo electrónico, intente mas tarde.";
		$e .= "del webmaster a $_POST[email] con copia a: $mcc<br>";
		$e .= "<br>".$mail->ErrorInfo;	
		$e .= "<BR><BR><A HREF=\"javascript:history.go(-1)\">REGRESAR...</A><BR>";
		$msj .= "<br>";
	} else	{
		$msj .= "Mensaje enviado correctamente<br>";
		$t=3000;
		$sql = "DELETE FROM comentario WHERE id = $id;";
        	$sys->conn->Execute( $sql);
	} 
	$sys->log( $_SESSION['id'] ,COMENTARIO,CONTESTAR,$sql);
}
$msj .= "<br>SERA REDIRECCIONADO A LA LISTA DE COMENTARIOS EN SEGUNDOS.... SI NO DE CLICK <A HREF=\"lst_comentario.php\">AQUI </A>"; 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PROCESO  COMENTARIO</title>
<link href="cms.css" rel="stylesheet" type="text/css">
</head>
<body>
<center> <h1>PROCESO COMENTARIO</h1> </center>
<?php echo $e; 
echo "<hr>$msj";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//setTimeout( "document.location='lst_comentario.php'", <?php echo $t ?> );
-->
</SCRIPT>
</body>
</html>
