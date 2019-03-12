<?php
/**
 * @name Listar Noticia
 * 
 * @abstract Esta página es utilizada para listar las noticias
 * 
 * @uses lst_noticia.php Esta se usa cuando se listan  las  noticia noticias
 */
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
/**
 * Llamada a la clases 'sistema.inc.php'
 * y a continuación se crea un objeto de esta
 */
include('sistema.inc.php');
$sys = new sistema();
if( !$sys->puede($_SESSION['id'], ANUNCIOG, LISTAR) ) exit; 
$sys->log( $_SESSION['id'], ANUNCIOG,LISTAR);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>LISTAR ANUNCIO GRAFICO</title>
<link href="cms.css" rel="stylesheet" type="text/css"/>
<link href="tables.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="contenido">
<p>&nbsp;</p>
<h1>LISTAR ANUNCIOS GRAFICOS</h1>
<p>&nbsp;</p>
<div align="center">
<?php
$debug = false;
$sql="SELECT  IF(ag.central=1,'CENTRO', IF(ag.der=1,'DERCHA', 'IZQUIERDA') ) posicion, ag.orden, ag.img, ag.titulo, a.descripcion tipo, ";
$sql=$sql . "ag.id, ag.fecha, ag.idg FROM anunciog ag JOIN tipo2 a ON ag.tipo = a.id  ORDER BY posicion, ag.orden, ag.fecha  DESC ;";
$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "ANUNCIOS GRAFICOS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<table>\n";
	echo "	<thead>\n<tr>\n";
	echo "		<th >POSICION</th>\n";
	echo "		<th >ORDEN</th>\n";
	echo "		<th >TIPO</th>\n";
	echo "		<th >TITULO</th>\n";
	echo "		<th >FECHA</th>\n";
	echo "		<th >IMAGEN</th>\n";
//	echo "		<th >M</th>\n";
	echo "		<th >E</th>\n";
	echo "	</tr>\n</thead>";
	$i = 1;
	while (!$recordSet->EOF) {
		echo "<tbody>\n";
		if ($i%2 == 0)
		echo "	 <tr class=\"odd\">\n";
		else echo "    <tr>\n";
		echo "		<td>" . $recordSet->fields["posicion"] . "</td>\n";
		echo "		<td>" . $recordSet->fields["orden"] . "</td>\n";
		echo "		<td>" . $recordSet->fields["tipo"] . "</td>\n";
		echo "		<td>" . $recordSet->fields["titulo"] . "</td>\n";
		echo "		<td>" . $recordSet->fields["fecha"] . "</td>\n";
		echo "		<td><a href=\"frm_anunciog.php?idg=". $recordSet->fields["idg"] . "&act=2\">" ;
		echo "<img src=\"../imagenes/normal/" . $recordSet->fields["img"] . "\" width=\"140\" height=\"30\">";
		echo "</a></td>\n";
//		echo "		<td><a href=\"frm_anunciog.php?ide=" . $recordSet->fields["id"] . "&tipo=" . $recordSet->fields["tipo"] . "&act=2\"><img src=\"imagenes/editar.png\" alt=\"E\" border=\"0\"></a></td>\n";
		echo "		<td><a href=\"frm_anunciog.php?idg=" . $recordSet->fields["idg"] . "&act=3\"><img src=\"imagenes/borrar.png\" alt=\"X\" border=\"0\"></a></td>\n";
		echo "	 </tr>\n</tbody>";
		$i++;
		$recordSet->MoveNext();
	}
	echo "<table>\n";
}
?>
</div>
<p>&nbsp;</p>
<a href="frm_anunciog.php">AGREGAR</a>
<p>&nbsp;</p>
</div>
</body>
</html>
