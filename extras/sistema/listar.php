<?php
include_once('sistema/funciones.php');
$file = __FILE__;
$pth = path_to( $file );


$firephp->group('EN LISTAR');
$firephp->log( __LINE__ . ":" . __FILE__ . " en listar.php;");
GLOBAL $sistema;
$firephp->log( __LINE__ . ":" . __FILE__ . " consistema '$sistema';");
if(!isset($obj)){
$firephp->log( __LINE__ . ":" . __FILE__ . " CON INCLUDE ;");
	include_once('clase.php');
	$obj = new clase();

//	$obj->Getconn()->debug=true;
//	$obj->debug();
}
$firephp->log( __LINE__ . ":" . __FILE__ . " CON CLASE ;");


$listar .= "<html>\n";
$listar .= "<head>\n";
$_titulo = $obj->titulo();
$firephp->log( __LINE__ . ":" . __FILE__ . " titulo('$_titulo') ;");
$listar .= "<title>$_titulo</title>\n";
//$listar .= <<<LISTAR
$listar .= '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"  />'."\n";
$listar .= '<script language="JavaScript">'."\n";
$listar .= '<!--'."\n";
$listar .= 'function SetAccion2(accion){'."\n";
$listar .= '	if (accion =="imprimir"){'."\n";
$listar .= '//		document.frmlista.target="_blank";'."\n";
$listar .= '		document.frmlista2.action="planeacion/pta.php";'."\n";
$listar .= '	}	'."\n";
$listar .= '//	alert(document.frmlista.accion.value);'."\n";
$listar .= '//	alert(document.frmlista.accion.value);'."\n";
$listar .= '}'."\n";
$listar .= 'function SetAccion(accion){'."\n";
$listar .= '	document.frmlista.accion.value = accion;	'."\n";
$listar .= '//	alert(document.frmlista.accion.value);'."\n";
$listar .= '//	alert(document.frmlista.accion.value);'."\n";
$listar .= '}'."\n";
$listar .= '//-->'."\n";
$listar .= '</script>'."\n";
$listar .= '<style  type="text/css">@import url(' . $pth . 'css/style.css);</style>'."\n";
$listar .= '<script language="JavaScript" src="' . $pth . 'js/ajax.js"></script>'."\n";
$listar .= '</head>'."\n";
$listar .= '<body>	'."\n";
$firephp->log( __LINE__ . ":" . __FILE__ . " MEDIO LISTADO;");
//LISTAR ;
//$listar .= "\n";
//$listar .= "\n";
$listar .= '<div class="title">' . $_head . '<A href="index.php?objeto=login&accion=salir">SALIR</A></div>' ."\n";
$listar .= '<div class="body" aling="center">'."\n";
$listar .= ' <div class="navigation">' . $obj->menu() . '</div>' . "\n";
$listar .= ' <div class="content"> '."\n";
$listar .= '<form method="POST" name="frmlista" action="index.php" >'."\n";
$listar .= '<input type="hidden" name="accion"  value="listar">'."\n";
$listar .= '<input type="hidden" name="sistema" value="' . $sistema .'">' . "\n";
$listar .= '<input type="hidden" name="objeto"  value="' . $obj->objeto . '">'."\n";
//<!-- <form  name="encuesta" action="confirmacion.php" onSubmit="sumar(this); return validar_formulario(this);"> -->
$listar .= '  <p align="CENTER"><font size="5">' . $_titulo . '</font></p>'."\n";
$firephp->log( __LINE__ . ":" . __FILE__ . " OTRO LISTADO;");
$sql = $obj->sql_listar();
$firephp->log( __LINE__ . ":" . __FILE__ . " sql_listar: $sql");
$listar .= '<CENTER>'."\n";
//$firephp->log( __LINE__ . ":" . __FILE__ . " listar: $sql;");
$firephp->groupEnd();

echo $listar;
//	function ADODB_Pager(  &$db                 ,$sql ,         $_xtra="",             $id = 'adodb',            $showPageLinks = false)
$pager = new ADODB_Pager($obj->Getconn(),$sql, "&sistema=$sistema&objeto=$obj->objeto","$obj->objeto");
$pager->showPageLinks=true;
$pager->check=$obj->chk1();
$pager->Render(3);
echo '</CENTER>';
if(isset($_GET["accion"])  ){
	$_GET["accion"]="listar";
}elseif(isset($_POST["accion"])  ){
	$_POST["accion"]="listar";
}
	echo '<br>';
	echo $obj->footer();
	echo '<br>';
	echo '<br>';
	echo '<br>';
?>
</form>
<form method="POST" name="frmlista2" action="" target="_blank" >
<input type="hidden" name="accion"  value="listar">
<input type="hidden" name="sistema"  value="<?php echo $sistema; ?>">
<input type="hidden" name="objeto"  value="<?php echo $obj->objeto; ?>">
<?php
	if($obj->titulo2()){
		echo '<p align="CENTER"><font size="5">' . $obj->titulo2() . '</font>';
		$sql = $obj->sql_listar2();
//		 echo ' sql <HR>' .$sql . '<HR>';
		$rs = $obj->Execute($sql);
//		function rs2html(&$rs,$ztabhtml=false,$zheaderarray=false,$htmlspecialchars=true,$echo = true, $check= "")
		rs2html($rs, 'BORDER=2',false,true,true,$obj->chk());
		$rs->Close();
		echo '</p>';
		echo $obj->footer2();
	}
?>
</form>
</div>
</div>
</body>
</html>
