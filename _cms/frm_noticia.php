<?php
/**
 * @name Formulario de Noticias
 * @author Ing. Jorge Octavio Gúzman Sánchez
 * @package _cms
 * @version 2.0.1
 * 
 * @abstract Esta página es utilizada para dar de alta,
 *modificar o eliminar una noticia de la
 * base de datos.
 * 
 * @param int $_GET['ide'] Ide de la noticia
 * @param int $_GET['act'] Acción a realizar  2 -> Modificar, 3 -> Eliminar 
 * @param null cuando esta página no recibe ningun parametro entra en el modo
 * de Agregar Nueva noticia.
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
if(isset($_GET["act"]) ){	$accion=$_GET["act"]; }else 	$accion=1; //1.- alta, 2.-modificacion }
if($accion!=1) if( !$sys->puede($_SESSION['id'] ,NOTICIA, VER) ) exit; 
$titulo=""; $p01 = ""; 
$img1 = ""; $img2 = ""; $img3 = ""; $img4 = ""; $img5 = ""; $img6 = ""; $img7 = ""; $img8 = ""; $img9 = "";
$doc1 = ""; $doc2 = ""; $doc3 = ""; $doc4 = ""; 
$ima1 = ""; $ima2 = ""; $ima3 = ""; $ima4 = ""; $nuevo=2; 
$fecha = date("Y-m-d"); 
if(isset($_GET["ide"])){ 	$id=$_GET["ide"]; }else{ 	$id=""; }
/**
 * Desabilitamos todos los campos si la opción elegida es Eliminar
 */
if ( $accion == 3 ) $dis = " disabled "; else $dis =""; 
if( $accion !=1 ){
	if(!$id) exit;
	if($accion == 4 ) 	$sql="SELECT * FROM anuncio WHERE id=$id";
	else 	$sql="SELECT * FROM noticia WHERE id=$id";
	$row = $sys->conn->GetRow($sql);
	if (!$row){ 
		echo "NOTICIAS NO DISPONIBLES";
		exit;
	}else{
		$titulo=$row["titulo"]; $p01=$row["p01"]; 
		$img1=$row["img1"]; $img2=$row["img2"]; $img3=$row["img3"]; $img4=$row["img4"]; $img5=$row["img5"];
		$img6=$row["img6"]; $img7=$row["img7"]; $img8=$row["img8"]; $img9=$row["img9"]; 
		$doc1=$row["doc1"]; $doc2=$row["doc2"]; $doc3=$row["doc3"]; $doc4=$row["doc4"]; 
		$ima1=$row["ima1"]; $ima2=$row["ima2"]; $ima3=$row["ima3"]; $ima4=$row["ima4"]; 
		$fecha=$row["fecha"];
	}	
}
$sys->currentid = $id;
if ($accion!=1) $sys->log( $_SESSION['id'] , NOTICIA , VER );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>FORMULARIO NOTICIA</title>
<script type="text/javascript" language="javascript" src="../extras/validate.js"></script>
<link href="cms.css" rel="stylesheet" type="text/css" />

<style  type="text/css">@import url(../extras/jscalendar-1.0/calendar-ittg.css);</style>
<script type="text/javascript" src="../extras/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="../extras/jscalendar-1.0/lang/calendar-es.js"></script>
<script type="text/javascript" src="../extras/jscalendar-1.0/calendar-setup.js"></script>

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
</head>
<body>
<?php 
switch ($accion){
	case 1: $cap= "AGREGAR";	break;
	case 2: $cap= "MODIFICAR";	break;
	case 3: $cap= "ELIMINAR";	break;
	case 4: $cap= "CAMBIAR A";	$accion =1;  break;
}
echo "<h1>$cap NOTICIA</h1>";
?>
<form name="frmnoticia" method="post" action="prc_noticia.php" enctype="multipart/form-data">
<input type="hidden" name="act" value="<?php echo $accion ?>"/>
<?php
	echo "<input type=\"hidden\" name=\"ide\" value=\"$id\" />";
?>
TITULO: <input <?php echo $dis ?>  type="text" name="titulo" value="<?php echo $titulo ?>" size="75" maxlength="70" /> <br />
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_d1]');return false;">[DOC. 1]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_d2]');return false;">[DOC. 2]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_d3]');return false;">[DOC. 3]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_d4]');return false;">[DOC. 4]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_i1]');return false;">[IMG. 1]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_i2]');return false;">[IMG. 2]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_i3]');return false;">[IMG. 3]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_i4]');return false;">[IMG. 4]</a><br />

PARRAFO 01<textarea <?php echo $dis ?> name="p01" class="p01" cols="89" rows="20"><?php echo $p01 ?></textarea><br />
IMAGENES DE LA SECCION DE FOTOS:<br />
IMAGEN  1 <?php echo "(".$img1.")" ?> <input <?php echo $dis ?> type="file" name="img1" /><br />
IMAGEN  2 <?php echo "(".$img2.")" ?> <input <?php echo $dis ?> type="file" name="img2" /><br />
IMAGEN  3 <?php echo "(".$img3.")" ?> <input <?php echo $dis ?> type="file" name="img3" /><br />
IMAGEN  4 <?php echo "(".$img4.")" ?> <input <?php echo $dis ?> type="file" name="img4" /><br />
IMAGEN  5 <?php echo "(".$img5.")" ?> <input <?php echo $dis ?> type="file" name="img5" /><br />
IMAGEN  6 <?php echo "(".$img6.")" ?> <input <?php echo $dis ?> type="file" name="img6" /><br />
IMAGEN  7 <?php echo "(".$img7.")" ?> <input <?php echo $dis ?> type="file" name="img7" /><br />
IMAGEN  8 <?php echo "(".$img8.")" ?> <input <?php echo $dis ?> type="file" name="img8" /><br />
IMAGEN  9 <?php echo "(".$img9.")" ?> <input <?php echo $dis ?> type="file" name="img9" /><br />
DOCUMENTOS DEL CONTENIDO:<br />
DOCUMENTO  1 <?php echo "(".$doc1.")" ?> <input <?php echo $dis ?> type="file" name="doc1" /><br />
DOCUMENTO  2 <?php echo "(".$doc2.")" ?> <input <?php echo $dis ?> type="file" name="doc2" /><br />
DOCUMENTO  3 <?php echo "(".$doc3.")" ?> <input <?php echo $dis ?> type="file" name="doc3" /><br />
DOCUMENTO  4 <?php echo "(".$doc4.")" ?> <input <?php echo $dis ?> type="file" name="doc4" /><br />
IMAGENES  DEL CONTENIDO:<br />
IMAGEN  1 <?php echo "(".$ima1.")" ?> <input <?php echo $dis ?> type="file" name="ima1" /><br />
IMAGEN  2 <?php echo "(".$ima2.")" ?> <input <?php echo $dis ?> type="file" name="ima2" /><br />
IMAGEN  3 <?php echo "(".$ima3.")" ?> <input <?php echo $dis ?> type="file" name="ima3" /><br />
IMAGEN  4 <?php echo "(".$ima4.")" ?> <input <?php echo $dis ?> type="file" name="ima4" /><br />
FECHA ENTRA EN VIGENCIA<font color="#FF0000">*</font> 
   <input type="text"   id="data3" name="fecha" value="<?php echo $fecha ?>" />
<script type="text/javascript">
Calendar.setup(
    {
      inputField  : "data3",         // ID of the input field
      ifFormat    : "%Y-%m-%d",    // the date format
 	  weekNumbers : false,
	  singleClick : false,
	  range       : [2000,2015],
	  eventName   : "focus",
	  step        :  1
    }
  );
</script>
<br />
<br />
<input type="submit" value="<?php echo $cap ?>" />
</form>
</body>
</html>