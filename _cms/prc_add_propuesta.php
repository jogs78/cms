<?php
/**
 * @name Procesar Agregar Propuesta (Procesar Postor)
 * 
 * @abstract Esta página es utilizada para procesar
 * los datos enviados desde el formulario de agregar propuesta.
 * 
 * @param array $_POST En este arreglo se transmite
 * la información que debe ser procesada.
 * @param int $_POST['idu']  Indica el ID de la persona que
 * propondra un contenido
  * @param int $_POST['idc'] Indica el ID del contenido 
 * que se propondra
 * @param int $_POST['idp'] || Null Indicará el ID de la propuesta
 *  (dupla idu, idc) (Not implemented yet) 
 * @param int $_POST['act']  Indicará la acción que ha de realazarse
 * 1.- Agregar 2.- Modificar 3.- Eliminar  
 * 
 * @uses prc_add_prouesta.php Esta se usa cuando se agrega una noticia nueva
 * @uses prc_noticia.php?idp=1&idu=1&act=2 Esta se usa cuando ha de modificarse una noticia
 * 
 */
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}

include('sistema.inc.php');
$sys = new sistema();
$accion=$_POST["act"];
if( !$sys->puede($_SESSION['id'] , PROPUESTA , $accion) ) exit;
$idc = $_POST["idc"]; 
$idu = $_POST["idu"]; 
//$sys->currentid = $id;
//$sys->conn->debug=true;
$e="";
$sys->conn->StartTrans();
$sql="INSERT INTO propuesta_usuario VALUES ($idc , $idu) ";
$sqlf=$sql;
if ($sys->conn->Execute($sql) === false) {
	$e .= 'Error al insertar propuesta_usuario: '.$sys->conn->ErrorMsg().'<BR>';
}else{
	$wwwroot = realpath("..") ;
	$pimg = "imagenes";
	$pdoc = "documentos";
	$ppimg = "pimagenes";
	$ppdoc = "pdocumentos";
	$sql  = "INSERT into propuesta (idc, p01, img1, img2, img3, img4, img5, img6, img7, img8, img9, doc1, doc2, doc3, doc4, ima1, ima2, ima3, ima4)"; 
	$sql .= "SELECT id as idc, p01, img1, img2, img3, img4, img5, img6, img7, img8, img9, doc1, doc2, doc3, doc4, ima1, ima2, ima3, ima4 FROM contenido ";
	$sql .= "WHERE id = $idc;";
	if ($sys->conn->Execute($sql) === false) {
		$e .= 'Error al insertar propuesta: '.$sys->conn->ErrorMsg().'<BR>';
	}else{
		$sql = "SELECT * FROM contenido where id = $idc;";
		$rs = $sys->conn->Execute($sql);
		$inputs =explode(' ' , "img1 img2 img3 img4 img5 img6 img7 img8 img9 ima1 ima2 ima3 ima4");
		foreach( $inputs as $file ) {
			$arch = $rs->fields[ $file ] ;
			if(!$arch) continue;
			$src= $wwwroot  . DIRECTORY_SEPARATOR . $pimg   . DIRECTORY_SEPARATOR . "normal" . DIRECTORY_SEPARATOR . $arch ;
			$dst= $wwwroot  . DIRECTORY_SEPARATOR . $ppimg  . DIRECTORY_SEPARATOR . "normal" . DIRECTORY_SEPARATOR . $arch ;
			if(file_exists ($src) ) if (!copy($src, $dst )) $e .= "Fallo al copiar $file $src ...<br>\n"; 
			$src= $wwwroot  . DIRECTORY_SEPARATOR . $pimg   . DIRECTORY_SEPARATOR . "thumbs" . DIRECTORY_SEPARATOR . $arch ;
			$dst= $wwwroot  . DIRECTORY_SEPARATOR . $ppimg  . DIRECTORY_SEPARATOR . "thumbs" . DIRECTORY_SEPARATOR . $arch ;
			if(file_exists ($src) ) if (!copy($src, $dst )) $e .= "Fallo al copiar $file $src ...<br>\n";
		}
		$inputs =explode(' ' , "doc1 doc2 doc3 doc4");
		foreach( $inputs as $file ) {
			if(!$arch) continue;
			$arch = $rs->fields[ $file ] ;
			$src= $wwwroot  . DIRECTORY_SEPARATOR . $pdoc  . DIRECTORY_SEPARATOR . $arch ;
			$dst= $wwwroot  . DIRECTORY_SEPARATOR . $ppdoc . DIRECTORY_SEPARATOR . $arch ;
			if(file_exists ($src) ) if (!copy($src, $dst )) $e .= "Fallo al copiar $file $src ...<br>\n";
		}
	}	
}
$sys->conn->CompleteTrans();
$sys->log($_SESSION['user'] , PROPUESTA, $accion, $sqlf);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PROCESO PROPUESTA DE UN CONTENIDO</title>
<link href="cms.css" rel="stylesheet" type="text/css">
</head>
<body>
<center> <h1>AGREGAR UNA CUENTA PARA PROPONER CONTENIDOS</h1> </center>
<?php 
$t=0;
if($e){	echo "<hr>$e<hr>";
	$t=100000;
}else {
	$t=500;
}
?>
<BR>REALIZADO... SERA REDIRECCIONADO EN SEGUNDOS.... SI NO DE CLICK <A HREF="rev_propuesta.php">AQUI </A>
<SCRIPT LANGUAGE="JavaScript">
<!--
setTimeout( "document.location='rev_propuesta.php'", <?php echo $t ?> );	
//-->
</SCRIPT>
</body>
</html>
