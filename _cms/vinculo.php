<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
?>
<html>
<head>
<title>lista</title>
<link href="cms.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.menun {
background-color:#DEDEDC;
float:left;
padding-top:0px;
width:150px;
}
a{
text-decoration:none;
color:#ffffff;
}

p.elemento a {
background-image:url(../img/btn.jpg);
background-repeat:no-repeat;
font-size:12px;
display:block;
width:150px;
height:auto;
padding: 8px 4px 8px 12px;
}-->
</style>
</head>
<body>
<base target="intFrame">
<!--
<div id="menu" class="rounded" >

<img src="imagenes/top_menu.gif"">
-->
<div class="menun">
<base target="intFrame">
<p class="elemento"><a href="lst_log.php"    target="intframe" >REBISAR LOG</a></p>


<p class="elemento"><a href="frm_entrada.php"    target="intframe"  >AGREGAR ENTRADAS</a></p>
<p class="elemento"><a href="lst_entrada.php"    target="intframe" >LISTAR ENTRADAS</a></p>
<p class="elemento"><a href="frm_contenido.php"  target="intframe" >AGREGAR CONTENIDO</a></p>
<p class="elemento"><a href="lst_contenido.php"  target="intframe" >LISTAR CONTENIDOS</a></p>
<p class="elemento"><a href="frm_noticia.php"    target="intframe" >AGREGAR NOTICIA</a></p>
<p class="elemento"><a href="lst_noticia.php"    target="intframe" >LISTAR NOTICIAS</a></p>
<p class="elemento"><a href="frm_anuncio.php"    target="intframe" >AGREGAR AVISO</a></p>
<p class="elemento"><a href="lst_anuncio.php"    target="intframe" >LISTAR AVISOS</a></p>
<p class="elemento"><a href="frm_anunciog.php"   target="intframe" >AGREGAR GRAFICO</a></p>
<p class="elemento"><a href="lst_anunciog.php"   target="intframe" >LISTAR GRAFICO</a></p>
<p class="elemento"><a href="lst_comentario.php" target="intframe" >LISTAR COMENTARIOS</a></p>
<p class="elemento"><a href="ord_entrada.php"    target="intframe" >ORDENAR ENTRADAS</a></p>

<p class="elemento"><a href="frm_propuesta.php"    target="intframe" >AGREGAR PROPUESTA</a></p>
<p class="elemento"><a href="lst_propuesta.php"    target="intframe" >LISTAR PROPUESTAS</a></p>





<p class="elemento"><a href="salir.php"          target="_parent"  >SALIR</a></p>
    <!-- 	<a href="../seccion.php?id=1" target="_parent"><img src="../img/regresar.JPG" alt="REGRESAR" border="0"></a>
 -->
<p>&nbsp;</p>
</div>
<!--
<img src="imagenes/down_menu.gif">
-->
</body>
</html>
