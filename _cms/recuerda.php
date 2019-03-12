<?php
$msg = "";
include('sistema.inc.php');
$sys = new sistema("datos");
if (isset($_POST["usuario"])){
	$sql = "SELECT * FROM usuarios WHERE usuario = '" .  $_POST["usuario"] . "';";
	$rs = $sys->conn->Execute($sql);
	if (!$rs){
		$msg = $this->conn->ErrorMsg() ;
	}elseif($rs->RecordCount()==0){
		header("Location: index.php");
	}else{	
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
		$id = $rs->fields['id'];
		$nombre = $rs->fields['nombre'];
		$usuario = $rs->fields['usuario'];
		$pass = $rs->fields['pass'];
		$email = $rs->fields['email'];
		$mail->AddAddress("$nombre<$email>");
		$mail->Subject = "RECORDATORIO DE CONTRASEÑA EN CMS"; 
		$mail->AddAddress("RECORDATORIO DE CONTRASEÑA<computo@ittg.edu.mx>");
		$body_mail = "$usuario ($nombre) tu contraseña en el cms es '$pass', por favor cambiala lo mas pronto posible en la opcion CAMBIAR dentro de USUARIOS.";
		$mail->Body = $body_mail;
		$mail->AltBody = $body_mail;
		$exito = $mail->Send();
		$intentos=1; 
		while ((!$exito) && ($intentos < 3)) {
			sleep(5);
			$msg .= "INTENTO: $intentos " . $mail->ErrorInfo . "<br>" ;
			$exito = $mail->Send();
			$intentos=$intentos+1;	
		}
		if(!$exito){
			$msg .= "Problemas enviando correo electrónico, intente mas tarde.";
			$msg .= "<br>".$mail->ErrorInfo;	
			$msg .= "<BR><BR><A HREF=\"javascript:history.go(-1)\">REGRESAR...</A><BR>";
			$msj .= "<br>";
		} else	{
			$msj .= "Se ha enviado por correo electronico ( a la cuenta $email) la contraseña";
			$msj .= "<br><A HREF=\"index.php\">REGRESAR...</A><BR>";
		} 
	echo $msj;
	}
}
//$sys->log($id ,USUARIO, RECORDAR, "", "");
?>
