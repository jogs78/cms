<?php
/**
 * @name Listar Comentario
 * 
 * @abstract Esta página es utilizada para listar los comentarios dejados en la pagina
 * 
 * @uses lst_comentario.php Esta se usa cuando se listan  las  noticia noticias
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
if( !$sys->puede($_SESSION['id'] , COMENTARIO, LISTAR) ) exit; 
$sys->log( $_SESSION['id'] , COMENTARIO ,LISTAR);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>LISTAR COMENTARIOS</title>
<link href="cms.css" rel="stylesheet" type="text/css"/>
<link href="tables.css" rel="stylesheet" type="text/css"/>
<script language="javascript">
   function cambiar (){
		edo = document.lst.borrar.checked ;
		for (i=0; i<(document.lst.elements.length); i++)
			if (document.lst.elements[i].type == "checkbox" ){
				document.lst.elements[i].checked = edo ;
			}
   }
</script>
</head>
<body>
<div class="contenido">
<p>&nbsp;</p>
<h1>LISTAR COMENTARIOS</h1>
<p>&nbsp;</p>
<div align="center">
<?php
//echo "";
$debug = false;
$sql="SELECT id, fecha, titulo, email FROM comentario ORDER BY fecha DESC;";
if($debug) echo $sql;
$recordSet = &$sys->conn->Execute($sql);
if (!$recordSet) {
		echo "COMENTARIOS NO DISPONIBLES";
		print $sys->conn->ErrorMsg();
		exit;
}else{
	echo "<form name=\"lst\"  method=\"POST\" action=\"del_comentario.php\">";
	echo "<table align=\"center\" border=\"1\">\n";
	echo "	<thead>\n<tr>\n";
	echo "		<th >#</th>\n";
	echo "		<th ><input type=\"checkbox\" name=\"borrar\"  onClick=\"cambiar()\" ></th>\n";
	echo "		<th width=\"80\">FECHA</th>\n";
	echo "		<th >TITULO</th>\n";
	echo "		<th >CORREO</th>\n";
	echo "		<th >E</th>\n";
	echo "	</tr>\n</thead>\n";
	$j=1;
	while (!$recordSet->EOF) {
	$i=0;
		echo "<tbody>\n";
		if ($j%2 == 0)
		echo "	 <tr class=\"odd\">\n";
		else echo "    <tr>\n";
		echo "		<td>" . ++$i . "</td>\n";
		echo "		<td><input type=\"checkbox\" name=\"campos[" . $recordSet->fields["id"] . "]\"></td>";
		echo "		<td>" . $recordSet->fields["fecha"] . "</td>\n";
		echo "		<td><a href=\"frm_comentario.php?ide=" . $recordSet->fields["id"] . "&act=4\">" . $recordSet->fields["titulo"] . "</a></td>\n";
		echo "		<td><a href=\"frm_comentario.php?ide=" . $recordSet->fields["id"] . "&act=4\"><pre>" . $recordSet->fields["email"] . "</pre></a></td>\n";
		echo "		<td><a href=\"frm_comentario.php?ide=" . $recordSet->fields["id"] . "&act=3\"><img src=\"imagenes/borrar.png\" alt=\"X\" border=\"0\"></a></td>\n";
		echo "	 </tr>\n</tbody>\n";
		$j++;
		$recordSet->MoveNext();
	}
	echo "</table>\n";
	echo "<br>";
	echo "<INPUT TYPE=\"submit\" value=\"ELIMINAR\">";
	echo "</form>";
}
?>
</div>
<p>&nbsp;</p>
</div>
</body>
</html>
