<?php
session_start();
if (!isset($_SESSION["INCMS"])){
        exit;
}
include('sistema.inc.php');
$sys = new sistema();
//$sys->conn->debug=true;
if(isset($_GET["id"])) $id=$_GET["id"]; else $id="1";


$sql="SELECT * FROM usuarios WHERE id=$id";
$row = $sys->conn->GetRow($sql);
if (!$row){
        echo "USUARIO NO DISPONIBLE";
        exit;
}else{
        $login = $row["usuario"];
        $nombre=$row["nombre"];
        $email=$row["email"];
}
$cap="AGREGAR";


$sys->currentid = $id;
//$sys->log( $_SESSION['id'] , USUARIO, PERMITIR);
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
<style type="text/css">
<!--
li {
        list-style-type:none;
        color:#22466A;
        font-family:Verdana,Arial,Helvetica,sans-serif;
        font-size:12px;

}

-->
</style>


<body>
<?php
echo "<center> <h1>$cap USUARIO </h1> </center>"; ?>
<form name="frmusuario" method="post" action="prc_per_usuario.php"  >
  <p>
  <input type="hidden" name="act" value="<?php echo $accion ?>">
  <input type="hidden" name="id" value="<?php echo $id?>">
  </p>
  <p>&nbsp;</p>
  <p>Login (Usuario) : <?php echo $login ?></p>
  <p>&nbsp;</p>
  <p>Nombre (Usuario) : <?php echo $nombre ?></p>
  <p>&nbsp;</p>
  <p>Email: <?php echo $email ?></p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <?php
  $rso = $sys->conn->Execute("SELECT * FROM objeto WHERE sec < 100 ORDER BY sec;");
  while(!$rso->EOF){
        echo "<p>" . $rso->fields["descripcion"] . "<BR> <UL>";
        $obj = $rso->fields["id"] ;
        $sql = "SELECT permisos2.*, IF(IFNULL(permisos.usuario, 0) >=1,'checked=\"checked\"', '') AS edo , permisos2.objeto FROM permisos2 LEFT JOIN permisos ";
        $sql .= "ON permisos.objeto = permisos2.objeto AND permisos.accion = permisos2.id AND permisos.usuario = $id WHERE permisos2.objeto = $obj ";
        $sql .= "ORDER BY permisos2.id; ";
        $rsa = $sys->conn->Execute($sql);
        while(!$rsa->EOF){
                $acc = $rsa->fields["id"] ;
                $_e = $rsa->fields["edo"] ;
                echo "      <input type=\"checkbox\" name=\"permiso[$obj.$acc]\"  $_e/> " ;
                echo $rsa->fields["descripcion"] . " ";
                $rsa->MoveNext();
          }
        echo "</UL></p>";
          $rso->MoveNext();
  }
  ?>
  <p><input type="submit" value="ASIGNAR"></p>
</form>
</body>
</html>

