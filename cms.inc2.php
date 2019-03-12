<?php
include ('extras/adodb496a/adodb.inc.php');	   # load code common to ADOdb 
class cms{
	protected $conn;
	protected $user;
	protected $db;
	protected $host;
	protected $hoy;
	private $is_local;
	private $ip_visita ;
	private $cid;
	private $tipo;
	private $id;
	private $titulo;
	private $texto;
	private $imagenes;
	public $visitas_unicas;
	public $visitantes;
	public $vhead;
	public $vfoot;
	public $head;
	
	function __construct(){
		global $ADODB_CACHE_DIR;
		$this->user="content2_root";
		$this->db="content2";
		$this->host="localhost";
		$this->conn = ADONewConnection('mysql');  # create a connection
		$this->conn->PConnect('localhost','content2_root','content2_password','content2');# connect to MySQL, agora db
		$ADODB_CACHE_DIR = realpath('.') .  DIRECTORY_SEPARATOR .  "_cms".  DIRECTORY_SEPARATOR . "cache";
		$this->conn->cacheSecs = 3600*2; // cache 2 hours
		$this->hoy=date("Y-m-d" ,time());
		$this->visitantes_activos();
		$this->settipo("undefined");
		$this->titulo ="";
		$this->texto = "";
		$this->vhead = "";
		$this->vfoot = "";
		$this->imagenes = "<p><img src=\"img/imagen.jpg\" alt =\"Mural\"/></p>";
		$locales = array("::1","127.0.0.1","192.168.100.254","148.208.246.21","289.132.50.62");
		if (in_array($this->ip_visita, $locales)) $this->is_local= true;
		else $this->is_local= false;		
	}
	function __destruct(){	}
	public function debug($edo = true){
		$this->onn->debug=$edo;
	}
	private function isnew( $fecha_n, $nuevo){
		list( $agno, $mes, $dia ) = split( '-', $fecha_n);
		$fecha_act=date("Y-m-d" ,time());
		$fecha_lim = date("Y-m-d", mktime(0,0,0,$mes , $dia + ($nuevo-1) ,$agno )  ); 
		if ( $fecha_act <= $fecha_lim) return "<img src=\"img/nuevorojo.gif\" alt =\"Nuevo\" />";
		return "";
	}
	public function encuestas(){
		if(isset($_POST["opcion"]) ){
			$op = $_POST["opcion"];
			if ($op=='a' ||$op=='b' ||$op=='c' ||$op=='d'){
			//crear cadena y guardar en bd
				$sql = "UPDATE encuestas SET $op = $op+1;";
				$this->conn->Execute($sql);
			}
		}
		$sql="SELECT *, a+b+c+d AS suma FROM encuestas ORDER BY id DESC LIMIT 1;";
		$recordSet = &$this->conn->Execute($sql);
		echo '<div id="encuestas">'."\n";
		echo '<p>'."\n";
		echo '                <form method="post" action="">' . utf8_encode($recordSet->fields["pregunta"]) . '<br />'."\n";
		if($recordSet->fields["oa"]) echo '				<input type="radio" name="opcion" value="a"/>' . $recordSet->fields["oa"] . '<br />'."\n";
		if($recordSet->fields["ob"]) echo '				<input type="radio" name="opcion" value="b"/>' . $recordSet->fields["ob"] . '<br />'."\n";
		if($recordSet->fields["oc"]) echo '				<input type="radio" name="opcion" value="c"/>' . $recordSet->fields["oc"] . '<br />'."\n";
		if($recordSet->fields["od"]) echo '				<input type="radio" name="opcion" value="d"/>' . $recordSet->fields["od"] . '<br />'."\n";
		echo '                <br/>'."\n";
		echo '                <input type="submit" value="VOTAR"/>'."\n";
		echo '                </form>'."\n";
		echo '                <br />'."\n";
		echo '                Resultados:<br />'."\n";
		if($recordSet->fields["a"]) echo '                ' . $recordSet->fields["oa"] . ' ' . $recordSet->fields["a"] . ' votos ='  . number_format($recordSet->fields["a"]*100 / $recordSet->fields["suma"] ,2) . ' %<br />'."\n";
		if($recordSet->fields["b"]) echo '                ' . $recordSet->fields["ob"] . ' ' . $recordSet->fields["b"] . ' votos ='  . number_format($recordSet->fields["b"]*100 / $recordSet->fields["suma"] ,2) . ' %<br />'."\n";
		if($recordSet->fields["c"]) echo '                ' . $recordSet->fields["oc"] . ' ' . $recordSet->fields["c"] . ' votos ='  . number_format($recordSet->fields["c"]*100 / $recordSet->fields["suma"] ,2) . ' %<br />'."\n";
		if($recordSet->fields["d"]) echo '                ' . $recordSet->fields["od"] . ' ' . $recordSet->fields["d"] . ' votos ='  . number_format($recordSet->fields["d"]*100 / $recordSet->fields["suma"] ,2) . ' %<br />'."\n";
		echo '                </p>'."\n";
		echo '            </div>'."\n";
	
	}
	public function tecavisos(){
		$sql="SELECT id, titulo, fecha, nuevo FROM anuncio WHERE fecha <= '$this->hoy' ORDER BY fecha  DESC LIMIT 10; ";
		$RS = $this->conn->Execute($sql);
		if (!$RS) {
				print $conn->ErrorMsg();
		}if($RS->RecordCount()==0){
				echo "<p> AVISOS  NO DISPONIBLES</p>";
		}else{
			echo "<table width=\"200\" border=\"0\">";
			while (!$RS->EOF) {
				$new = $this->isnew($RS->fields["fecha"],$RS->fields["nuevo"]); 
				echo "<tr><td width=\"30\" align=\"right\" valign=\"top\" ><img src=\"img/info.gif\" alt=\"info\"/></td>";
				echo "<td width=\"160\"><a href=\"contenido.php?anuncio=" . $RS->fields["id"] . "\">" . htmlentities($RS->fields["titulo"]) . "</a>$new<br/><hr /></td></tr>";
				$RS->MoveNext();
			}
			echo "</table>";
			echo "<p>&nbsp;</p><p>SI DESEAS VER TODOS LOS ANUNCIOS&nbsp;<a href=\"contenido.php?anuncios=1\">CLICK AQUI</a></p>";
		}	
	}
	public function tecnoticias(){
		$sql="SELECT id, fecha, titulo, nuevo, img1, p01  FROM noticia  WHERE fecha <= '$this->hoy'  ORDER BY fecha  DESC LIMIT 5;";
		$RS = $this->conn->Execute($sql);
		if (!$RS) {
			print $conn->ErrorMsg();
		}if($RS->RecordCount()==0){
	        echo "<br/>$sp ULTIMAS NOTICIAS NO DISPONIBLES";
		}else{
		    $i=1;
		    //Colocando la Noticia más Reciente
		    echo "Hola<br />";
		    $imagen = $RS->fields["img1"];
		    $texto = substr($RS->fields["p01"], 0,380);
		    $x=strlen($texto)-1;
		    if($x<0)$x=1;
			while($texto[$x] != " " && $x > 0 ){$texto[$x]="."; $x--;} ;
		    echo '<div class="c5"><p align="center"><a href="contenido.php?noticia='. $RS->fields["id"] .'"><img src="imagenes/normal/'.$imagen.'" alt="Foto" width="380" border="0px"/></a></p>';
		    echo '<p class="c3">'. htmlentities( $RS-> fields["titulo"] ).'</p>';
		    echo '<div class="c4">'.$texto .'<a href="contenido.php?noticia=' . $RS->fields["id"] . '">Ver m&aacute;s&nbsp;&raquo;</a></p></div>';
		    echo '</div>';
		    echo "\n<!-- MoveNext -->";
		    $RS->MoveNext();
		    // Colocando las Otras noticias
		    echo "\n<table width=\"440\" border=\"0\" style=\"margin:auto;\">";
		    echo "<!-- EOF -->";
		    while (!$RS->EOF) {
			    echo "<!-- isnew -->";		
				$new = $this->isnew($RS->fields["fecha"],$RS->fields["nuevo"]); 
				echo "<!-- isnew = $new -->";		
				$imagen = $RS->fields["img1"];
				echo "<!-- imagen = $imagen  -->";		
				if($imagen=="")$imagen="2_c_tec1.jpg";
				$texto = substr($RS->fields["p01"], 0,280);
				echo "\n<!-- texto = $texto-->";		
				$x=strlen($texto)-1;
				//$x=279;
				while($texto[$x] != " " && $x>0 ){$texto[$x]="."; $x--;} ;
				printf ( "<tr><td width=\"130\" height=\"120\" style=\"text-align:right;padding-right:5px;\">", 20);
				echo "<a href=\"contenido.php?noticia=" . $RS->fields["id"] . "	\"><img src=\"imagenes/thumbs/$imagen\" border=\"0px\" align=\"right\" alt=\"$imagen\"/></a></td>";
				echo ( "<td style=\"text-align:justify;\"><p><a href=\"contenido.php?noticia=" . $RS->fields["id"] . "\">". htmlentities( $RS->fields["titulo"]) ."</a></p>".htmlentities($texto)."<a href=\"contenido.php?noticia=" . $RS->fields["id"] . "	\">Ver m&aacute;s&nbsp;&raquo;</a></p>"."</td></tr>");
				$i++;
				$RS->MoveNext();
			}
			echo "</table>";
			echo "<br/>SI DESEAS VER LAS TODAS LAS NOTICIAS <a href=\"contenido.php?noticias=1\">CLICK AQUI</a>";
		}
	//echo "    </p>";
	}	
	public function visitantes_activos() {
		// Tomamos la ip del visitante
		$this->ip_visita = $_SERVER['REMOTE_ADDR'];
		//Momento actual
	    $ahora = time();

		//borramos los registros de las ip inactivas
	    $limite = $ahora-500;
	    $sql = "delete from visitas where fecha < ".$limite;
		$this->conn->Execute($sql);
		
	    //miramos si el ip del visitante existe en nuestra tabla
	    $sql = "select ip, fecha from visitas where ip = '$this->ip_visita'";
		$RS = $this->conn->Execute($sql);
		if (!$RS) {
			print $conn->ErrorMsg();
		}elseif($RS->RecordCount()!=0){
		    //si existe actualizamos el campo fecha	
			$sql = "update visitas set fecha = ".$ahora." where ip = '$this->ip_visita'";
		}else{
			//si no existe insertamos el registro correspondiente a esta visita
			$sql = "insert into visitas (ip, fecha) values ('$this->ip_visita', $ahora)";
		}
		$this->conn->Execute($sql);
	    //contamos el numero de visitas activas
	    $sql = "select ip from visitas";

		$RS = $this->conn->Execute($sql);
		if (!$RS) {
			print $conn->ErrorMsg();
		}else $this->visitantes = $RS->RecordCount();
	 }
	// Vemos el numero de visitantes activos
	//$visact = visitantes_activos();
	public function printact(){
		echo "<img src=\"img/users.gif\" alt=\"user\" />"; 
		if ($this->visitantes == 1){
			echo "Hay $this->visitantes usuario";
		}else{
			echo "Hay $this->visitantes usuarios";
		}
	}
	public function printnum(){
		$visita = strrev($this->visitas_unicas);
		for ( $i=6 ; $i >=0; $i-- ){
			if(substr($visita, $i, 1)=='')$numextraido = 0;
			else $numextraido = substr($visita, $i, 1);
			echo'<img src="img/numeros/'.$numextraido.'.jpg" alt="'.$numextraido.'" />';
		}
	}
	public function send_cookies(){
	}
	public function unicas($visitas_unicas){
		$this->visitas_unicas=$visitas_unicas;
	}
	public function encabezado( $normal = true ){

		$cad = "";
		$cad = $cad . '	  <div class="date">' . "\n";
		$cad = $cad . '	    <div class="ittg"> ' . "\n";
		if ( !$normal ){
			$cad = $cad . '	      <a href="http://www.ittg.edu.mx/index.php"><img src="img/ittg2.jpg" alt="ITTG" width="600" height="25" border="0" style=" padding-top:15px;" /></a> ' . "\n";
	    }
		$cad = $cad . '		</div>' . "\n";
		$cad = $cad . '	    <div class="fecha">' . "\n";
		$cad = $cad . '	      <p><strong>Fecha</strong></p>' . "\n";
		$cad = $cad . '	      <div id="capaFecha"><script language="javascript" src="extras/js/fecha.js" type="text/javascript"></script></div>' . "\n";
		$cad = $cad . '	    </div>' . "\n";
		$cad = $cad . '	    <div class="Hora"> ' . "\n";
		$cad = $cad . '	      <p><strong>Hora</strong></p>' . "\n";
		if($this->is_local) $cad = $cad . '	      <div id="capa_reloje" ></div>' . "\n";
		else $cad = $cad . '	      <div id="capa_reloj" ></div>' . "\n";
		$cad = $cad . '	    </div>' . "\n";
		$cad = $cad . '	  </div>' . "\n";
		echo $cad;
	}
	
	protected function cl($cadena){
		$l = strlen($cadena);
		if ($l < 14) return "";
		if ($l > 13 && $l < 30 ) return "l";
		if ($l > 29) return "x";
	}
	protected function cl2($cadena){
		$l = strlen($cadena);
		//	if ($l < 14) return "";
		if ($l > 13 && $l < 30 ) return "";
		if ($l > 29) return "l";
	}
	public function navegacion( $inicio = true ){
		$time="";
		$wh = " intra = 0 AND ";
		if($this->is_local) $wh = " ";
		//echo "visita:$this->ip_visita";
		//echo $ip . "|$wh";
		$clase = "";
		$extra = "";
		$l = 8;
		$secciones = "SELECT id, titulo, tipo, url FROM entrada WHERE fecha <= '$this->hoy' AND $wh  id_padre = 1 and activo = true ORDER BY orden";
		$descripcion = "SELECT * FROM contenido WHERE id = ";
		$subsecciones =  "SELECT id, titulo, tipo, url from entrada WHERE fecha <= '$this->hoy' AND id_padre = ";
		$subsecciones2 =  " AND activo = true ORDER BY orden;";
		echo "    <div class=\"navigation\">\n";
		//echo "$secciones";
	   	$rsentradas = $this->conn->Execute($secciones);
		if(!$inicio){
			echo "      <p class=\"item1\"><a href=\"index.php\">INICIO</a></p>\n";
		}else{
			echo "      <p class=\"selection\">INICIO</p>\n";
		}
		while (!$rsentradas->EOF) {
			$sqlcadsb=$subsecciones . $rsentradas->fields["id"] . $subsecciones2;
			$rssub = $this->conn->Execute($sqlcadsb);
			$cuantos =  $rssub->RecordCount( );
			echo "<!-- $sqlcadsb = $cuantos -->";
			if($cuantos == 0){
				if($rsentradas->fields["tipo"]==2   )$extra="id="      . $rsentradas->fields["id"];
				if($rsentradas->fields["tipo"]==1000)$extra="iframe2=" . $rsentradas->fields["id"];
				if($rsentradas->fields["tipo"]==999 )$extra="iframe1=" . $rsentradas->fields["id"];
				$clase = "item1" . $this->cl($rsentradas->fields["titulo"]);
				echo "      <p class=\"$clase\"><a href=\"contenido.php?$extra \">" . htmlentities($rsentradas->fields["titulo"]) . "</a></p>\n";
	 		}else{
				$this->cid = $this->cid . "$time" .$rsentradas->fields["id"];
				if($time=="") $time = ",";
				echo "      <div id=\"CollapsiblePanel" . $rsentradas->fields["id"] . "\" class=\"CollapsiblePanel\">\n";
				$clase = "item1" . $this->cl($rsentradas->fields["titulo"]);
				echo "        <div><a class=\"$clase\">&gt;&gt; " .  htmlentities($rsentradas->fields["titulo"]) . "</a></div>\n"; /*<!-- $cuantos -->*/
				echo "        <div class=\"CollapsiblePanelContent\">\n";
				$rsdes = $this->conn->Execute($descripcion . $rsentradas->fields["id"] . ";" );
				if ($rsdes ->RecordCount( )!=0)
					echo '<p class="item2"><a href="contenido.php?id=' . $rsentradas->fields["id"] . "\">Descripci&oacute;n</a></p>\n";
					
				while (!$rssub->EOF) {	 
					if($rssub->fields["tipo"]==2   ) $extra="id="      . $rssub->fields["id"];
					if($rssub->fields["tipo"]==1000) $extra="iframe2=" . $rssub->fields["id"];
					if($rssub->fields["tipo"]==999 ) $extra="iframe1=" . $rssub->fields["id"];
					$clase = "item2" . $this->cl2($rssub->fields["titulo"]);
					echo "          <p class=\"$clase\"><a href=\"contenido.php?$extra \">" . htmlentities($rssub->fields["titulo"]) . "</a></p>\n"; 
					$rssub->MoveNext();
				}
				echo "        </div>\n";
				echo "      </div>\n";
			}
			$rsentradas->MoveNext();
		}
	echo '    <div style="text-align:center"><a href="extras/reporte2.pdf" target="_blank"><img src="img/bannervision2020.png" alt="Chiapas 2020" width="135" height="52"/></a></div>';

		echo '    <p>&nbsp;</p>
	      <p>&nbsp;</p>
	      <p>&nbsp;</p>
	      <div class="c2"></div>
	    </div>';
		$this->navegacion_foot();
	}
	private function navegacion_foot(  ){
		$idq = 0;
		$aid = explode(",", $this->cid);
		if( $this->id != ","){
			$quien = "SELECT id_padre FROM entrada WHERE id  = $this->id ;";
			$rsquien = $this->conn->Execute($quien);
			$idq  = $rsquien -> fields["id_padre"] ;
		}		
		echo "\n<script type=\"text/javascript\">\n";
		echo "//<![CDATA[\n"."<!--\n";
		echo "//CAD:" . $this->cid . "\n";
		echo "//elementos:" . count($aid) . "\n";
		for($i = 0; $i<count($aid); $i++){
			if ( ($idq ==	$aid[$i] && $quien != "") || ($this->id == $aid[$i]) ) $edo = "true";	else $edo = "false";
			echo "var CollapsiblePanel" . $aid[$i] . " = new Spry.Widget.CollapsiblePanel(\"CollapsiblePanel" . $aid[$i] . "\", {contentIsOpen:$edo, duration:100});\n";
		}
		echo "//-->\n"."//]]>\n";
		echo "</script>\n";
	}
	public function settipo($tipo="noticia", $id=-1){ $this->tipo = $tipo; $this->id = $id; }
	public function cargar(){
		if($this->tipo == "contacto" ) {
			$this->cargar_contacto();
			return;
		}
		if($this->tipo == "anuncios" ) {
			$this->cargar_anuncios();
			return;
		}
		if($this->tipo == "noticias" ) {
			$this->cargar_noticias();
			return;
		}
		if($this->tipo == "email" ) {
			$this->cargar_comentario();
			return;
		}
		
		if ($this->id == -1 ){
			$this->titulo="ERROR!!!";
			$this->texto="<p>Sin Contenido !!!</p><p><img src=\"img/Warning.gif\" width=\"70\" height=\"66\" alt=\"Error!!\"/></p><p><a href=\"index.php\">Regresar a Inicio</a></p>";
			$this->imagenes="";
			return;
		}
		
		$c2 = " id , titulo , img1 , img2 , img3 , img4 , img5 , img6 , img7 , img8 , img9 , doc1 , doc2 , doc3 , doc4 , ima1 , ima2 , ima3 , ima4 , fecha ,";
		$c2  = $c2 . "CONCAT(fecha , ' - ' , titulo) as tit , p01 ";
		if($this->tipo == "libre" ) $cad= "SELECT *, '' as tit  FROM libre where id =  $this->id ";
		elseif($this->tipo == "anuncio" ) $cad = "SELECT $c2  FROM anuncio where id =  $this->id ";
		elseif($this->tipo == "noticia" ) $cad = "SELECT $c2, nuevo FROM noticia where id = $this->id ";
		elseif($this->tipo == "contenido" ) $cad= "SELECT *, '' as tit FROM contenido where id =  $this->id ";
		elseif($this->tipo == "propuesta" ) $cad= "SELECT *, '' as tit FROM propuesta where idc =  $this->id ";
		
		if($this->tipo == "propuesta" ){
			$pimg = "pimagenes";
			$pdoc = "pdocumentos";
		}else{
			$pimg = "imagenes";
			$pdoc = "documentos";		
		}
//		$pimg = "imagenes/thumbs/";// . DIRECTORY_SEPARATOR;
		$r = $this->conn->Execute($cad);
		//cargar titulo
		$this->titulo = "<center><strong>" . htmlentities($r->fields["tit"]) . "</strong></center><br />";

		//cargar contenido
		$txt="";
		$cad = $r->fields["p01"];  $p0 =0; 	$pl=strlen($cad);	$pt  = strpos ($cad, "[_", $p0);
		while(  !( $pt === false )	  ){	
			$txt = $txt . substr($cad, $p0,($pt-$p0) );
			$tag = substr($cad,$pt,5);
			if($tag[2]=='i'){
				$n="ima".$tag[3];
				$txt = $txt . "<img src=\"$pimg/normal/".$r->fields[$n]."\" width=\"560\" alt=\"".$r->fields[$n]."\" class=\"imagenTexto\"/>";
			}else{
				$n="doc".$tag[3];
				$txt = $txt . "<a href=\"$pdoc/".$r->fields[$n]."\" target=\"_blank\">aqu&iacute;</a>";	
				//		echo "<embed src=\"documentos/$r[$n]\" width=\"493\" height=\"249\" ></embed>";	
			}
			$p0=$pt + 5;
			$pt  = strpos ($cad, "[_", $p0);
		}
		if($p0<$pl) $txt = $txt . substr($cad, $p0, $pl);	
		$this->texto  = $txt ;
		$txt ="";
		
		
		// cargar imagenes
		$i=0;
		$tamagno="width=\"120\"";
		
		for($j=1; $j<=9; $j++){
			$link1 = '<a href="'.$pimg.'/normal/'. $r->fields["img$j"] . '" rel="lightbox[panel]">'; $link2 = '</a>';
			if(isset($r->fields["img$j"])){ 
				$txt = $txt . "<p> $link1 <img src=\"$pimg/thumbs/".$r->fields["img$j"] . "\" $tamagno alt=\"Foto$j\"/> $link2 </p>"; $i++;
			}
		}
		if(!$i){ $txt = $txt . "<p><img src=\"img/imagen.jpg\" alt=\"imagen\"/></p>"; }
		$this->imagenes = $txt;
	}
	public function tit(){ echo $this->titulo; }
	public function txt(){ echo $this->texto; }
	public function img(){ echo $this->imagenes; }
	public function head(){
		switch ($this->tipo){
			case "contacto":
				$cad = "\n";
				$cad = $cad . '<script src="extras/SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>'."\n";
				$cad = $cad . '<script src="extras/js/relojdhtml.js" type="text/javascript"></script>'."\n";
				$cad = $cad . '<script src="extras/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>'."\n";
				$cad = $cad . '<script src="extras/SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>'."\n";
				$cad = $cad . '<link rel="shortcut icon"  href="http://www.ittg.edu.mx/img/favicon.ico"/>'."\n";
				$cad = $cad . '<link rel="stylesheet" href="extras/css/lightbox.css" type="text/css" media="screen" />'."\n";
				$cad = $cad . '<link href="extras/SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />'."\n";
				$cad = $cad . '<link href="extras/css/style.css" rel="stylesheet" type="text/css" />'."\n";
				$cad = $cad . '<link href="extras/css/contenido.css" rel="stylesheet" type="text/css" />'."\n";
				$cad = $cad . '<link href="extras/css/pre.css" rel="stylesheet" type="text/css" />'."\n";
				$cad = $cad . '<link href="extras/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />'."\n";
				$cad = $cad . '<link href="extras/SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />'."\n";
				break;
			default:
			case "iframe1":
			case "iframe2":
			case "libre":
			case "anuncio":
			case "noticia":
			case "contenido":
				$cad = "\n";
				$cad = $cad . '<script src="extras/SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>'."\n";
				$cad = $cad . '<script src="extras/js/relojdhtml.js" type="text/javascript"></script>'."\n";
				$cad = $cad . '<script src="extras/js/prototype.js" type="text/javascript"></script>'."\n";
				$cad = $cad . '<script src="extras/js/scriptaculous.js?load=effects" type="text/javascript"></script>'."\n";
				$cad = $cad . '<script src="extras/js/lightbox.js" type="text/javascript"></script>'."\n";
				$cad = $cad . '<link rel="shortcut icon"  href="http://www.ittg.edu.mx/img/favicon.ico"/>'."\n";
				$cad = $cad . '<link rel="stylesheet" href="extras/css/lightbox.css" type="text/css" media="screen" />'."\n";
				$cad = $cad . '<link href="extras/SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />'."\n";
				$cad = $cad . '<link href="extras/css/style.css" rel="stylesheet" type="text/css" />'."\n";
				$cad = $cad . '<link href="extras/css/contenido.css" rel="stylesheet" type="text/css" />'."\n";
				$cad = $cad . '<link href="extras/css/pre.css" rel="stylesheet" type="text/css" />'."\n";
				break;
		}
		echo $cad;
	}
	public function url($id=-1){
		if ($id==-1){ return "about:blank";}
		$cad = "select url from entrada where id = $id;";
		$r = $this->conn->Execute($cad);
		return $r->fields["url"];
	}
	public function cargar_noticias(){
		$cad = "\n"; 	
	//////////////
		$registros = 10;
		$pagina = $this->id;
		$inicio = ( $pagina - 1) * $registros; 
		$trs =  $this->conn->Execute("select * from noticia;");
		$total_registros = $trs->RecordCount( );
		$RS = $this->conn->Execute("SELECT id,  fecha, titulo FROM noticia ORDER BY fecha DESC LIMIT $inicio, $registros ;");
		$total_paginas = ceil($total_registros / $registros); 
		if (!$RS) {
			print $conn->ErrorMsg();
		}if($RS->RecordCount()==0){
			$cad = $cad . "NO TENGO LISTA DE NOTICIAS!";
		}else{
			$cad = $cad .  "<center><H1>LISTADO DE NOTICIAS</H1>\n<br />";
			$cad = $cad .  "<table border = '1'> \n";
			$cad = $cad .  "<tr>\n";
			$cad = $cad .  "<td>FECHA</td>\n";
			$cad = $cad .  "<td>TITULO</td>\n";
			$cad = $cad .  "</tr>\n";
			$contador=($pagina - 1) * $registros;
			while (!$RS->EOF) {
				$cad = $cad .  "<tr> \n";
				++$contador;
				$cad = $cad .  "<td>".$RS->fields["fecha"]."</td> \n";
				$cad = $cad .  "<td><a href=\"contenido.php?noticia=" . $RS->fields["id"] . "\">" . htmlentities ( $RS->fields["titulo"] ) . "</a></td> \n";
				$cad = $cad .  "</tr> \n";
				$RS->MoveNext();
			}
			$cad = $cad .  "</table>\n<br /><hr />\n";
			if(($pagina - 1) > 0) 	$cad = $cad .  "<a href='contenido.php?noticias=".($pagina-1)."'>&lt;&lt; Anterior</a> "; 
			for ($i=1; $i<=$total_paginas; $i++)
			if ($pagina == $i) 	$cad = $cad .  "<b>[".$pagina."]</b> "; 
			else $cad = $cad .  "<a href='contenido.php?noticias=$i'>$i</a> "; 
			if(($pagina + 1)<=$total_paginas)  $cad = $cad .  " <a href='contenido.php?noticias=".($pagina+1)."'>Siguiente &gt;&gt;</a>"; 
			$cad = $cad .  "</center>";
		}	
	//////////////
		$this->texto  = $cad;
	}
	public function cargar_anuncios(){
		$cad = "\n";
////////////////////////////		
		$registros = 10;
		$pagina = $this->id;
		$inicio = ( $pagina - 1) * $registros; 
        $trs =  $this->conn->Execute("select * from anuncio;");
        $total_registros = $trs->RecordCount( );
		$RS = $this->conn->Execute("SELECT id,  fecha, titulo FROM anuncio ORDER BY fecha DESC LIMIT $inicio, $registros ;");
		$total_paginas = ceil($total_registros / $registros); 
		if (!$RS) {
			print $conn->ErrorMsg();
		}if($RS->RecordCount()==0){
				$cad = $cad . "NO TENGO LISTA DE ANUNCIOS!";
		}else{
			$cad = $cad . "<h1>LISTADO DE ANUNCIOS</h1>\n";
			$cad = $cad . "<table border = '1'> \n";
			$cad = $cad . "<tr>\n";
			$cad = $cad . "<td>FECHA</td>\n";
			$cad = $cad . "<td>TITULO</td>\n";
			$cad = $cad . "</tr>\n";
			$contador=($pagina - 1) * $registros;
			while (!$RS->EOF) {
				$cad = $cad . "<tr> \n";
				++$contador;
				$cad = $cad . "<td>".$RS->fields["fecha"]."</td> \n";
				$cad = $cad . "<td><a href=\"contenido.php?anuncio=" . $RS->fields["id"] . "\">" . htmlentities ($RS->fields["titulo"]) . "</a></td> \n";
				$cad = $cad . "</tr> \n";
				$RS->MoveNext();
			}
			$cad = $cad . "</table><hr><div style=\"text-align:center\"\n";
			if(($pagina - 1) > 0) 	$cad = $cad . "<a href='contenido.php?anuncios=".($pagina-1)."'>< Anterior</a> "; 
			for ($i=1; $i<=$total_paginas; $i++)
			if ($pagina == $i)$cad = $cad . "<strong>".$pagina."</strong> "; 
			else $cad = $cad . "<a href='contenido.php?anuncios=$i'>$i</a> "; 
			if(($pagina + 1)<=$total_paginas)  $cad = $cad . " <a href='contenido.php?anuncios=".($pagina+1)."'>Siguiente ></a>"; 
			$cad = $cad . "</div>";
		}
//////////////////		
		$this->texto  = $cad;
	}
	private function generateRandString($numChars){
		$chars = "aabbccddeeffgghhjjkkmmnnppqqrrssttuuvvwwxxyyzx23456789";
		$charsCount = strlen($chars) - 1;
		$randString = "";
		for ($i=0; $i < $numChars; $i++){
		$num = rand(0, $charsCount);
		$randString .= $chars[$num];
		}
		return $randString;
	}
	public function cargar_contacto(){
	session_start();
	if (! isset($_SESSION["passtxt"])){
		$_SESSION["passtxt"] =  $this->generateRandString(4);
	}else 	$_SESSION["passtxt"] =  $this->generateRandString(4);

	
		$this->titulo = "<center><strong>Contactanos<BR></strong></center>";	

		//$this->vhead = $cad;

		$cad = "\n";
		$cad = $cad . '<script type="text/javascript">'."\n";
		$cad = $cad . '<!--'."\n";
		$cad = $cad . 'var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {hint:"Nombre", maxChars:60, validateOn:["blur"]});'."\n";
		$cad = $cad . 'var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {hint:"Titulo", maxChars:60, validateOn:["blur"]});'."\n";
		$cad = $cad . 'var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"], counterId:"countsprytextarea1", hint:"Tu comentario es requerido, \xF3 \xBFpiensas que \xE9sta p\xE1gina es excelente?"});'."\n";
		$cad = $cad . 'var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email", {hint:"nombre@servidor.com", validateOn:["blur"]});'."\n";
		$cad = $cad . 'var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});'."\n";
		$cad = $cad . '//-->'."\n";
		$cad = $cad . '</script>'."\n";
		$this->vfoot = $cad;

		$cad = "\n";
		$cad = $cad . '        <form method="POST" name="encuesta"  action="contenido.php">' . "\n";
		$cad = $cad . '          <table border="0" cellpadding="0" cellspacing="0">' . "\n";
		$cad = $cad . '            <tr>' . "\n";
		$cad = $cad . '              <td width="162" height="30" valign="top"><p>NOMBRE COMPLETO</p></td>' . "\n";
		$cad = $cad . '              <td width="398" valign="top"><span id="sprytextfield1">' . "\n";
		$cad = $cad . '                <label>' . "\n";
		$cad = $cad . '                <input name="nombre" type="text" id="nombre" size="50" maxlength="60" />' . "\n";
		$cad = $cad . '                </label>' . "\n";
		$cad = $cad . '                <p> <span class="textfieldRequiredMsg">Tu nombre es Necesario.</span><span class="textfieldMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></p>' . "\n";
		$cad = $cad . '                </span>' . "\n";
		$cad = $cad . '                <p>&nbsp;</p></td>' . "\n";
		$cad = $cad . '            </tr>' . "\n";
		$cad = $cad . '            <tr>' . "\n";
		$cad = $cad . '              <td height="30"><p>TITULO &nbsp;(TEMA)</p></td>' . "\n";
		$cad = $cad . '              <td valign="top"><span id="sprytextfield2">' . "\n";
		$cad = $cad . '                <label>' . "\n";
		$cad = $cad . '                <input name="titulo" type="text" id="titulo" size="50" maxlength="60" />' . "\n";
		$cad = $cad . '                </label>' . "\n";
		$cad = $cad . '                <p> <span class="textfieldRequiredMsg">Se necesita un Titulo.</span><span class="textfieldMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></p>' . "\n";
		$cad = $cad . '                </span></td>' . "\n";
		$cad = $cad . '            </tr>' . "\n";
		$cad = $cad . '            <tr>' . "\n";
		$cad = $cad . '              <td valign="top"><p>COMENTARIO</p></td>' . "\n";
		$cad = $cad . '              <td valign="top"><span id="sprytextarea1">' . "\n";
		$cad = $cad . '                <label>' . "\n";
		$cad = $cad . '                <textarea name="comentario" id="comentario" cols="50" rows="5"></textarea>' . "\n";
		$cad = $cad . '                <span id="countsprytextarea1">&nbsp;</span> </label>' . "\n";
		$cad = $cad . '                <p> <span class="textareaRequiredMsg">Tu Comentario es Necesario.</span></p>' . "\n";
		$cad = $cad . '                </span>' . "\n";
		$cad = $cad . '                <p>&nbsp;</p></td>' . "\n";
		$cad = $cad . '            </tr>' . "\n";
		$cad = $cad . '            <tr>' . "\n";
		$cad = $cad . '              <td height="30" valign="top"><p>E-MAIL</p></td>' . "\n";
		$cad = $cad . '              <td valign="top"><span id="sprytextfield3">' . "\n";
		$cad = $cad . '                <label>' . "\n";
		$cad = $cad . '                <input name="email" type="text" id="email" size="50" />' . "\n";
		$cad = $cad . '                </label>' . "\n";
		$cad = $cad . '                <p> <span class="textfieldRequiredMsg">Es necesario llenar este campo.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></p>' . "\n";
		$cad = $cad . '                </span></td>' . "\n";
		$cad = $cad . '            </tr>' . "\n";
		$cad = $cad . '            <tr>' . "\n";
		$cad = $cad . '              <td><p>REPITA EL TEXTO:</p>' . "\n";
		$cad = $cad . '                <p> <img src= "extras/getImage.php?t=passtxt" /></p></td>' . "\n";
		$cad = $cad . '              <td><span id="sprytextfield4">' . "\n";
		$cad = $cad . '                <label>' . "\n";
		$cad = $cad . '                <input type="text" name="txtpasstxt" id="txtpasstxt" />' . "\n";
		$cad = $cad . '                </label>' . "\n";
		$cad = $cad . '                <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>' . "\n";
		$cad = $cad . '            </tr>' . "\n";
		$cad = $cad . '          </table>' . "\n";
		$cad = $cad . '          <p>&nbsp; </p>' . "\n";
		$cad = $cad . '          <p>' . "\n";
		$cad = $cad . '            <input name="submit" type="submit" value="Siguiente">' . "\n";
		$cad = $cad . '          </p>' . "\n";
		$cad = $cad . '          <p>&nbsp;</p>' . "\n";
		$cad = $cad . '        </form>' . "\n";
		$this->texto  = $cad;
	}
	public function validation_foot(){
		echo $this->vfoot;
	}
	/*
	public function validation_head(){
		echo $this->vhead;
	}
	*/
	public function google_analytics(){
		$cad = "";
		if(! $this->is_local ){			 
			$cad = $cad . '<script type="text/javascript">'."\n";
			$cad = $cad . "//$this->ip_visita\n";
			$cad = $cad . "//<![CDATA[ \n <!-- \n // GOOGLE Analytics -- Inicio \n";
			$cad = $cad . '	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");'."\n";
			$cad = $cad . "	document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));\n"."//--> \n //]]>\n";
			$cad = $cad . '</script>'."\n";
			$cad = $cad . "<script type=\"text/javascript\">"."\n";
			$cad = $cad . "//<![CDATA[ \n <!--\n	var pageTracker = _gat._getTracker(\"UA-3680175-1\");\n";
			$cad = $cad . '	pageTracker._initData();'."\n";
			$cad = $cad . '	pageTracker._trackPageview();'."\n";
			$cad = $cad . "// Fin"."//--> \n //]]>"."\n";
			$cad = $cad . '</script>'."\n";
		}
		echo $cad;
	}
	public function anunciosg(){
		$sql="SELECT * FROM anunciog WHERE fecha <= '$this->hoy' ORDER BY fecha  DESC LIMIT 10; ";
		$RS = $this->conn->Execute($sql);
		if (!$RS) {
				print $conn->ErrorMsg();
		}else{
			while (!$RS->EOF) {
				if ($RS->fields["tipo"]=="2") $parametro ="contenido";
				if ($RS->fields["tipo"]=="999") $parametro ="iframe1";
				if ($RS->fields["tipo"]=="1000") $parametro ="iframe2";
				if ($RS->fields["tipo"]=="3") $parametro ="anuncio";
				if ($RS->fields["tipo"]=="4") $parametro ="noticia";
				$img = $RS->fields["img"];
				$tit = $RS->fields["titulo"];
				echo "<a href=\"contenido.php?$parametro=" . $RS->fields["id"] . "\">" ;
				echo "<img src=\"imagenes/normal/$img\" alt=\"$tit\" width=\"140\" height=\"30\" border=\"0\" longdesc=\"$tit\" /></a><br />\n";
				$RS->MoveNext();
			}
		}	

	}
//	public function cargar_comentario($email, $titulo, $comentario, $nombre, $txtval){
	public function cargar_comentario(){
		session_start();
		$imageText = $_SESSION["passtxt"];
		session_unset();
		session_destroy();
 		$ok=true;
		if ( $imageText == $_POST["txtpasstxt"] ){
			if(isset($_POST["email"])) $email = htmlentities ($_POST["email"]);
			else $ok = false;
			if(isset($_POST["titulo"])) $titulo = htmlentities ($_POST["titulo"]);
			else $ok = false;
			if(isset($_POST["comentario"])) $comentario = htmlentities ($_POST["comentario"]);
			else $ok = false;
			if(isset($_POST["nombre"])) $nombre = htmlentities ($_POST["nombre"]);
			else $ok = false;
			if($ok){
				$strsql = "INSERT INTO comentario (email, titulo, comentario, nombre, fecha) VALUES ('$email', '$titulo', '$comentario', '$nombre', '$this->hoy');";
				$RS = $this->conn->Execute($strsql);	
				if (!$RS) {
						$this->titulo = "<center><strong>" . $this->conn->ErrorMsg() . "<br /></strong></center>";
				}else{
					$this->titulo = "<center><strong>Gracias por tu comentario.<br /></strong></center>";
					$this->texto  = "<p>Se har&aacute; llegar al web master.</p>" ;
				}
			}else{
				$this->titulo = "<center><strong>Faltan datos.<br /></strong></center>";
				$this->texto  = "<br /><br />INTENTELO DE NUEVO, <a href=\"javascript:history.go(-1)\">REGRESAR...</A><br/>";
			}
		}else {
			$this->titulo = "<center><strong>Validaci&oacute;n incorrecta $imageText.<br /></strong></center>";
			$this->texto  = "<br /><br />INTENTELO DE NUEVO, <a href=\"javascript:history.go(-1)\">REGRESAR...</a><br/>";
		}
		
	}
}
?>
