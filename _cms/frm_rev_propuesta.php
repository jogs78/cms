<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
$debug = false;
include('sistema.inc.php');
$sys = new sistema();
$accion=2; //1.- alta, 2.-modificacion

$nota = "";  
if(isset($_GET["ide"])) 	$id=$_GET["ide"]; else $id="";
$sys->currentid = $id;
$sys->log( $_SESSION['user'] ,'PROPUESTA',$accion);
$sql="SELECT * FROM propuesta WHERE idc=$id";
$row = $sys->conn->GetRow($sql);

if (!$row){ 
	echo "PROPUESTA NO DISPONIBLE";
	exit;
}else{
	$nota=$row["nota"];
	//if(isset($row["titulo"])) $titulo = $row["titulo"]; else $titulo="...";
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>FORMULARIO CONTENIDO</title>
<script language="JavaScript" src="../extras/validate.js"></script>
<script language="javascript" type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
	content_css: "tinymce.css",
 //   theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
    theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright, justifyfull,|,bullist,numlist,|,undo,redo,link,unlink,code",
 	theme_advanced_buttons2 : "",
    theme_advanced_buttons3 : "",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_path_location : "bottom",
    extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
}); 
</script>
<link href="cms.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php echo "<center> <h1>PROPUESTA PARA " . $sys->conn->GetValue("SELECT titulo FROM entrada WHERE id = $id") . "</h1> </center>"; ?>
<A href="../contenido.php?id=<?php echo $id ?>" target="_blank" >VISUALIZAR EL ORIGINAL</a><br>
<A href="../contenido.php?p=<?php echo $id ?>" target="_blank" >VISUALIZAR LA PROPUESTA</a><br>
<br>
<form name="frmcontenido" method="post" action="prc_rev_propuesta.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id?>">
<br>
<hr>
NOTA<textarea   name="nota" cols="89" rows="5"><?php echo $nota ?></textarea><BR>
<br/>
ESTA PROPUESTA SE:<br/>
<input type="radio" name="debe" value="autorizar" />AUTORIZA<br/>
<input type="radio" name="debe" value="corregir" checked="checked" />DEBE CORREGIR <br/>

<input type="submit" value="PROCESAR">
</form>
</body>
</html>
