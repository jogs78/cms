<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
include('sistema.inc.php');
$sys = new sistema();
if(isset($_GET["act"]) ) $accion=$_GET["act"]; else $accion=1; //1.- alta, 2.-modificacion
if(isset($_GET["id"])) $id=$_GET["id"]; else $id="1";

		$login = "";
		$nombre=""; 
		$email=""; 

		
if($accion ==2 || $accion ==3 ){
	$sql="SELECT * FROM usuarios WHERE id=$id";
	$row = $sys->conn->GetRow($sql);
	if (!$row){ 
		echo "USUARIO NO DISPONIBLE";
		exit;
	}else{
		$login = $row["usuario"];
		$nombre=$row["nombre"]; 
		$email=$row["email"]; 
		$depto=$row["depto"]; 
	}

}
if ($accion==3) $dis = " disabled "; else $dis ="";

switch ($accion){
	case 1: $cap="AGREGAR";  break;
	case 2: $cap="MODIFICAR ";  break;
	case 3: $cap= "ELIMINAR ";  break;
}
//echo "<br>|  | idg:$id | img:$igm           | titulo:$titulo   | tipo:$tipo | id:$ida | fecha:$fecha |accion:$accion|||";
$sys->currentid = $id;
$sys->log( $_SESSION['id'] ,USUARIO ,$accion);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>FORMULARIO USUARIOS</title>
<link href="cms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function validar(form){

if (form.pass1.value != form.pass2.value){ 
	alert ('LAS CONTRASEÑAS NO COINCIDEN'); 
	return false;
}

return true;
}
-->
</script> 
</head>
<body>
<?php 
echo "<center> <h1>$cap USUARIO </h1> </center>"; ?>
<form name="frmusuario" method="post" action="prc_usuario.php" onsubmit="return validar(this);" >
  <p>
  <input type="hidden" name="act" value="<?php echo $accion ?>">
  <input type="hidden" name="id" value="<?php echo $id?>">
  </p>
  <p>&nbsp;</p>
  <p>Login (Usuario) : 
   <input name="login" <?php if($accion==2) echo "disabled ";  echo $dis  ?> type="text" value="<?php echo $login ?>" size="16" maxlength="15">
  </p>
  <p>&nbsp;</p>
  <p>Nombre (Usuario) : 
   <input name="nombre" type="text"  $dis value="<?php echo $nombre ?>" size="51" maxlength="50">
  </p>
  <p>&nbsp;</p>
  <p>Email: 
   <input name="email" type="text"  $dis value="<?php echo $email ?>" size="51" maxlength="50">
  </p>
  <p>&nbsp;</p>
  <p>Contrase&ntilde;a: 
    <input name="pass1" type="password" $dis maxlength="20">
  </p>
  <p>&nbsp;</p>
  <p>Retir contrase&ntilde;a: 
    <input name="pass2" type="password" $dis maxlength="20" >
  </p>
  <p>&nbsp;</p>
Departamento: <SELECT  NAME="depto">  
<?php echo $sys->conn->catalogo2("SELECT id, nombre from  departamento;"); ?> 
</SELECT>  
<script language="JavaScript" type="text/JavaScript"> document.frmusuario.depto.value = '<?php echo $depto ?>';  </script> 
  <p>&nbsp;</p>
  <input type="submit" value="<?php echo $cap ?>">
</p>
</form>
</body>
</html>
