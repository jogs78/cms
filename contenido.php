<?php
	include '_cms/cms.inc.php';
	$ocms = new cms();
	$ocms->debug(false);
	$debug = false;
	$iframe = 0;
	$tipo = "mapa";
	$id = 1;
	if(isset($_GET["libre"] )  )   { $tipo = "libre";     $id= $_GET["libre"] ;}  
	elseif(isset($_GET["cx"]))      { $tipo = "busqueda";  $id= 1;}
	elseif(isset($_GET["mapa"]))    { $tipo = "mapa";      $id= $_GET["mapa"];}
	elseif(isset($_GET["anuncio"])) { $tipo = "anuncio";   $id= $_GET["anuncio"];}
	elseif(isset($_GET["anuncios"])){ $tipo = "anuncios";  $id= $_GET["anuncios"];}
	elseif(isset($_GET["noticia"])) { $tipo = "noticia";   $id= $_GET["noticia"]; }
	elseif(isset($_GET["noticias"])){ $tipo = "noticias";  $id= $_GET["noticias"]; }
	elseif(isset($_GET["id"]  )   ) { $tipo = "contenido"; $id= $_GET["id"];}
	elseif(isset($_GET["c2"]  )   ) { $tipo = "conteni2";  $id= $_GET["c2"];}
	elseif(isset($_GET["p"]  )   )  { $tipo = "propuesta"; $id= $_GET["p"];}
	elseif(isset($_GET["iframe1"])) { $tipo = "iframe1";   $id= $_GET["iframe1"]; $iframe =1;}
	elseif(isset($_GET["iframe2"]) ){ $tipo = "iframe2";   $id= $_GET["iframe2"]; $iframe =2;}
	elseif(isset($_GET["contacto"])){ $tipo = "contacto";}
	elseif(isset($_POST["txtpasstxt"])){ $tipo = "email";}

	$id=$id*1;
	if( is_long($id) ) { $id=$id*1;}	else {$tipo="mapa"; $id=1;}
	
	switch ($tipo){
		case 'iframe1':
		case 'iframe2':
			$ocms->settipo($tipo, $id);
			$ocms->cargar_title();
			$url = $ocms->url($id);
			break;
		default:
			$ocms->settipo($tipo, $id);
			$ocms->cargar();
			break;
	}
	
	
//if( $_GET["id"]==1 && !( isset($_GET["libre"])   || isset($_GET["anuncio"])|| isset($_GET["noticia"])   )  )header("Location: principal.php"); 
/*
$conn = ADONewConnection('mysql');  # create a connection
$conn->PConnect('localhost','content2_root','content2_password','content2');# connect to MySQL, agora db
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<title>:: Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez ::   <?php echo $ocms->title(); ?> </title>
<?php $ocms->head(); ?>
</head>
<body onload="mueveReloj();">
<div class="content">
  <div class="title"><a href="http://www.ittg.edu.mx"><img src="img/title.jpg" alt="ITTG" /></a></div>
<!-- date -->
<?php
	if ( $iframe == 1 ){
		$ocms->encabezado( false );
	} else $ocms->encabezado ( true );
?>	
  <div class="body">
  <?php
  		if ( $iframe ==1 ){ 
			echo '<iframe name = "ittgmainFrame" src="'.$url.'" frameborder="0" style="width: 875px; height: 650px;"> </iframe>';
		}else if ( $iframe ==2 ){ 
			$ocms->navegacion2( false );
		 	//$ocms->navegacion_foot($_GET["id"]);	
			echo '<p>&nbsp;</p><iframe name = "ittgmainFrame" src="'.$url.'" frameborder="0" style="width: 720px; height: 650px; float:right;"> </iframe>';
		}else{
			echo "\n<!-- navegacion -->";
			$ocms->navegacion2( false );
//			$ocms->navegacion_foot($_GET["id"]);
			echo "<div class=\"contenido\">";
			echo "<!-- division -->";
			echo "<div class=\"texto\">\n";
			echo "<p><img src=\"img/line.gif\" width=\"560\" height=\"20\" alt=\"Linea\" /></p>";
			echo "<div style=\"padding-top:5px; padding-left:10px; padding-right:10px;\">";
			$ocms->tit();
			$ocms->txt();
			?>
			</div>
			<p><img src="img/line.gif" width="560" height="20" alt="linea"/></p>
			</div>
	        <div class="fotos">
	        <img src="img/top_fotos.gif" width="140" height="25" alt="top"/>
			<?php 
				$ocms->img();
			?>
			<img src="img/down_fotos.gif" width="140" height="25" alt="bottom"/></div>
		    </div>
			<?php 
		} ?>
  <div class="pie">
  	<div align="center">
   	  <img src="img/line.jpg" alt="linea"/>
    </div>
    <div class="compatible">
      <table width="373" border="0" align="center">
  <tr>
    <td width="184" align="center" valign="top"><p>Normas Compatibles
    </p>
      <p>&nbsp;</p>
      <p><a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="img/css.jpg" alt="CSS 2.0" width="80" height="15" longdesc="CSS 2.0" /></a></p>
      <p><a href="http://validator.w3.org/check?uri=referer"><img src="img/xhtml.jpg" alt="XHTML" longdesc="hmtl" width="80" height="15" /></a></p>
      <p><a href="http://www.php.net/"><img src="img/phppow.gif" alt="PHP" width="80" height="15" longdesc="Powered by PHP 5.0" /></a></p>
    </td>
    <td width="179" align="center" valign="top"><p>Navegadores compatibles</p>
      <p><a href="http://www.microsoft.com/spain/windows/products/winfamily/ie/default.mspx"><img src="img/ie7.jpg" alt="IE 7" width="80" height="30" longdesc="Internet Explorer 7" /></a></p>
      <p><a href="http://www.mozilla-europe.org/es/firefox/" title="Descargar Mozilla Firefox"><img src="http://www.difundefirefox.com/files/banners/boton-ff2.png" alt="Mozilla Firefox"/></a></p>
     </td>
  </tr>
</table>
    </div>
    <div class="contactoTec">
      Contacto:
      <p>&nbsp;</p>
      <p>Instituto Tecnológico de Tuxtla Gutiérrez</p>
      <p>Carretera Panamericana Km. 1080</p>
      <p>Tuxtla Gutiérrez, Chiapas, México</p>
      <p>C.P. 29000, Apartado Postal 599</p>
      <p>&nbsp;</p>
      <p> Telefonos:<img src="img/fon.gif" alt="Telefono" width="19" height="16" longdesc="Telef&oacute;no" /> (961) 61-5-03-80 y (961) 61-5-04-61</p>
      <p> Fax: <img src="img/fax.gif" alt="Fax" width="17" height="14" longdesc="Fax" /> (961) 61-5-16-87</p>
      <p><br />
      </p>
    </div>
  </div>
  <div class="endpage">Instituto Tecnológico de Tuxtla Gutiérrez &copy;2008</div>
</div>
<?php
	$ocms->google_analytics();
	$ocms->validation_foot();
        $mem_usage = memory_get_usage(true);

        if ($mem_usage < 1024)
            echo "<!-- " . $mem_usage." bytes -->";
        elseif ($mem_usage < 1048576)
            echo "<!-- " . round($mem_usage/1024,2)." kilobytes  -->";
        else
            echo "<!-- " . round($mem_usage/1048576,2)." megabytes  -->";



?>
</body>
</html>
