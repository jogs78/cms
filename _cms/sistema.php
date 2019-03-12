<?php
session_start();
// if (!isset($_SESSION["INCMS"]) ){
	// Header("Location: index.php");
// }
include('sistema.inc.php');
$sys = new sistema();
if (isset($_SESSION["id"])){
	$_id = $_SESSION["id"] ;
}else $_id = 0;

var_dump($_SESSION);

$sys->quien( $_id);
if(isset($_GET["obj"]) ) $sys->SetObjeto($_GET["obj"]); 
if(isset($_GET["act"]) ) $sys->SetAccion($_GET["act"]); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="verify-v1" content="eUNxbLhX3VyL13zQwxiWeS4K54dXzLMl5rlXMWUS09g=" />
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<meta name="Language" content="Espanol"/>
<META name="robots" content="NOINDEX,NOFOLLOW,NOARCHIVE,NOODP,NOSNIPPET">
<title>:: Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez ::</title>
<script src="../extras/js/relojdhtml.js" language="javascript" type="text/javascript"></script>
<script src="../extras/SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link rel="shortcut icon"  href="http://www.ittg.edu.mx/img/favicon.ico"/>
<link href="../extras/SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<link href="../extras/css/style.css" rel="stylesheet" type="text/css" />
<link href="../extras/css/index.css" rel="stylesheet" type="text/css" />
<link href="http://www.ittg.edu.mx/feed/feedNoticias.php" rel="alternate" title="TecNoticias" type="application/rss+xml" />
<link href="http://www.ittg.edu.mx/feed/feedAvisos.php" rel="alternate" title="TecAvisos" type="application/rss+xml" />
<script src="../extras/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body>
<div class="content">
  <div class="body">
<?php $sys->navegacion(); ?>
</div>	
<iframe frameborder="0" style="width: 700px; height: 630px; float: left;" src="<?php echo $sys->GetUrl(); ?>" name="intframe">
</body>
</html>
