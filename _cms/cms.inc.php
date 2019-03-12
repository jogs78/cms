<?php
//ini_set('include_path',ini_get('include_path').';E:\www\extras');  
include ('extras/adodb496a/adodb.inc.php');	   # load code common to ADOdb 
class cms{
	protected $conn;
	protected $user;
	protected $pwd;
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
	private $menu="";
	private $script="";
	private $indent="";
	private $deep=0;
	private $_title="";
	private $_srv = "";
	
	function __construct(){
		$this->_srv =  $_SERVER['SERVER_NAME'] ;
		global $ADODB_CACHE_DIR;
		$this->user="content2_root";
		$this->db="content2";
		$this->pwd="content2_password";
		$this->host="localhost";
		$this->conn = ADONewConnection('mysqli');  # create a connection
		$this->conn->PConnect($this->host,$this->user,$this->pwd,$this->db);# connect to MySQL, agora db
		$ADODB_CACHE_DIR = realpath('.') .  DIRECTORY_SEPARATOR .  "_cms".  DIRECTORY_SEPARATOR . "cache";
		$this->conn->cacheSecs = 3600*2; // cache 2 hours
		$this->hoy=@date("Y-m-d" ,time());
		$this->visitantes_activos();
		$this->settipo("undefined");
		$this->titulo ="";
		$this->texto = "";
		$this->vhead = "";
		$this->vfoot = "";
		$this->imagenes = "<p><img src=\"img/imagen.jpg\" alt =\"Mural\"/></p>";
		$locales = array("::1","127.0.0.1","192.168.100.254","148.208.246.3","148.208.246.10","148.208.246.21","289.132.50.62");
		if (in_array($this->ip_visita, $locales)) $this->is_local= 1;
		else $this->is_local= 0;		
	}
	function __destruct(){	}
	public function debug($edo = true){
		$this->conn->debug=$edo;
	}

	public function title(){
	return $this->_title;
	}
	public function tosearch(){
?>
<script type="text/javascript" >
function hola( formulario ){
formulario.q.value = 'site:www.ittg.edu.mx ' + formulario.q.value; 
return true;
}
</script>
<form action="contenido.php" id="cse-search-box" onSubmit="return hola(this);" >
  <div>
    <input type="hidden" name="cx" value="001027123788979625063:v3enz6auqvs" />
    <input type="hidden" name="cof" value="FORID:9" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="31" />
<br>
<br>
	<input type="radio" value="site" name="donde">EN EL ITTG 
	<input checked  type="radio" value="www" name="donde">EN INTERNET 
    <input type="submit" name="sa" value="Buscar" />
  </div>
</form>
<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&lang=es"></script>
<?php
	}


	private function isnew( $fecha_n, $nuevo){
		list( $agno, $mes, $dia ) = split( '-', $fecha_n);
		$fecha_act=date("Y-m-d" ,time());
		$fecha_lim = date("Y-m-d", mktime(0,0,0,$mes , $dia + ($nuevo-1) ,$agno )  ); 
		if ( $fecha_act <= $fecha_lim) return "<img src=\"img/nuevorojo.gif\" alt =\"Nuevo\" />";
		return "";
	}
	public function encuestas(){
return;
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
		//echo '                <input type="submit" value="VOTAR"/>'."\n";
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
		$sql="SELECT id, titulo, fecha, nuevo FROM anuncio WHERE fecha <= '$this->hoy' ORDER BY fecha  DESC, id DESC LIMIT 10; ";
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
			//echo '<br />    <div style="text-align:center"><a href="informe.pdf" target="_blank"><img src="img/portada_small.jpg" alt="Informe del Director" width="135"/></a></div>';
		}	
	}
	public function tecnoticias(){
		$sql="SELECT id, fecha, titulo, img1, p01,ima1		FROM noticia  WHERE fecha <= '$this->hoy'  ORDER BY fecha DESC, id DESC LIMIT 5;";
		$RS = $this->conn->Execute($sql);
		if (!$RS) {
			print $conn->ErrorMsg();
		}if($RS->RecordCount()==0){
	        echo "<br/>$sp ULTIMAS NOTICIAS NO DISPONIBLES";
		}else{
		    $i=1;
		    //Colocando la Noticia más Reciente
		    $imagen = $RS->fields["img1"];
		    $texto = substr($RS->fields["p01"], 0,380);
		    $x=strlen($texto)-1;
		    if($x<0)$x=1;
			if($imagen =="") $imagen="2_c_1.JPG";
			while($texto[$x] != " " && $x > 0 ){$texto[$x]="."; $x--;} ;
		    echo '<div class="c5"><p align="center"><a href="contenido.php?noticia='. $RS->fields["id"] .'"><img src="imagenes/normal/'.$imagen.'" alt="Foto" width="380" border="0px"/></a></p>';
		    echo '<p class="c3">'. htmlentities( $RS-> fields["titulo"] ).'</p>';
			
			//Una imagen que este dentro de una noticia.
			$auxT = "";
			for( $k = 0; $k < $x; $k++){
				$auxT .= $texto[$k];
				if( $texto[$k+1] === "[" ){
					$aux = "<img src=\"imagenes/normal/".$RS->fields["ima1"]."\" width=\"380px\" border=\"\0px\"/>";
					$auxT .= $aux;
					$k= $k+5;
				}
			}
			$texto = $auxT;
			
		    echo $texto .'<a href="contenido.php?noticia=' . $RS->fields["id"] . '">Ver m&aacute;s&nbsp;&raquo;</a></p></div>';
		    echo "\n<!-- MoveNext -->";
		    $RS->MoveNext();
			
		    // Colocando las Otras noticias
		    echo "\n<table width=\"440\" border=\"0\" style=\"margin:auto;\">";
		    echo "<!-- EOF -->";
		    while (!$RS->EOF) {		
				$imagen = $RS->fields["img1"];
				if($imagen=="")$imagen="2_c_tec1.jpg";
				$texto = substr($RS->fields["p01"], 0,280);
				echo "\n";		
				$x=strlen($texto)-1;
				while($texto[$x] != " " && $x>0 ){$texto[$x]="."; $x--;} ;
				//IMAGEN EN ENCABEZADO DE NOTICIA
				$auxT = "";
				for( $k = 0; $k < $x; $k++){
					$auxT .= $texto[$k];
					if( $texto[$k+1] === "[" ){
						$aux = "<img src=\"imagenes/normal/".$RS->fields["ima1"]."\" width=\"200px\" border=\"\0px\"/>";
						$auxT .= $aux;
						$k=$k+5;
					}
				}
				$texto = $auxT;
							
				printf ( "<tr><td width=\"130\" height=\"120\" style=\"text-align:right;padding-right:5px;\">", 20);
				echo "<a href=\"contenido.php?noticia=" . $RS->fields["id"] . "	\"><img src=\"imagenes/thumbs/$imagen\" border=\"0px\" align=\"right\" alt=\"$imagen\"/></a></td>";
				echo ( "<td style=\"text-align:justify;\"><p><a href=\"contenido.php?noticia=" . $RS->fields["id"] . "\">". htmlentities( $RS->fields["titulo"]) ."</a></p>".$texto."<a href=\"contenido.php?noticia=" . $RS->fields["id"] . "\">Ver m&aacute;s&nbsp;&raquo;</a></p>"."</td></tr>");
				$i++;
				$RS->MoveNext();
			}
			echo "</table><!-- finalizar la tabla-->\n";
			echo "<br/>SI DESEAS VER TODAS LAS NOTICIAS <a href=\"contenido.php?noticias=1\">CLICK AQUI</a>";
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
			$cad = $cad . '	      <a href="http://' . $this->_srv . '/index.php"><img src="img/ittg2.jpg" alt="ITTG" width="600" height="25" border="0" style=" padding-top:15px;" /></a> ' . "\n";
	    }
		$cad = $cad . '		</div>' . "\n";
		$cad = $cad . '	    <div class="fecha">' . "\n";
		$cad = $cad . '	      <p><strong>Fecha</strong></p>' . "\n";
		$cad = $cad . '	      <div id="capaFecha"><script language="javascript" src="extras/js/fecha.js" type="text/javascript"></script></div>' . "\n";
		$cad = $cad . '	    </div>' . "\n";
		$cad = $cad . '	    <div class="Hora"> ' . "\n";
		$cad = $cad . '	      <p><strong>Hora</strong></p>' . "\n";
		//if($this->is_local) $cad = $cad . '	      <div id="capa_reloje" ></div>' . "\n";
		//else $cad = $cad . '	      <div id="capa_reloj" ></div>' . "\n";
		$cad = $cad . '	      <div id="capa_reloj" ></div>' . "\n";
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
	
	protected function item($idi ){
		$id_del_padre = 0 +  $this->conn->GetValue("SELECT id_padre FROM entrada WHERE id = $this->id;") ;
		$id_del_abuelo = 0 + $this->conn->GetValue("SELECT id_padre FROM entrada WHERE id = $id_del_padre;");
		$this->indent .= " ";
		$this->deep++;
		$tb = $this->indent ;
                $wh = " intra = 0 AND ";
                if($this->is_local) $wh = " ";

		$entrada  = "SELECT id, titulo, tipo, url, intra, id_padre FROM entrada WHERE ";
		$entrada .= " fecha <= '$this->hoy' AND $wh  id_padre = $idi and activo = true ORDER BY orden;";		
		
	   	$rsentradas = $this->conn->Execute($entrada);
		while (!$rsentradas->EOF) {
			$idp = $rsentradas->fields["id_padre"];
			//echo $rsentradas->fields["titulo"] . " , " . $rsentradas->fields["tipo"] . "  " ;
			if( $rsentradas->fields["tipo"]!=1){
				if($rsentradas->fields["tipo"]==2 )$extra="id="      . $rsentradas->fields["id"];
				if($rsentradas->fields["tipo"]==5 )$extra="c2="      . $rsentradas->fields["id"];
				if($rsentradas->fields["tipo"]==1000)$extra="iframe2=" . $rsentradas->fields["id"];
				if($rsentradas->fields["tipo"]==999 )$extra="iframe1=" . $rsentradas->fields["id"];
				$clase = "item$this->deep" . $this->cl($rsentradas->fields["titulo"]);
				$this->menu .= "$tb<p class=\"$clase\"><a href=\"contenido.php?$extra\">" . htmlentities($rsentradas->fields["titulo"]) . "</a></p>\n";					
			}else{
			    $ida = $rsentradas->fields["id"];
				$l = strlen($rsentradas->fields["titulo"]);
				if ($this->deep%2) $clase = "item$this->deep" . $this->cl($rsentradas->fields["titulo"]);
				else $clase = "item$this->deep" . $this->cl($rsentradas->fields["titulo"]);
				$titular =  htmlentities($rsentradas->fields["titulo"]) ;
				$sid = $rsentradas->fields["id"];
				$this->menu .= "$tb<div id=\"CollapsiblePanel$sid\" class=\"CollapsiblePanel\"> <!-- this->id:$this->id  idp:$idp ida:$ida pad:$id_del_padre id_abu:$id_del_abuelo-->\n";	
				$this->menu .= "$tb <div class=\"CollapsiblePanelTab\" tabindex=\"0\"><a class=\"$clase\">&gt;&gt;$titular</a></div><!-- $l -->\n";  
				$this->menu .= "$tb <div class=\"CollapsiblePanelContent\">\n";
				$this->item($rsentradas->fields["id"]);
				$this->menu .= "$tb </div>\n";
				$this->menu .= "$tb</div> ";
				$this->menu .= "\n";
				
				if( ($ida == $id_del_padre || $ida == $id_del_abuelo) ||   $this->deep>1  )$edo = "true"; //&&  $this->id == $id_del_padre     $this->deep>1
				else $edo = "false";
				
				$this->script .="var CollapsiblePanel$sid = new Spry.Widget.CollapsiblePanel(\"CollapsiblePanel$sid\", {contentIsOpen:$edo, duration:100}); // id_del_padre $id_del_padre\n";
			}
			$rsentradas->MoveNext();
		}
		$this->deep--;
	}
	public function navegacion2($inicio = true){
		$vez="";
		$wh = " intra = 0 AND ";
		if($this->is_local) $wh = " ";
		$clase = "";
		$extra = "";
		$l = 8;
		//echo "<hr>local: $this->is_local $this->ip_visita<hr>";
		echo "    <div class=\"navigation\"><!-- local: $this->is_local $this->ip_visita -->\n";
		//echo "$secciones";
		if(!$inicio){
			echo "      <p class=\"item1\"><a href=\"index.php\">INICIO</a></p>\n";
		}else{
			echo "      <p class=\"selection\">INICIO</p>\n";
		}
		$this->item(1);
		echo  $this->menu;
		$this->anunciosg("izquierda");
		echo '    <p>&nbsp;</p>
	      <div class="c2"></div>
	    </div>';
		echo "\n<script type=\"text/javascript\">\n";
		echo $this->script;
		echo "</script>\n";
	}
	public function navegacion( $inicio = true ){
		$vez="";
		$wh = " intra = 0 AND ";
		if($this->is_local) $wh = " ";
		//echo "visita:$this->ip_visita";
		//echo $ip . "|$wh";
		$clase = "";
		$extra = "";
		$l = 8;
		$secciones = "SELECT id, titulo, tipo, url FROM entrada WHERE fecha <= '$this->hoy' AND $wh  id_padre = 1 and activo = true ORDER BY orden;";
		$descripcion = "SELECT * FROM contenido WHERE id = ";
		$subsecciones =  "SELECT id, titulo, tipo, url from entrada WHERE fecha <= '$this->hoy' AND id_padre = ";
		$subsecciones2 =  " AND activo = true ORDER BY orden;";
		echo "    <div class=\"navigation\">\n";
		//echo "$secciones";
		if(!$inicio){
			echo "      <p class=\"item1\"><a href=\"index.php\">INICIO</a></p>\n";
		}else{
			echo "      <p class=\"selection\">INICIO</p>\n";
		}
	   	$rsentradas = $this->conn->Execute($secciones);
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
				$this->cid = $this->cid . "$vez" .$rsentradas->fields["id"];
				if($vez=="") $vez = ",";
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
	public function cargar_title(){
                        $sql_v= "SELECT titulo FROM entrada where id = $this->id";
                        $this->_title = htmlentities( $this->conn->GetValue($sql_v ) );
	}
	public function cargar(){
		$deb= "<!-- tipo:$this->tipo;\nid:$this->id;\n";  
		if($this->tipo == "contacto" ) {
			//cuanto entran a la seccion de contactanos y va a escribir su comentario
			$this->_title = "Contactanos";
			$this->cargar_contacto();
			return;
		}
		
		if($this->tipo == "anuncios" ) {
			$this->_title = "Listado de anuncios";		
			$this->cargar_anuncios();
			return;
		}


		
		if($this->tipo == "noticias" ) {
			$this->_title = "Listado de noticias";
			$this->cargar_noticias();
			return;
		}
		if($this->tipo == "email" ) {
			$this->_title = "Comentario recibido";
			$this->cargar_comentario();
			return;
		}
		if($this->tipo == "mapa" ) {
			$this->_title = "Mapa del sitio.";
			$this->fmenu();
			return;
		}
		
		if($this->tipo == "busqueda" ) {
			$this->_title = "Resultados de la busqueda.";
			$this->tosearch2();
			return;
		}

		if ($this->id == -1 ){
			$this->_title = "ERROR!!!";
			$this->titulo="ERROR!!!";
			$this->texto="<p>Sin Contenido !!!</p><p><img src=\"img/Warning.gif\" width=\"70\" height=\"66\" alt=\"Error!!\"/></p><p><a href=\"index.php\">Regresar a Inicio</a></p>";
			$this->imagenes="";
			return;
		}

		$sqlp = "";
		$publicado="";
		
		$fots = " fot0, fot1, fot2, fot3, fot4, fot5, fot6, fot7, fot8, fot9 ";
		$imgs = " img1, img2, img3, img4, img5, img6, img7, img8, img9 ";
		$imas = " ima1, ima2, ima3, ima4 ";
		$docs = " doc1, doc2, doc3 ";
		$c2 = " id , titulo , $imgs , $docs , $imas, $fots , fecha , CONCAT(fecha , ' - ' , titulo) as tit , p01 ";
		$c3 = " id , titulo , $imgs , $docs , $imas, fecha , CONCAT(fecha , ' - ' , titulo) as tit , p01 ";
		if($this->tipo == "libre" ) $cad= "SELECT *, '' as tit  FROM libre where id =  $this->id ";
		elseif($this->tipo == "anuncio" ) $cad = "SELECT $c3, publico		FROM anuncio where id =  $this->id ";
		#elseif($this->tipo == "noticia" ) $cad = "SELECT $c3, nuevo FROM noticia where id = $this->id ";
		elseif($this->tipo == "noticia" ) $cad = "SELECT $c3, publico FROM noticia where id = $this->id ";
		elseif($this->tipo == "contenido" ) $cad= "SELECT *, '' as tit FROM contenido where id =  $this->id ";
		elseif($this->tipo == "conteni2" ) $cad= "SELECT *, '' as tit FROM contenido where id =  $this->id ";
		elseif($this->tipo == "propuesta" ) $cad= "SELECT *, '' as tit FROM propuesta where idc =  $this->id ";
//		echo $cad;
		
		
		if($this->tipo == "propuesta" ){
			$pimg = "pimagenes";
			$pdoc = "pdocumentos";
		}else{
			$pimg = "imagenes";
			$pdoc = "documentos";		
		}
//		$pimg = "imagenes/thumbs/";// . DIRECTORY_SEPARATOR;

		//$this->conn->debug=true;
		$r = $this->conn->Execute($cad);
		$this->conn->debug=false;
		$cad_resp = "";
		if(isset($r->fields["publico"])){
			$sqlpublico="SELECT u.nombre persona, d.nombre departamento FROM usuarios u JOIN departamento d ";
			$sqlpublico=$sqlpublico . "ON u.depto = d.id WHERE u.id = " . $r->fields["publico"] . ";";
			$rsp =  $this->conn->Execute($sqlpublico);
		$cad_resp = "<br><br><br>";
//			$cad_resp = $cad_resp . "<div style=\"text-align:right; border:solid; border:#0000CC\">Responsable de la publicaci&oacute;n: " . htmlentities($rsp->fields["persona"]) . "<br>";
	//		$cad_resp = $cad_resp . "DEPARTAMENTO " .  htmlentities( $rsp->fields["departamento"]) . "</div>";
		}
		

		//cargar titulo
		$this->_title = htmlentities($r->fields["tit"]);
		$this->titulo = "<center><strong>" . htmlentities($r->fields["tit"]) . "</strong></center><br />";

		//cargar contenido
		$txt="";
		$cad = $r->fields["p01"];  $p0 =0; 	$pl=strlen($cad);	$pt  = strpos ($cad, "[_", $p0);
		while(  !( $pt === false )	  ){	
			$txt = $txt . substr($cad, $p0,($pt-$p0) );
			$tag = substr($cad,$pt,5);
			switch($tag[2]){
			case 'i':
				$n="ima".$tag[3];
				$txt = $txt . "<img src=\"$pimg/normal/".$r->fields[$n]."\" width=\"560\" alt=\"".$r->fields[$n]."\" class=\"imagenTexto\"/>";
			break;
			case 'd':
				$n="doc".$tag[3];
				$txt = $txt . "<a href=\"$pdoc/".$r->fields[$n]."\" target=\"_blank\">aqu&iacute;</a>";	
				//		echo "<embed src=\"documentos/$r[$n]\" width=\"493\" height=\"249\" ></embed>";	
			break;
			case 'f':
				$n="fot".$tag[3];
				$link1 = '<a class="cImage" href="'.$pimg.'/normal/'. $r->fields[$n] . '" rel="lightbox[panel]">'; $link2 = '</a>';
				$txt = $txt . "$link1<img src=\"$pimg/thumbs/".$r->fields[$n] . "\" alt=\"Foto\"/>$link2</p>";
//				$n="ima".$tag[3];
//				$txt = $txt . "<img src=\"$pimg/normal/".$r->fields[$n]."\" width=\"560\" alt=\"".$r->fields[$n]."\" class=\"imagenTexto\"/>";
			break;
			
			
			}
			
/*			if($tag[2]=='i'){

			}else{
			}
*/
			$p0=$pt + 5;
			$pt  = strpos ($cad, "[_", $p0);
		}
		if($p0<$pl) $txt = $txt . substr($cad, $p0, $pl);	
		$this->texto  = $txt . $cad_resp ;
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
		if($this->tipo == "contenido" ){
			$sql_v= "SELECT titulo FROM entrada where id = $this->id";
			$this->_title = htmlentities( $this->conn->GetValue($sql_v ) );
		}

		if($this->tipo == "conteni2" ) {
			$sql_v= "SELECT titulo FROM entrada where id = $this->id";
			$this->_title = htmlentities( $this->conn->GetValue($sql_v ) );
			$this->texto = $this->texto . "<br><hr><br>";
					$qry = "SELECT titulo, id, fecha FROM libre WHERE id_contenedor= $this->id";
					//$this->conn->debug=true;
					$c = $this->conn->Execute($qry);
					$this->texto = $this->texto . "<UL>";
					while (!$c->EOF) {		
						$this->texto = $this->texto . "<LI><A href=\"contenido.php?libre=" . $c->fields["id"] . "\">" .  $c->fields["titulo"] . " - " .  $c->fields["fecha"]  . "</A>\n";
						$c->MoveNext();
					}
					$this->texto = $this->texto . "</UL>";
		}
		
	
	
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
	public function anunciosg( $orientacion = "derecha" ){
		$ori = " AND der = 1 " ;
		$tam = 'width="140" height="30"';
		switch ($orientacion){
			case 'izquierda':
				$ori = " AND izq = 1 " ; 
				$tam = 'width="135" ';
				break;
			case 'centro': 
				$tam = 'width="480" ';
				$ori = " AND central = 1 " ; 
				break;
		}
		$sql="SELECT * FROM anunciog WHERE fecha <= '$this->hoy' $ori ORDER BY orden, fecha  DESC LIMIT 10; ";
		$RS = $this->conn->Execute($sql);
		if (!$RS) {
				print $conn->ErrorMsg();
		}else{
			while (!$RS->EOF) {
				$link = $RS->fields["url"];
				if ($RS->fields["tipo"]=="2") $link = 'contenido.php?id=' . $RS->fields["id"];
				if ($RS->fields["tipo"]=="5") $link = 'contenido.php?c2=' . $RS->fields["id"];
				if ($RS->fields["tipo"]=="999") $link = 'contenido.php?iframe1=' . $RS->fields["id"];  
				if ($RS->fields["tipo"]=="1000") $link = 'contenido.php?iframe2=' . $RS->fields["id"];  
				if ($RS->fields["tipo"]=="3") $link = 'contenido.php?anuncio=' . $RS->fields["id"];  
				if ($RS->fields["tipo"]=="4") $link = 'contenido.php?noticia=' . $RS->fields["id"];  
				if ($RS->fields["tipo"]=="2000") $tar = ' target="_blank" ';
				$img = $RS->fields["img"];
				$tit = htmlentities( $RS->fields["titulo"] );
				echo "<a href=\"$link\">" ;
				echo "<img src=\"imagenes/normal/$img\" alt=\"$tit\" $tam border=\"0\" longdesc=\"$tit\" /></a><br><br />\n";
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
//--------------------
	protected function item2($idi ){
		$id_del_padre = 0 +  $this->conn->GetValue("SELECT id_padre FROM entrada WHERE id = $this->id;") ;
		$id_del_abuelo = 0 + $this->conn->GetValue("SELECT id_padre FROM entrada WHERE id = $id_del_padre;");
		$this->indentm .= "&nbsp;&nbsp;&nbsp;";
//		$this->indentm .= "-";
		$this->deep++;
		$tb = $this->indentm ;
                $wh = " intra = 0 AND ";
                if($this->is_local) $wh = " ";

		$entrada  = "SELECT e.id, e.titulo, e.tipo, e.url, e.intra, e.id_padre, c.actualizado FROM entrada e LEFT JOIN contenido c ON e.id = c.id  WHERE ";
		$entrada .= " e.fecha <= '$this->hoy' AND $wh  e.id_padre = $idi and e.activo = 1 ORDER BY e.orden;";		
	   	$rsentradas = $this->conn->Execute($entrada);
			
			//$this->menum .=  "<hr>$entrada<hr>";
			
		while (!$rsentradas->EOF) {
			$idp = $rsentradas->fields["id_padre"];
			//echo $rsentradas->fields["titulo"] . " , " . $rsentradas->fields["tipo"] . "  " ;
			
			if( $rsentradas->fields["tipo"]!=1){
				if($rsentradas->fields["tipo"]==2   )
					{$extra="id="      . $rsentradas->fields["id"]; $ima="<img src=\"img/txt.png\" alt=\"CONTENIDO\" width=\"18\" />";}
				if($rsentradas->fields["tipo"]==1000)
					{$extra="iframe2=" . $rsentradas->fields["id"]; $ima="<img src=\"img/sis.png\" alt=\"CONTENIDO\" width=\"18\" />";}
				if($rsentradas->fields["tipo"]==999 )
					{$extra="iframe1=" . $rsentradas->fields["id"]; $ima="<img src=\"img/sis.png\" alt=\"CONTENIDO\" width=\"18\" />";}
				
				$actu= "";
				$ima ="" ; //buscar porque no tiene nada ima
				$extra ="" ; //buscar porque no tiene nada ima
				if ($rsentradas->fields["actualizado"]!="")	$actu = "ULTIMA ACTUALIZACION: " . $rsentradas->fields["actualizado"];
				$this->menum .= "$tb$ima<a href=\"contenido.php?$extra\">" . htmlentities($rsentradas->fields["titulo"]) . "</a> $actu<br>\n";					
			}else{
				$ima="<img src=\"img/carpeta.png\" alt=\"CONTENIDO\" width=\"18\" />";
			    $ida = $rsentradas->fields["id"];
				$l = strlen($rsentradas->fields["titulo"]);
				//if ($this->deep%2) $clase = "item$this->deep" . $this->cl($rsentradas->fields["titulo"]);
				//else $clase = "item$this->deep" . $this->cl($rsentradas->fields["titulo"]);
				$titular =  htmlentities($rsentradas->fields["titulo"]) ;
				//$sid = $rsentradas->fields["id"];
				//$this->menum .= "$tb<!-- this->id:$this->id  idp:$idp ida:$ida pad:$id_del_padre id_abu:$id_del_abuelo-->\n";	
				$this->menum .= "$tb$ima$titular<br><!--  -->\n";  
				//$this->menum .=  "<hr>item2($ida)<hr>" ;
				$this->item2($ida); //rsentradas->fields["id"]
			}
			$rsentradas->MoveNext();
		}
		$this->deep--;
		return $this->menum;
	}
	public function fmenu(){
		$tit = "<center><h5>MAPA DEL SITIO</h5></center>";
		$vez="";
		$wh = " intra = 0 AND ";
		if($this->is_local) $wh = " ";
		$clase = "";
		$extra = "";
		$l = 8;
		//echo "<hr>local: $this->is_local $this->ip_visita<hr>";
		//echo "$secciones";
		$txt = "<a href=\"index.php\">INICIO</a><br>\n";
		$txt .= $this->item2(1);
		$txt .= "<br/><br/>";
$sql = "SELECT id, titulo FROM libre";
$rsentradas = $this->conn->Execute($sql);
while (!$rsentradas->EOF) {
        $ima="<img src=\"img/txt.png\" alt=\"CONTENIDO\" width=\"18\" />";
        $id=$rsentradas->fields["id"];
        $ti=$rsentradas->fields["titulo"];
        //$txt .= "$tb$ima<a href=\"contenido.php?libre=$id\">" . htmlentities($ti) . "</a><br/>\n";
	$rsentradas->MoveNext();
}


		$this->texto  = '<div class="x">' . $tit . $txt . '</div>' ;
	}


	public function tosearch_2(){
$txt = <<<EOD
<script type="text/javascript">
  var googleSearchIframeName = "cse-search-results";
  var googleSearchFormName = "cse-search-box";
  var googleSearchFrameWidth = 550;
  var googleSearchResizeIframe = false;
  var googleSearchDomain = "www.google.com";
  var googleSearchPath = "/cse";
</script>
<script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>
<script type="text/javascript">
  var ldiv = document.getElementById("cse-search-results");
  var ifrm  = ldiv.firstChild;
  ifrm.width=550;
</script>
EOD;
$this->texto = $txt;
	}

	public function tosearch2(){
                $txt = "";
                $txt .= '<div id="cse-search-results"></div>'."\n";
                $txt .= '<script type="text/javascript">'."\n";
                $txt .= '  var googleSearchIframeName = "cse-search-results";'."\n";
                $txt .= '  var googleSearchFormName = "cse-search-box";'."\n";
                $txt .= '  var googleSearchFrameWidth = 550;'."\n";
		$txt .= '  var googleSearchResizeIframe = true;'."\n";
                $txt .= '  var googleSearchDomain = "www.google.com";'."\n";
                $txt .= '  var googleSearchPath = "/cse";'."\n";
                $txt .= '</script>'."\n";
                $txt .= '<script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>'."\n";

                $txt .= '<script type="text/javascript">'."\n";
                $txt .= '  var ldiv = document.getElementById("cse-search-results");'."\n";
                $txt .= '  var ifrm  = ldiv.firstChild;'."\n";
                $txt .= '  ifrm.width=550;'."\n";
                //$txt .= '  var doc  = ifrm.contentWindow;' . "\n";
                //$txt .= '  doc.setAttribute("style","background-image:url(http://www.ittg.edu.mx/img/fondoTexto.jpg);");'."\n";
                //$txt .= '  alert(docr)'."\n";
                $txt .= '</script>'."\n";

                $this->texto = $txt;
		//$this->imagenes = "";

	}
}
?>
