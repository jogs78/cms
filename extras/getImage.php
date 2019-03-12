<?php
	
//	echo $_GET["s"] . "<br>";
	if ( isset($_GET["s"]) ){
		$session_name= $_GET["s"];
		$nombre_anterior = session_name($session_name);
	}
	
	session_start();

	if ( isset($_GET["t"]) ){
		$t = $_GET["t"];
	}
	//echo $t;
	$imageText = $_SESSION[$t];
	
	if (!isset($imageText)){
		header("HTTP/1.0 405"); // Recurso no permitido
		return;
	}
	define("HEIGHT", 30);
	define("SPC", 20);
	define("WIDTH", (SPC * strlen($imageText)));
	define("FONTNAME", "ARIAL.TTF");
	//define("FONTNAME", "clonewars2.ttf");
	//define("FONTNAME", "DESTROY_.TTF");
	define("FONTSIZE", 18);
	$img = @imagecreate(WIDTH, HEIGHT);
	@imagecolorallocate($img, 200, 200, 200);
	$black = @imagecolorallocate($img, 0, 0, 0);
	@imagerectangle($img, 0, 0, WIDTH - 1, HEIGHT - 1, $black);
	for ($i=0, $l = strlen($imageText); $i < $l; $i++){
		imagettftext($img, FONTSIZE, 10, $i*SPC + 2, 26, $black, FONTNAME, $imageText[$i]);
	}
	@header("content-type: image/png");
	//@header("HTTP/1.0 405"); // Recurso no permitido
	@imagepng($img);
	@imagedestroy($img);

/*
	session_start();
	$imageText = $_SESSION["passtxt"];
	if (! isset($imageText)){
		header("HTTP/1.0 405"); // Recurso no permitido
		return;
	}
	include_once ("jpgraph-2.2/src/jpgraph_antispam.php");
$spam = new AntiSpam($imageText);
if( $spam->Stroke() === false ) {
    die('Illegal or no data to plot');
}
*/
?> 

