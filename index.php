<?php
$_srv =  $_SERVER['SERVER_NAME'] ;
	include '_cms/cms.inc.php';
	$ocms = new cms();
/*	
	//---------------
	include("visitas.php");
	$db = new mysql;
	$db->connect();
	 $visita = $db->fetch_array($db->query('SELECT visitas FROM visitas_unicas '));
	 if( !is_array( $visita ) )
	 {
	 	if( !isset( $_COOKIE['visitas'] ) && $_SESSION['no_refresh'] == false )
		{
			$expirate = time()+(60*15);
				
			 $update = $db->query(
				"INSERT INTO visitas_unicas SET
				id_visitas = 1,
				visitas = 1
				");
				
			 $_SESSION['no_refresh'] = true;
			 setcookie('visitas', 'visitas', $expirate);
	   }
	 
	 }else{
		if(  !isset(	$_SESSION['no_refresh']  )){
			$_SESSION['no_refresh'] = false;
		}
		if( !isset( $_COOKIE['visitas'] ) && $_SESSION['no_refresh'] == false ){
			 $expirate = time()+(60*20);
			 $update = $db->query(
				"UPDATE visitas_unicas SET
				visitas='".++$visita['visitas']."'
				WHERE id_visitas = id_visitas LIMIT 1
				");
				
			 $_SESSION['no_refresh'] = true;
			 setcookie('visitas', 'visitas', $expirate);
		}
	 }	
	 
	   $visiT = $db->fetch_array($db->query("SELECT visitas FROM visitas_unicas "));
	   $visita =  $visiT['visitas'];
	   $db -> close();
	   $ocms->unicas($visita);
//	   if($visita % 2 == 0 ) header("Location: http://pruebas.ittg.edu.mx/");

	   # Esto para que no se quede en cach&eacute; despues de unas refrescadas.
	   header("Cache-Control: no-cache, must-revalidate");
	   header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// -------------------
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="verify-v1" content="eUNxbLhX3VyL13zQwxiWeS4K54dXzLMl5rlXMWUS09g=" />
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<meta name="Keywords" content="ITTG, ittg, Tec Tuxtla, Instituto Tecnolgico de Tuxtla Gutierrez, Chiapas, NotiTec, chicasTec, Tuxtla, Gutirrez, Ing. en Sistemas Computacionales, Ing. Bioqumica, Ing. Industrial, Ing. Mecanca, Ing. Electrnica, Ing. Electrica, Lic. en Informatica, Ing. Qumica, Ingeniera, TEC Tuxtla, tec, tectuxtla, TECTUXTLA, superconejo, Super Conejo, Conejos Tuxtla, Educacin a Distancia"/>
<meta name="Description" content="Sitio Oficial del Instituto Tecnologico de Tuxtla Gutierrez"/>
<meta name="Title" content="Instituto Tecnolgico de Tuxtla Gutierrez"/>
<meta name="Author" content="Ing. Jorge Octavio Gúzman Sánchez, Ing. Eli Alejandro Moreno Lopez"/>
<meta name="Subject" content="Educacion"/>
<meta name="Generator" content="PHP Designer 2007 Personal Edition"/>
<meta name="Language" content="Espanol"/>
<meta name="Robots" content="index, follow"/>
<title>:: Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez ::</title>
<script src="extras/js/relojdhtml.js" language="javascript" type="text/javascript"></script>
<script src="extras/SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link rel="shortcut icon"  href="http://<?php echo $_srv ?>/img/favicon.ico"/>
<link href="extras/SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<link href="extras/css/style.css" rel="stylesheet" type="text/css" />
<link href="extras/css/index.css" rel="stylesheet" type="text/css" />
<link href="extras/css/pre.css" rel="stylesheet" type="text/css" />

<!-- Feeds -->
<link href="http://<?php echo $_srv ?>/feed/feedNoticias.php" rel="alternate" title="TecNoticias" type="application/rss+xml" />
<link href="http://<?php echo $_srv ?>/feed/feedAvisos.php" rel="alternate" title="TecAvisos" type="application/rss+xml" />
<script src="extras/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body onload="mueveReloj();">
<div class="content">
  <div class="title"> </div>
<!-- date -->
<?php
    $ocms->encabezado( true );
?>	
  <div class="body">
  	<!-- navegacion -->
<?php
	$ocms->navegacion2();
//	$ocms->navegacion_foot("");
	   
?>	
    <div class="contenido">
	<!-- division -->
	    <div class="estruc"><ul>
	          <li><img src="img/noticias.gif" alt="Noticias" width="250" height="30" border="0px"/></li>
	          <li><a href="contenido.php?libre=4">Misi&oacute;n, Visi&oacute;n y Valores</a> </li>
	          <li><a href="contenido.php?contacto=1">Cont&aacute;ctanos</a></li>
	          <li><a href="contenido.php?mapa=1">Mapa del sitio</a></li>
	      </ul>
		</div>
		<div class="wrap1">
			<div class="notiTec">
			<?php $ocms->anunciosg("centro");   ?>
<p>&nbsp;</p>
<?php /*
	<!-- BANNER ANIVERSARIO -->
	<div style="width:400px; text-align:center; margin:0px auto;">
		<script type="text/javascript">
		//<![CDATA[
			AC_FL_RunContent( 'data','img/bannerfichas.swf','type','application/x-shockwave-flash','width','400','height','50','title','fichas2008','quality','high','src','img/bannerfichas','movie','img/bannerfichas' ); //end AC code
		//]]>
	</script><noscript>
	<object data="img/bannerfichas.swf" type="application/x-shockwave-flash" width="400" height="50" title="fichas2008">
		<param name="movie" value="img/bannerfichas.swf" />
		<param name="quality" value="high" />
	</object>
	</noscript>
	</div>
*/ ?>
<p>&nbsp;</p>
				<p>Suscribete al Sistema de Sindicaci&oacute;n <a href="http://<?php echo $_srv ?>/feed/feedNoticias.php"><img src="img/RSS.png" alt="RSS NotiTec" width="16" height="16" /></a></p>
				<div id="tecnoticias">
 				    <?php	$ocms->tecnoticias(); ?>
 				</div> <!-- _tecnoticias -->
          </div>
			<br />
			<br />
			<br />
			<div  class="paginasrec" style="text-align:center;">
				<p><strong>Páginas Recomendadas  </strong></p>
				<p>&nbsp;</p>
			    <p> <a href="http://www.bivitec.org.mx/" target="_blank">
                		<img src="img/bivitec.jpg" alt="Bivitec" width="80" height="51" />
                    </a>
                    <a href="http://www.dgest.gob.mx/" target="_blank">
                    	<img style="padding-left:25px;" src="img/dgest.jpg" alt="DGEST" />
                    </a>
                </p>
		  		<p>
                	<a href="http://www.bibliotecachiapas.gob.mx/"  target="_blank">
                    	<img src="img/bibliotecachiapas.gif" alt="Biblioteca" />
                    </a>
                    <a href="http://www.cocytech.gob.mx/"  target="_blank">
                    	<img style="padding-left:25px;" src="img/cocytech.gif" alt="COCYTECH" />
                    </a>
                </p>
			</div>	  
	    </div> <!-- termina wrap1 -->  
		  
		<div class="avisos1">
		    <div id="navegantes">
		        <p style="color:#3366FF; font-weight:bold;">Usuarios Activos:</p>
		        <p><?php $ocms->printact(); ?></p>
		        <p>&nbsp;</p>
		        <p><span style="color:#3366FF; font-weight:bold;">Visitante N&uacute;mero:</span></p>
		        <p style="display:block; text-align:right; width: 120px; height:auto;"><?php $ocms->printnum();   ?></p>
		        <p>Desde el 1 de Enero de 2008</p>
		        <p>&nbsp;</p>
			</div> <!-- navegantes -->
            <?php $ocms->tosearch();   ?>
		        <p>&nbsp;</p>
			<div id="anuncios" style="text-align:center">
            <?php $ocms->anunciosg();   ?>
            <p>&nbsp;</p>

			</div> <!-- anuncios -->
			<div id="tecavisos">
<p><img src="img/avisos.gif" alt="Avisos" border="0" height="30" width="120"/><a href="feed/feedAvisos.php"> <img src="img/RSS.png" alt="RSS Avisos" height="16" width="16"/></a></p>
				<?php $ocms->tecavisos();	?>
				<p>&nbsp;</p>
			</div> <!-- tecavisos-->
		<br>
				<?php $ocms->encuestas();	?>		
		</div> <!-- noticias -->
	    </div>
	</div> <!-- contenido-->
  <div class="pie">
  	<div align="center">
    <p><img src="img/line.jpg" alt="linea azul" /></p>
  	</div>
    <div class="compatible">
      <table width="373" border="0" align="center">
  <tr>
    <td width="184" align="center" valign="top"><p>Normas Compatibles
    </p>
      <p>&nbsp;</p>
      <p><a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="img/css.jpg" alt="CSS 2.0" width="80" height="15" /></a></p>
      <p><a href="http://validator.w3.org/check?uri=referer"><img src="img/xhtml.jpg" alt="XHTML" longdesc="hmtl" width="80" height="15" /></a></p>
      <p><a href="http://www.php.net/"><img src="img/phppow.gif" alt="PHP 5.0" width="80" height="15" /></a></p>
    </td>
    <td width="179" align="center" valign="top"><p>Navegadores compatibles</p>
      <p><a href="http://www.microsoft.com/spain/windows/products/winfamily/ie/default.mspx"><img src="img/ie7.jpg" alt="IE 7" width="80" height="30" /></a></p>
      <p><a href="http://www.mozilla-europe.org/es/firefox/" title="Descargar Mozilla Firefox"><img src="http://www.difundefirefox.com/files/banners/boton-ff2.png" alt="Mozilla Firefox"/></a></p>
     </td>
  </tr>
</table>
      <!-- <p><a href="http://www.difundefirefox.com/descargar-mozilla-firefox-gratis" title="Descargar Mozilla Firefox"><img src="http://www.difundefirefox.com/files/banners/boton-ff2.png" alt="Mozilla Firefox" style="border:0;"/></a></p> -->
    </div>
    <div class="contactoTec">

      Contacto:
      <p>&nbsp;</p>
      <p>Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez</p>
      <p>Carretera Panamericana Km. 1080</p>
      <p>Tuxtla Guti&eacute;rrez, Chiapas, M&eacute;xico</p>
      <p>C. P. 29000, Apartado Postal 599</p>
      <p>&nbsp;</p>
      <p> Telefonos:<img src="img/fon.gif" alt="Telefono" width="19" height="16" /> (961) 61-5-03-80 y (961) 61-5-04-61</p>
      <p> Fax: <img src="img/fax.gif" alt="Fax" width="17" height="14" /> (961) 61-5-16-87<br />
      </p>
    </div>
  </div>
  <div class="endpage">Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez &copy;2008</div>
</div>
<script type="text/javascript">
/*
// Google Analytics
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
*/
</script>
<script type="text/javascript">
/*
	var pageTracker = _gat._getTracker("UA-3680175-1");
	pageTracker._initData();
	pageTracker._trackPageview();
// Fin
*/
</script>
<?php
        $mem_usage = memory_get_usage(); 
        
        if ($mem_usage < 1024) 
            echo "<!-- " . $mem_usage." bytes -->"; 
        elseif ($mem_usage < 1048576) 
            echo "<!-- " . round($mem_usage/1024,2)." kilobytes  -->"; 
        else 
            echo "<!-- " . round($mem_usage/1048576,2)." megabytes  -->"; 
            

?>
</body>
</html>
