<?php
/**
 * @name Formulario de comentarios
 * @author Ing. Jorge Octavio Gúzman Sánchez
 * @package _cms
 * @version 2.0.1
 * 
 * @abstract Esta página es utilizada para leer los comentarios 
 *dejados en la pagina
 * 
 * @param int $_GET['ide'] Ide del comentario
 * @param int $_GET['act'] Acción a realizar  4 -> Contestar, 3 -> Eliminar 
 * @param null cuando esta página no recibe ningun parametro se sale
 */
session_start();
/**
 * Aquí se verifica que se haya iniciado una session de administración
 */
if (!isset($_SESSION["INCMS"])){
	exit;
}
/**
 * Se crea el objeto $sys para grabar un log de actividad
 */
include('sistema.inc.php');
$sys = new sistema();
if(isset($_GET["act"]) ){	$accion=$_GET["act"]; }else{ 	$accion=4; }//4.- contestar o 3.- eliminar
if( !$sys->puede($_SESSION['id'], COMENTARIO, VER) ) exit;
if(!isset($_GET["ide"])){ echo "SIN COMENTARIOS"; exit;}
else $id=$_GET["ide"];
if($accion !=1 ){
	$sql="SELECT * FROM comentario WHERE id=$id";
	$row = $sys->conn->GetRow($sql);
	if (!$row){ 
		echo "COMENTARIOS NO DISPONIBLES";
		exit;
	}else{
		$titulo=$row["titulo"];
		$comentario =$row["comentario"]; 
		$email=$row["email"];
		$nombre=$row["nombre"];
		$fecha=$row["fecha"];
	}	
}
$sys->currentid = $id;
if ($accion!=1) $sys->log( $_SESSION['id'] , COMENTARIO , VER );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>FORMULARIO COMENTARIOS</title>
<script language="JavaScript" src="../extras/validate.js"></script>
<link href="cms.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../extras/calendar_files/spiffyCal.css">
<script language="JavaScript" src="../extras/calendar_files/spiffyCal.js"></script>
<script language="javascript">
	var cal1=new ctlSpiffyCalendarBox("cal1", "frmconmentario", "fecha","btnDate1","<?php echo $fecha ?>", 0, "yyyy-M-dd");
//	var cal1=new ctlSpiffyCalendarBox("cal1", "frmanuncio", "fecha","btnDate1","<?php echo $fecha ?>");
</script>
<script language="javascript" type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	content_css: "tinymce.css",
	
	plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",

	// Theme options
	//theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
//	theme_advanced_buttons2 : "paste  ,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons2 : "cut,copy,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,cleanup,code,|,preview,|,forecolor,backcolor",
//	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,advhr,|,ltr,rtl,|,fullscreen",
	//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops|,cite,abbr,acronym,del,ins,attribs",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,

	// Example content CSS (should be your site CSS)
	//content_css : "css/example.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "js/template_list.js",
	external_link_list_url : "js/link_list.js",
	external_image_list_url : "js/image_list.js",
	media_external_list_url : "js/media_list.js",

	// Replace values for the template plugin
	template_replace_values : {
		username : "Some User",
		staffid : "991234"
	}
});
</script>
<div id="spiffycalendar" class="text"></div>
</head>
<body>
<?php 
switch ($accion){
	case 4: $cap="CONTESTAR";  break;
	case 3: $cap= "ELIMINAR ";  break;
}
echo "<center> <h1>$cap COMENTARIO </h1> </center>";
$msg = "<strong>DATOS DEL COMENTARIO:</strong><br>";
$msg .= "<strong>MAIL:</strong>$email<br>";
$msg .= "<strong>NOMBRE:</strong>$nombre<br>";
$msg .= "<strong>COMENTARIO:</strong>$comentario<br>";
$msg .= "<strong>FECHA:</strong>$fecha<br>";
?>
<form name="frmconmentario" method="post" action="prc_comentario.php" enctype="multipart/form-data">
<input type="hidden" name="act" value="<?php echo $accion ?>">
<input type="hidden" name="ide" value="<?php echo $id ?>">
<input type="hidden" name="nombre" value="<?php echo $nombre ?>">
<input type="hidden" name="email" value="<?php echo $email ?>">
<input type="hidden" name="titulo" value="<?php echo $titulo ?>">
<input type="hidden" name="comentario" value="<?php echo $msg ?>">
<strong>TITULO:</strong> <?php echo $titulo ?><BR>
<strong>COMENTARIO:</strong> <?php echo $comentario ?><BR>
<strong>QUIEN LO ENVIA:</strong> <?php echo $nombre ?><BR>
<strong>FECHA:</strong> <?php echo $fecha ?><BR>
<strong>CORREO:</strong> <?php echo $email ?><BR>
<?php 
if($accion !=3 ){
	echo '<strong>COPIA A :</strong><select hidden  name="cc" >';
//		$cat = "SELECT id, CONCAT(cargo , ' - ' , nombre ) as descripcion  FROM correos;";
$cat = "SELECT u.id, CONCAT(d.nombre, ' - ', u.nombre ) FROM usuarios u JOIN departamento d ON u.depto = d.id ORDER BY d.nombre;";
	echo '<option value="-1">SIN COPIA PARA</option>';
	echo '<option value="-2">ELIMINAR COMENTARIO</option>';
	echo $sys->conn->catalogo2($cat); 
	}
?>
</select><BR>
<?php
if ($accion==2 || $accion==4) echo "RESPUESTA<textarea  name=\"respuesta\" cols=\"89\" rows=\"20\">GRACIAS POR EL COMENTARIO, SERA TURNADO A LA PERSONA INDICADA.</textarea><BR>";
?>
<input type="submit" value="<?php echo $cap ?>">
</form>
</body>
</html>
<!-- 

-->
