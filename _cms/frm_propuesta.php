<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
$debug = false;
include('sistema.inc.php');
$sys = new sistema();
$accion=2; //1.- alta, 2.-modificacion

$p01 = "";  $img1 = ""; $img2 = ""; $img3 = ""; $img4 = ""; $img5 = ""; $img6 = ""; $img7 = ""; $img8 = ""; $img9 = "";
$doc1 = ""; $doc2 = ""; $doc3 = ""; $doc4 = ""; $ima1 = ""; $ima2 = ""; $ima3 = ""; $ima4 = ""; $nota = "";  
$fecha = date("Y-m-d"); //$fecha = date("d/m/Y");
$titulo="";
if(isset($_GET["ide"])) 	$id=$_GET["ide"]; else $id="";
$sys->currentid = $id;
$sys->log( $_SESSION['user'] ,'PROPUESTA',$accion);
$sql="SELECT * FROM propuesta WHERE idc=$id";
$row = $sys->conn->GetRow($sql);
if (!$row){ 
	echo "CONTENIDO NO DISPONIBLE";
	exit;
}else{
	$p01=$row["p01"]; 
	$img1=$row["img1"]; $img2=$row["img2"]; $img3=$row["img3"]; $img4=$row["img4"]; $img5=$row["img5"];
	$img6=$row["img6"]; $img7=$row["img7"]; $img8=$row["img8"]; $img9=$row["img9"]; 
	$doc1=$row["doc1"]; $doc2=$row["doc2"]; $doc3=$row["doc3"]; $doc4=$row["doc4"]; 
	$ima1=$row["ima1"]; $ima2=$row["ima2"]; $ima3=$row["ima3"]; $ima4=$row["ima4"];  $nota=$row["nota"];
	//if(isset($row["titulo"])) $titulo = $row["titulo"]; else $titulo="...";
}
$dis = "";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>FORMULARIO CONTENIDO</title>
<script language="JavaScript" src="../extras/validate.js"></script>
<link href="cms.css" rel="stylesheet" type="text/css">
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
<?php echo "<center> <h1>PROPUESTA PARA " . $sys->conn->GetValue("SELECT titulo FROM entrada WHERE id = $id") . "</h1> </center>"; ?>
<A href="../contenido.php?id=<?php echo $id ?>" target="_blank" >VISUALIZAR EL ORIGINAL<br>
<A href="../contenido.php?p=<?php echo $id ?>" target="_blank" >VISUALIZAR LA PROPUESTA<br>
<br>

<form name="frmcontenido" method="post" action="prc_propuesta.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id?>">
<br>
<br>
<br>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_d1]');return false;">[DOC. 1]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_d2]');return false;">[DOC. 2]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_d3]');return false;">[DOC. 3]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_d4]');return false;">[DOC. 4]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_i1]');return false;">[IMG. 1]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_i2]');return false;">[IMG. 2]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_i3]');return false;">[IMG. 3]</a>
<a href="#" onclick="tinyMCE.execCommand('mceInsertContent',false,'[_i4]');return false;">[IMG. 4]</a><br>
PARRAFO 01<textarea <?php echo $dis ?> name="p01" cols="89" rows="20"><?php echo $p01 ?></textarea><BR>
IMAGENES DE LA SECCION DE FOTOS:<BR>
IMAGEN  1 <?php echo "(".$img1.")" ?> <input <?php echo $dis ?> type="file" name="img1"><BR>
IMAGEN  2 <?php echo "(".$img2.")" ?> <input <?php echo $dis ?> type="file" name="img2"><BR>
IMAGEN  3 <?php echo "(".$img3.")" ?> <input <?php echo $dis ?> type="file" name="img3"><BR>
IMAGEN  4 <?php echo "(".$img4.")" ?> <input <?php echo $dis ?> type="file" name="img4"><BR>
IMAGEN  5 <?php echo "(".$img5.")" ?> <input <?php echo $dis ?> type="file" name="img5"><BR>
IMAGEN  6 <?php echo "(".$img6.")" ?> <input <?php echo $dis ?> type="file" name="img6"><BR>
IMAGEN  7 <?php echo "(".$img7.")" ?> <input <?php echo $dis ?> type="file" name="img7"><BR>
IMAGEN  8 <?php echo "(".$img8.")" ?> <input <?php echo $dis ?> type="file" name="img8"><BR>
IMAGEN  9 <?php echo "(".$img9.")" ?> <input <?php echo $dis ?> type="file" name="img9"><BR>
DOCUMENTOS DEL CONTENIDO:<BR>
DOCUMENTO  1 <?php echo "(".$doc1.")" ?> <input <?php echo $dis ?> type="file" name="doc1"><BR>
DOCUMENTO  2 <?php echo "(".$doc2.")" ?> <input <?php echo $dis ?> type="file" name="doc2"><BR>
DOCUMENTO  3 <?php echo "(".$doc3.")" ?> <input <?php echo $dis ?> type="file" name="doc3"><BR>
DOCUMENTO  4 <?php echo "(".$doc4.")" ?> <input <?php echo $dis ?> type="file" name="doc4"><BR>
IMAGENES  DEL CONTENIDO:<BR>
IMAGEN  1 <?php echo "(".$ima1.")" ?> <input <?php echo $dis ?> type="file" name="ima1"><BR>
IMAGEN  2 <?php echo "(".$ima2.")" ?> <input <?php echo $dis ?> type="file" name="ima2"><BR>
IMAGEN  3 <?php echo "(".$ima3.")" ?> <input <?php echo $dis ?> type="file" name="ima3"><BR>
IMAGEN  4 <?php echo "(".$ima4.")" ?> <input <?php echo $dis ?> type="file" name="ima4"><BR>
<hr>
NOTA<textarea <?php echo $dis ?> name="nota" cols="89" rows="5"><?php echo $nota ?></textarea><BR>
<BR>
<input type="submit" value="ACTUALIZAR">
</form>
</body>
</html>
