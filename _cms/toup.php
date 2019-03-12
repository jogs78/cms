<?php
include('resize.php');
class toup{
	public $wwwroot;
	public $pimg ;
	public $pdoc;
	public $lastname;
	public $lastthumb;
	public $error;
	
	function toup(){
		$wwwroot = $pimg = $doc = "";
	}
	
	function __destruct(){
	}
	
	function extencion($nombre){
		$nombre=strtolower ($nombre);
		$partes = explode('.', $nombre);
		if (isset($partes[1]) && $partes[1]!="") return $partes[1];
		else return ".xxx";
	}
	function tipode($nombre){
		$type = "";
		$mimes=array("application/msword","application/download","application/x-zip-compressed","application/pdf","application/x-pdf","text/plain","application/x-zip","application/octet-stream");
		if (substr($nombre, 0, 6) == "image/")  $type = "img";
		elseif( in_array($nombre, $mimes) ) $type = "doc";
		else $type = "?";
		return $type;
	}
	
	function proccess_file($index, $id, $obj){
		$debug = false;
                if ($debug ) echo "($index, $id, $obj)" ;
		$this->lastname="";
		$this->lastthumb="";
		$name = "$id$index$obj";
	   	if ($debug ) echo "<hr>SUBIR index:$index, id:$id, obj:$obj, name:$name<hr>";
		if($index == "" ||  $this->wwwroot == "" || $this->pimg == "" || $this->pdoc == ""  ){ 
			$this->error = "falta establecer index:$index|wwwroot:$this->wwwroot1|pimg:$this->pimg|pdoc:$this->pdoc<br>";
			return flase;
		}
		$file_name     = $_FILES[$index]['name'];
		$file_size     = $_FILES[$index]['size'];
		$file_type     = $_FILES[$index]['type'];	 
		$file_tmp_name = $_FILES[$index]['tmp_name'];
		$ext = $this->extencion($file_name);
		$name =  "$name.$ext";
		$this->lastname=$name;
	//echo "<hr>$file_type<hr>";	
		$type = $this->tipode($file_type);
		if ($debug ) echo  "$file_name es $type ";
		if ($type == "?"){ $this->error = "'$file_type' no se reconoce"; return false;}
		if ($type == "img"){
			$path = $this->wwwroot . DIRECTORY_SEPARATOR . $this->pimg . DIRECTORY_SEPARATOR;
			$file_new_name=$path  . "normal" . DIRECTORY_SEPARATOR . $name;
		}else{
			$path = $this->wwwroot . DIRECTORY_SEPARATOR . $this->pdoc . DIRECTORY_SEPARATOR;
			$file_new_name=$path . DIRECTORY_SEPARATOR . $name;
		}
		$sta = stat($file_tmp_name);
		if ($debug ) print_r ($sta);
		$ret = move_uploaded_file($file_tmp_name, $file_new_name);
		chmod($file_new_name,0755);
	 	if ($debug ) echo "<hr> $ret = move_uploaded_file($file_tmp_name, $file_new_name)";	
		if($ret){
			if ($type=="img"){
				$save  = $path . "thumbs" . DIRECTORY_SEPARATOR . $name;
				$thumb = new thumbnail($file_new_name);
				$thumb -> size_auto();
				$thumb -> save($file_new_name);
				$thumb -> size_width(130);
				$thumb -> jpeg_quality(80);
				$thumb -> save($save);
				$this->lastthumb =  '<img src="../'.$this->pimg.'/thumbs/'.$name . '"/>';
			}
			return true;
		}else{ 
			return false;
		}
		
		
	}
	function proccess_file_old($pre, $path, $id, $type, $n){
		$debug = false;	
		if ($debug ) echo "pre:$pre, path:$path, id:$id, type:$type" ;
		if($pre!=""){ 
			$file_name = $_FILES[$pre]['name'];
			$file_size = $_FILES[$pre]['size'];
			$file_type = $_FILES[$pre]['type'];	 
			$file_tmp_name = $_FILES[$pre]['tmp_name'];
			//$file_new_name=$path.$id.$file_name;
			if( $type == "img" )
				$file_new_name=$path.$id.$n.".jpg";
			if( $type == "pdf" ){
				$file_new_name=$path.$file_name.$n;//$path.$id.$n.".pdf";
			}

			if ($debug) echo "<br>$type -> $file_name : $file_type es de tipo: $type<br>";
			if ($type=="img") if (substr($file_type, 0, 6) != "image/" ) {echo "<br>!!! $type -> $file_name : $file_type"; return false;}
			if ($type=="pdf") if ($file_type!="application/download" &&  $file_type!="application/x-zip-compressed" &&  $file_type!="application/pdf" && $file_type!="application/x-pdf"  ) {echo "<br>!!!pdf $type -> $file_name : $file_type"; return false;}
			if ($type=="mm") if ($file_type!="application/x-shockwave-flash" ) {echo "<br>!!! $type -> $file_name : $file_type"; return false;}
			if ($debug ) echo"TMP: $file_tmp_name, NUEVO: $file_new_name";
			if ($debug ) echo "<hr>mover $file_tmp_name, $file_new_name <hr>";
			if(move_uploaded_file ($file_tmp_name, $file_new_name)){
				if ($type=="img"){
					$save = '../imagenes/thumbs/'.$id.$n.".jpg";
					$thumb = new thumbnail($file_new_name);
					$thumb -> size_auto();
					$thumb -> save($file_new_name);
					$thumb -> size_width(130);
					$thumb -> jpeg_quality(80);
					$thumb -> save($save);
					echo '<p>Thumbnail Creado</p>';
					echo '<img src="'.$save.'"/>';
				}
				if ($debug ) echo " :::return true";
				return true;
			}else{ 
				if ($debug ) echo " :::return false";
				return false;
			}
		}else return false;
	}/////

}
?>
