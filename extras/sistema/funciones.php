<?php
function path_to($lugar){
	$root_dir =  'C:\inetpub\wwwroot';
	$path_parts = pathinfo("$lugar");
	$lugar =  $path_parts["dirname"];
	$_include_lib =   "extras/" ;
	$queda = str_replace($root_dir, '', $lugar);
	$IncludePath=explode(DIRECTORY_SEPARATOR,$queda); 
	$quedara="../";
	$i=1;
	foreach($IncludePath as $prefix){ 
		if($i){$i=0;$quedara="";}
		$quedara .=  "../" ; 
	}
	return ($quedara . $_include_lib);
}
function valor($parametro,$default=""){
	GLOBAL $firephp;
	$objeto=$default;
	if(isset($_GET[$parametro])  ){
		$firephp->log("GET[$parametro]=$_GET[$parametro];");
		$objeto=$_GET[$parametro];
	}elseif(isset($_POST[$parametro])  ){
		$firephp->log("POST[$parametro]=$_POST[$parametro];");
		$objeto=$_POST[$parametro];
	}
	return $objeto;
}

function valor_($parametro,$default=""){
	$objeto=$default;
	if(isset($_GET[$parametro])  ){
		$objeto=$_GET[$parametro];
	}elseif(isset($_POST[$parametro])  ){
		$objeto=$_POST[$parametro];
	}
	return $objeto;
}

function money($monto){
	return number_format($monto,2,".",",");
}


?>