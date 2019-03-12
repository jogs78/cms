<?php
session_start();
if (!isset($_SESSION["INCMS"])){
	exit;
}
include('sistema.inc.php');
$sys = new sistema();
//$sys->conn->degubg=true;
$accion=2;
//if( !$sys->puede($_SESSION['user'] ,'PROPUESTA', $accion) ) exit;
$nota = $_POST["nota"]; 
$id = $_POST["id"]; 
$debe = $_POST["debe"]; 
$e="";
if ($debe == "autorizar"){
	$actualizado = date("d/m/Y");
	$wwwroot = realpath("..") ;
	$pimg = "imagenes";
	$pdoc = "documentos";
	$ppimg = "pimagenes";
	$ppdoc = "pdocumentos";
	$sql = "UPDATE contenido as c , propuesta as p SET c.p01=p.p01,  ";
	$sql .= "c.img1= p.img1, c.img2=p.img2,c.img3=p.img3,c.img4=p.img4,c.img5=p.img5,c.img6=p.img6,c.img7=p.img7,c.img8=p.img8,c.img9=p.img9,"; 
	$sql .= "c.doc1=p.doc1,c.doc2=p.doc2,c.doc3=p.doc3,c.doc4=p.doc4,c.ima1=p.ima1,c.ima2=p.ima2,c.ima3=p.ima3,c.ima4=p.ima4, c.actualizado = '$actualizado' "; 
	$sql .= "WHERE c.id = $id  AND c.id = p.idc;";
	if ($sys->conn->Execute($sql) === false) {
		$e .= 'Error al insertar propuesta: '.$sys->conn->ErrorMsg().'<BR>';
	}else{
		$sql = "SELECT * FROM propuesta where idc = $id;";
		$rs = $sys->conn->Execute($sql);
		$inputs =explode(' ' , "img1 img2 img3 img4 img5 img6 img7 img8 img9 ima1 ima2 ima3 ima4 ima5");
		foreach( $inputs as $file ) {
			$arch = $rs->fields[ $file ] ;
			if(!$arch) continue;
			$src= $wwwroot  . DIRECTORY_SEPARATOR . $ppimg   . DIRECTORY_SEPARATOR . "normal" . DIRECTORY_SEPARATOR . $arch ;
			$dst= $wwwroot  . DIRECTORY_SEPARATOR . $pimg  . DIRECTORY_SEPARATOR . "normal" . DIRECTORY_SEPARATOR . $arch ;
			if(file_exists ($src) ) if (!copy($src, $dst )) $e .= "Fallo al copiar $file $src ...<br>\n"; 
			$src= $wwwroot  . DIRECTORY_SEPARATOR . $ppimg   . DIRECTORY_SEPARATOR . "thumbs" . DIRECTORY_SEPARATOR . $arch ;
			$dst= $wwwroot  . DIRECTORY_SEPARATOR . $pimg  . DIRECTORY_SEPARATOR . "thumbs" . DIRECTORY_SEPARATOR . $arch ;
			if(file_exists ($src) ) if (!copy($src, $dst )) $e .= "Fallo al copiar $file $src ...<br>\n";
		}
		$inputs =explode(' ' , "doc1 doc2 doc3 doc4");
		foreach( $inputs as $file ) {
			if(!$arch) continue;
			$arch = $rs->fields[ $file ] ;
			$src= $wwwroot  . DIRECTORY_SEPARATOR . $ppdoc  . DIRECTORY_SEPARATOR . $arch ;
			$dst= $wwwroot  . DIRECTORY_SEPARATOR . $pdoc . DIRECTORY_SEPARATOR . $arch ;
			if(file_exists ($src) ) if (!copy($src, $dst )) $e .= "Fallo al copiar $file $src ...<br>\n";
		}

		}
}else{
	$sql="UPDATE propuesta SET nota = '$nota' WHERE idc = $id;";
	$recordSet = $sys->conn->Execute($sql);
}
$sql="UPDATE propuesta SET modificado = 0 WHERE idc = $id;";
$recordSet = $sys->conn->Execute($sql);
	
$sys->currentid = $id;
$sys->log($_SESSION['user'] ,'PROPUESTA', $accion, $sql, "");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PROCESO PROPUESTA DE UN CONTENIDO</title>
<link href="cms.css" rel="stylesheet" type="text/css">
</head>
<body>
<center> <h1>PROCESO PROPUESTA DE UN CONTENIDO</h1> </center>
<?php 
$t=0;
if($e){	echo "<hr>$e<hr>";
	$t=100000;
}else {
	$t=500;
}
?>
<BR>REALIZADO... SERA REDIRECCIONADO A LA LISTA DE CONTENIDOS PROPUESTOS EN SEGUNDOS.... SI NO DE CLICK <A HREF="rev_propuesta.php">AQUI </A>
<SCRIPT LANGUAGE="JavaScript">
<!--
setTimeout( "document.location='rev_propuesta.php'", <?php echo $t ?> );	
//-->
</SCRIPT>
</body>
</html>